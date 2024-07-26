<!DOCTYPE html>
<html lang="{{ app()->getLocale() }} ">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Al-Dawa Task</title>
    <!-- Styles -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome-free-6.2.1-web/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/logo.png') }}">

</head>

<body>
    <div class="NavBar">
        <img src="/images/logo.png" class="logo" alt="">
        <label for="" class="header">Al-Dawa Task</label>
        <div class="menu">
            <a class="logout" href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
    <div class="access-denied">
        <div class="text-center">
            <i class="fas fa-ban icon"></i>
            <br>
            <span>User Suspended</span>
        </div>
    </div>
</body>

</html>
