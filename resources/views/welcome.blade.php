@extends('layout')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Landing Page</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900" rel="stylesheet" type="text/css" />
    <style>
       <style>
        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #fff; /* Matches the purple background */
        }
        .container {
            text-align: center;
            max-width: 550px;
            height:400px;
            background-color: #4F2D7F;
            padding: 80px 50px;
            margin-top:60px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        .logo img {
            width: 300px;
            margin-bottom: 50px;
        }
        .button {
            font-weight: bold;
            display: inline-block;
            padding: 10px 20px;
            margin-bottom: 50px;
            font-size: 18px;
            color: #000000;
            background-color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            margin-top: 50px;
            font-family: 'Montserrat', 'Trebuchet MS', Tahoma, sans-serif;
        }
        .button:hover {
            background-color: #dedde0;
        }

        @media (max-width: 768px) {
            .container {
                padding: px px;
            }

            .logo img {
                width: 240px;
                margin-bottom: 30px;
            }

            .button {
                font-size: 16px;
                padding: 8px 16px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 50px 30px;
            }

            .logo img {
                width: 180px;
                margin-bottom: 20px;
            }

            .button {
                font-size: 14px;
                padding: 6px 12px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="https://5a14c7ac32.imgdist.com/pub/bfra/q0ii2p3t/r4h/czk/oc8/655f8293f22acb71d0769192_grant-thornton-white-logo-1-800x149.png.webp" alt="Grant Thornton Logo">
        </div>
        @if(isset($userName))
            <!-- Jika pengguna sudah login -->
            <p>Welcome, {{ $userName }}!</p>
        @else
            <!-- Tombol Login -->
            <a href="/signin" class="button">Login SAML</a>
        @endif
    </div>
</body>

</html>
@endsection
