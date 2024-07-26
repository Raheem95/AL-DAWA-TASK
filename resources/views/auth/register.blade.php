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
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
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
    <div class="row" style="width: 99%;">
        <div class="col-md-6">
            <img src="/images/login-background-img.jpg" style="width: 100%;height: 100vh;">
        </div>
        <div class="col-md-6" style="    align-content: center;">
            <div class="col-md-12 text-center">
                <h2 class="text-view" style="font-size:30px;padding:20px;background:#d4ea12;">Register </h2>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="col-md-12{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="model_label">Name</label>
                    <input id="name" type="text" class="input_style" name="name" value="{{ old('name') }}"
                        required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-12{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="model_label">E-Mail Address</label>

                    <input id="email" type="email" class="input_style" name="email" value="{{ old('email') }}"
                        required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-12{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="model_label">Password</label>

                    <input id="password" type="password" class="input_style" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-12">
                    <label for="password-confirm" class="model_label">Confirm Password</label>

                    <input id="password-confirm" type="password" class="input_style" name="password_confirmation"
                        required>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="view" style="padding:20px 20px;width:200px;font-size:16px;">
                            Register
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
