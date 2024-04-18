<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title> Survey Login</title>




    <!-- Bootstrap core CSS -->
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet">


    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />

    <link href="{{ asset('backend/css/login.css') }}" rel="stylesheet">
</head>
<body class="app">
<div class="container">
    <div class="login-container">
        <div id="output"></div>
        <div class="avatar"><img class="logo-img" src="{{ asset('backend/image/logo.png') }}"></div>
        <div class="form-box">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input id="email" placeholder="User Email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">


                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
{{--                        {{ __('Forgot Your Password?') }}--}}
                    </a>
                @endif
                <button class="btn btn-primary btn-block login" type="submit">Login</button>
            </form>
        </div>
    </div>

</div>


<script src="{{ asset('backend/js/login.js') }}"></script>

</body>
</html>
