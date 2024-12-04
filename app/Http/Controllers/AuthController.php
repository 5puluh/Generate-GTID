<?php
// Copyright (c) Microsoft Corporation.
// Licensed under the MIT License.

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\TokenStore\TokenCache;
use Illuminate\Http\Request;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function signin()
    {
        // Initialize the OAuth client
        $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId'                => env('OAUTH_APP_ID'),
            'clientSecret'            => env('OAUTH_APP_SECRET'),
            'redirectUri'             => env('OAUTH_REDIRECT_URI'),
            'urlAuthorize'            => env('OAUTH_AUTHORITY') . env('OAUTH_AUTHORIZE_ENDPOINT'),
            'urlAccessToken'          => env('OAUTH_AUTHORITY') . env('OAUTH_TOKEN_ENDPOINT'),
            'urlResourceOwnerDetails' => '',
            'scopes'                  => env('OAUTH_SCOPES')
        ]);
        $authUrl = $oauthClient->getAuthorizationUrl();

        // Save client state so we can validate in callback
        session(['oauthState' => $oauthClient->getState()]);
        Log::info('OAuth State set in session:', ['oauthState' => session('oauthState')]);

        // Redirect to AAD signin page
        return redirect()->away($authUrl);
    }

    public function callback(Request $request)
{
    // Validate state
    $expectedState = session('oauthState');
    Log::info('OAuth State retrieved from session:', ['oauthState' => $expectedState]);
    $request->session()->forget('oauthState');
    $providedState = $request->query('state');

    if (!isset($expectedState)) {
        Log::error('Expected state not found in session.');
        return redirect('http://localhost:3000/');
    }

    if (!isset($providedState) || $expectedState != $providedState) {
        Log::error('Invalid auth state.', [
            'expectedState' => $expectedState,
            'providedState' => $providedState
        ]);
        return redirect('/error2')
            ->with('error', 'Invalid auth state')
            ->with('errorDetail', 'The provided auth state did not match the expected value');
    }

    // Authorization code should be in the "code" query param
    $authCode = $request->query('code');
    if (isset($authCode)) {
        // Initialize the OAuth client
        $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId'                => env('OAUTH_APP_ID'),
            'clientSecret'            => env('OAUTH_APP_SECRET'),
            'redirectUri'             => env('OAUTH_REDIRECT_URI'),
            'urlAuthorize'            => env('OAUTH_AUTHORITY') . env('OAUTH_AUTHORIZE_ENDPOINT'),
            'urlAccessToken'          => env('OAUTH_AUTHORITY') . env('OAUTH_TOKEN_ENDPOINT'),
            'urlResourceOwnerDetails' => '',
            'scopes'                  => env('OAUTH_SCOPES')
        ]);

        try {
            // Make the token request
            $accessToken = $oauthClient->getAccessToken('authorization_code', [
                'code' => $authCode
            ]);

            $graph = new Graph();
            $graph->setAccessToken($accessToken->getToken());

            $user = $graph->createRequest('GET', '/me?$select=displayName,mail,mailboxSettings,userPrincipalName')
                ->setReturnType(Model\User::class)
                ->execute();

            $tokenCache = new TokenCache();
            $tokenCache->storeTokens($accessToken, $user);

            Log::info('User authenticated successfully.', ['user' => $user]);

            return redirect('http://localhost:3000/');
            //return redirect('/template');
        } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
            Log::error('Error requesting access token', [
                'error' => json_encode($e->getResponseBody()),
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'response' => $e->getResponseBody()
            ]);

            return redirect('/error3')
                ->with('error', 'Error requesting access token')
                ->with('errorDetail', json_encode($e->getResponseBody()));
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Log::error('Client error during Graph API request', [
                'error' => $e->getResponse()->getBody()->getContents(),
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ]);

            return redirect('/error4')
                ->with('error', 'Client error during Graph API request')
                ->with('errorDetail', $e->getResponse()->getBody()->getContents());
        }
    }

    Log::error('Authorization code not found in request.');
    return redirect('/error5')
        ->with('error', $request->query('error'))
        ->with('errorDetail', $request->query('error_description'));
}

    public function signout()
    {
        $tokenCache = new TokenCache();
        $tokenCache->clearTokens();
        return redirect('/');
    }
}
