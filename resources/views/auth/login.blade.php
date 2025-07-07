<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registrasi</title>
    
    {{-- Ikon dari CDN --}}
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">

    {{-- CSS BARU ANDA DITEMPATKAN LANGSUNG DI SINI --}}
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins");

        * {
            box-sizing: border-box;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f6f5f7;
            flex-direction: column;
            font-family: "poppins", sans-serif;
            overflow: hidden;
            height: 100vh;
            margin: 0;
        }

        h1 {
            font-weight: 700;
            letter-spacing: -1.5px;
            margin: 0;
            margin-bottom: 15px;
        }

        h1.title {
            font-size: 45px;
            line-height: 45px;
            margin: 0;
            text-shadow: 0 0 10px rgba(16, 64, 74, 0.5);
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
            text-shadow: 0 0 10px rgba(16, 64, 74, 0.5);
        }

        span {
            font-size: 14px;
            margin-top: 25px;
        }

        a {
            color : #333;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
            transition: 0.3s ease-in-out;
        }

        a:hover {
            color: #fed0e7;
        }

        .content {
            display: flex;
            width: 100%;
            height: 50px;
            align-items: center;
            justify-content: space-between;
        }

        .content .checkbox{
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .content input {
            accent-color: #fed0e7;
            width: 12px;
            height: 12px;
        }

        .content label {
            font-size: 14px;
            user-select: none;
            padding-left: 5px;
        }

        button {
            position: relative;
            border-radius: 20px;
            border: 1px solid #fed0e7;
            background-color: #fed0e7;
            color : #fff;
            font-size: 15px;
            font-weight: 700;
            padding: 12px 80px;
            margin: 10px;
            letter-spacing: 1px;
            text-transform: capitalize;
            transition: 0.3s ease-in-out;
        }

        button:hover {
            letter-spacing: 3px;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background-color: rgba(225, 225, 225, 0.3);
            border-color: #fff;
            color: #fff;
        }

        button.ghost i {
            position: absolute;
            opacity: 0;
            transition: 0.3s ease-in-out;
        }
        button.ghost i.register {
            right: 70px;
        }

        button.ghost i.login {
            left: 70px;
        }

        button.ghost:hover i.register {
            right: 40px;
            opacity: 1;
        }

        button.ghost:hover i.login {
            left: 40px;
            opacity: 1;
        }

        form {
            background-color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0 50px;
            height: 100%;
            text-align: center;
        }

        input {
            background-color: #eee;
            border-radius: 10px;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
        }

        .container{
            background-color: #fff;
            border-radius: 25px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 500px;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .login-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .container.right-panel-active .login-container {
            transform: translateX(100%);
        }

        .register-container {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.right-panel-active .register-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {
            0%, 49.99% { opacity: 0; z-index: 1; }
            50%, 100% { opacity: 1; z-index: 5; }
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            height: 100%;
            width: 50%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .overlay {
            /* PERBAIKAN: Menggunakan asset() untuk memanggil gambar dari folder public */
            background-image: url("{{ asset('images/download.gif') }}");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #fff;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay::before{
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(49, 94, 109, 0.4) 40%, rgba(46, 94, 109, 0));
        }

        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            width: 50%;
            text-align: center;
            padding: 0 40px;
            top: 0;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left{
            transform: translateX(-20%);
        }

        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .overlay-right{
            right: 0;
            transform: translateX(0);
        }

        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        .social-container {
            margin: 20px 0;
        }

        .social-container a {
            border: 1px solid #dddddd;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            transition: 0.3s ease-in-out;
            height: 40px;
            width: 40px;
        }

        .social-container a:hover {
            border: 1px solid #fed0e7;
        }
        .error-message { color: red; font-size: 0.8em; text-align: left; width: 100%; }
    </style>
</head>
<body>
    <div class="container {{ $errors->has('name') || $errors->has('password_confirmation') ? 'right-panel-active' : '' }}" id="container">

        {{-- FORM REGISTRASI --}}
        <div class="form-container register-container">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h1>Register Disini</h1>
                <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required/>
                @error('name')<span class="error-message">{{ $message }}</span>@enderror
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required/>
                @error('email')<span class="error-message">{{ $message }}</span>@enderror
                <input type="password" name="password" placeholder="Password" required/>
                @error('password')<span class="error-message">{{ $message }}</span>@enderror
                <button type="submit">Register</button>
            </form>
        </div>

        {{-- FORM LOGIN --}}
        <div class="form-container login-container">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1>Login Disini</h1>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required/>
                @if($errors->has('email') && !$errors->has('name'))<span class="error-message">{{ $errors->first('email') }}</span>@endif
                <input type="password" name="password" placeholder="Password" required/>
                <div class="content">
                    <div class="checkbox">
                        <input type="checkbox" name="remember" id="checkbox">
                        <label for="checkbox">Ingatkan saya</label>
                    </div>
                    <div class="pass-link">
                        <a href="#">Forgot your password?</a>
                    </div>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>

        {{-- OVERLAY SLIDER --}}
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="title">Hello <br> friend </h1>
                    <p> jika kamu sudah memiliki akun, silahkan masuk</p>
                    <button class="ghost" id="Login">Login
                        <i class="lni lni-arrow-left login"></i>
                    </button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1 class="title">Buat Akun <br> Mu Sekarang </h1>
                    <p> jika kamu belum memiliki akun, silahkan daftar, dan mulai hidup sehat dengan berolahraga</p>
                    <button class="ghost" id="Register">Register
                        <i class="lni lni-arrow-right register"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- JAVASCRIPT --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const registerButton = document.getElementById('Register');
            const loginButton = document.getElementById('Login');
            const container = document.getElementById('container');

            if(registerButton) {
                registerButton.addEventListener('click', () => {
                    container.classList.add("right-panel-active");
                });
            }

            if(loginButton) {
                loginButton.addEventListener('click', () => {
                    container.classList.remove("right-panel-active");
                });
            }
        });
    </script>
</body>
</html>
