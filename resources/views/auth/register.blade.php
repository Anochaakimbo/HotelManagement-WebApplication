
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    @import url( {{asset('css/registerpage.css')}});
</style>
<body>
    <div class="registerbox">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <img src="./img/Logo.png" alt="">
        <h1 class="head">สมัครสมาชิก</h1>

        <div class="namebox">
            <label for="name" value="{{ __('Name') }}">ชื่อผู้ใช้:
            <input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"/>
        </div>

        <div class="emailbox">
            <label for="email" value="{{ __('Email') }}" >อีเมล:
            <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username"/>
        </div>

        <div class="passwordbox">
            <label for="password" value="{{ __('Password') }}">รหัสผ่าน:
            <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password"/>
        </div>

        <div class="comfirmpassbox">
            <label for="password_confirmation" value="{{ __('Confirm Password') }}">ยืนยันรหัสผ่าน
            <input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
        </div>

        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
                <label for="terms">
                    <div class="flex items-center">
                        <checkbox name="terms" id="terms" required />

                        <div class="ms-2">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </div>
                    </div>
                </label>
            </div>
        @endif

        <div class="flex items-center justify-end mt-4">
            <button class="register">
                {{ __('สมัคร') }}
            </button>

            <a class="haveAccount" href="{{ route('login') }}">
                {{ __('มีบัญชีอยู่แล้ว?') }}
            </a>
            <x-validation-errors class="mb-4" />
        </div>
    </form>
    </div>
</body>
</html>


