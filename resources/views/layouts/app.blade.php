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
            @if (auth()->check())
                <a href = '/admin' class="menu-item"><span></span>Admin</a>
                <a href = '/' class="menu-item"><span></span>Form page</a>
                @if (auth()->user()->user_type == 2)
                    <a href = '/reports' class="menu-item"><span></span>Reports</a>
                    <a href = '/users' class="menu-item"><span></span>Users</a>
                @endif
                <a class="logout" href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            @else
                <a href = '/login' class="slide-button"><span></span>Login</a>
                <a href = '/register' class="slide-button"><span></span>Register</a>
            @endif
        </div>

    </div>

    <div id="customAlertContainer"></div>
    <div id="customConfirmContainer"></div>

    <div class="main-div">
        <div class="container row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="col-md-12 alert alert-danger Result">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>

        @if (session('success'))
            <input type="hidden" id="ResultText" value="{{ session('success') }}">
            <input type="hidden" id="ResultType" value="success">
        @endif
        @if (session('error'))
            <input type="hidden" id="ResultText" value="{{ session('error') }}">
            <input type="hidden" id="ResultType" value="danger">
        @endif
        @yield('content')
    </div>
</body>

</html>
