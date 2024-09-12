
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
            <label for="name" value="{{ __('Name') }}" />
            <input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="ชื่อผู้ใช้"/>
        </div>

        <div class="emailbox">
            <label for="email" value="{{ __('Email') }}" >
            <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="อีเมล" />
        </div>

        <div class="passwordbox">
            <label for="password" value="{{ __('Password') }}" />
            <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="รหัสผ่าน"/>
        </div>

        <div class="comfirmpassbox">
            <label for="password_confirmation" value="{{ __('Confirm Password') }}" />
            <input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="ยืนยันรหัสผ่าน" />
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
        </div>
    </form>
    </div>
</body>
</html>

        
    
