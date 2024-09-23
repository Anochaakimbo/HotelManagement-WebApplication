<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @import url( {{asset('css/loginpage.css')}});
    </style>
</head>
<body>
    <div class="loginbox">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <img src="./img/Logo.png" alt="">
        <h1 class="head">เข้าสู่ระบบ</h1>
    <div class="logininput">
        <div class="emailbox">
            <label for="email" value="{{ __('อีเมล') }}">อีเมล:
            <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
        </div>


        <div class="passwordbox">
            <label for="password" value="{{ __('รหัสผ่าน') }}">รหัสผ่าน:
            <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
        </div>
    </div>
        <div class="rememfor">
            <div class="remembercheckbox">
                <input type="checkbox" id="remember_me" name="remember" />
                <label for="remember_me" class="flex items-center">
                    <span class="ms-2 text-sm text-gray-600">{{ __('จดจำฉัน') }}</span>
                </label>
            </div>
            <div class="forgetpassbox">
            @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('ลืมรหัสผ่าน?') }}
                    </a>
                @endif
            </div>
        </div>
        <x-validation-errors class="mb-4" />
        <button class="login">
            {{ __('เข้าสู่ระบบ') }}
        </button>
    </form>
    </div>
</body>
</html>
