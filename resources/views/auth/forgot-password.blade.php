้<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @import url( {{asset('css/forgetpasspage.css')}});
    </style>
</head>
<body>
    <div class="forgetpassbox">
    @session('status')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ $value }}
        </div>
    @endsession
    <form method="POST" action="{{ route('password.email') }}">
        <img src="./img/Logo.png" alt="">
        <div class="description">
            {{ __('หากคุณลืมรหัสผ่าน ให้กรอกอีเมลของคุณที่ใช้สมัคร ทางเราจะส่งลิงค์เปลี่ยนรหัสผ่านไปที่อีเมลของคุณ') }}
        </div>
        @csrf
        <div class="emailbox">
            <label for="email" value="{{ __('Email') }}">อีเมล:
            <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="กรอกอีเมลที่ใช้สมัคร"/>
        </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
