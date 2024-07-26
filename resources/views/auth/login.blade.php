<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>



    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome-free-6.2.1-web/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login_style.css') }}" rel="stylesheet">
    <style>
        .form-group {
            position: relative;
            margin-bottom: 2.5rem;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.inputContainer input');
            inputs.forEach(input => {
                if (input.value.trim() !== '') {
                    input.classList.add('filled');
                }
                input.addEventListener('focus', () => {
                    input.classList.add('filled');
                });
                input.addEventListener('blur', () => {
                    if (input.value.trim() === '') {
                        input.classList.remove('filled');
                    }
                });
            });
        });
    </script>
</head>

<body>
    <img src="/images/login-background-img.jpg" class="bgImage" alt="">
    <div class="container">
        <div class="login-container">
            <h2 class="text-view" style="font-size:30px;">Login </h2>
            <img src="/images/logo.png" alt="EldinderLogo" class="img-fluid mb-4">
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="inputContainer">
                        <i class="fa-solid fa-at fa-2x"></i>
                        <input id="email" type="email" class="form-control" name="email" autocomplete="off"
                            value="{{ old('email') }}" required autofocus placeholder=" ">
                        <label for="email" class="floating-label">Email Address</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="inputContainer">
                        <i class="fa-solid fa-key fa-2x"></i>
                        <input id="password" type="password" class="form-control" name="password" autocomplete="off"
                            placeholder=" ">
                        <label for="password" class="floating-label">Passowrd</label>
                    </div>
                </div>
                @if ($errors->has('email') || $errors->has('password'))
                    <div class="form-group login-result">
                        <span class="help-block">
                            <strong> Wrong Email Address or Passowrd</strong>
                        </span>
                    </div>
                @endif
                <div class="form-group text-center">
                    <button type="submit" class="btn-login"> Login</button>
                </div>
            </form>
            <div class="form-group">
                <a href="/password/reset">
                    <label class="text-view" style="font-size: 12px"> Forgot Passowrd؟</label>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
