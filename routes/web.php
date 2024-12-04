<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@welcome');

Route::get('/signin', 'AuthController@signin');
Route::get('/callback', 'AuthController@callback');
Route::get('/signout', 'AuthController@signout');
Route::get('/template', 'TemplateController@index');
Route::get('/calendar', 'CalendarController@calendar');
Route::get('/calendar/new', 'CalendarController@getNewEventForm');
Route::post('/calendar/new', 'CalendarController@createNewEvent');

Route::get('/saml', function () {
    $filePath = public_path('index.html');

    if (!file_exists($filePath)) {
        return "File not found: " . $filePath;
    }


    return response()->file($filePath, [
        'Content-Type' => 'text/html',
    ]);
});

Route::get('/choose-template', function () {
    return view('choose-template'); // Adjust the view name accordingly
})->name('choose-template');

