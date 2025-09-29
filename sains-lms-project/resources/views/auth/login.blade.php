<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Studi Al-Qur'an Intensif Unhas (SAINS)</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-primary text-white font-poppins">
    <section class="flex md:flex-row flex-col">
        <div style="background-image: url('/assets/images/background-login.png')" class="bg-cover bg-center md:min-h-screen md:flex-1  md:p-20 h-80">
            <div class="md:me-32 mx-5 md:mx-0">
                <h1 class="md:text-5xl font-semibold md:leading-normal mt-48 md:mt-0 text-xl" data-aos="fade-right">Selangkah Lebih Dekat dengan Tajwid</h1>
                <p class="text-xs md:text-base leading-loose" data-aos="fade-up">Sebuah layanan E-Learning gratis yang siap membantumu menjadi seorang ahli!</p>
            </div>
        </div>
        <div class="md:flex-1 md:py-20 md:px-28 mx-5 md:mx-0 my-10 md:my-0">
            <h1 class="md:text-2xl font-semibold md:leading-normal text-xl" data-aos="fade-down">Login</h1>
            <p class="md:font-light md:me-28 md:my-5 hidden md:block" data-aos="fade-left">Persiapkan diri untuk masa depan yang penuh dengan bintang</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="md:mt-28 mt-7" data-aos="fade-left">
                    <x-text-input id="nim" class="block mt-1 w-full" type="text" name="nim" :value="old('nim')" required autofocus autocomplete="username" placeholder="NIM" />
                    <x-input-error :messages="$errors->get('nim')" class="mt-2" />
                </div>
        
                <!-- Password -->
                <div class="mt-4" data-aos="fade-left">
                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" placeholder="Password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
    
                <div class="md:block mt-4" data-aos="fade-left">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded bg-primary border-gray-300 text-gray-600 shadow-sm focus:ring-gray-500" name="remember">
                        <span class="ms-2 text-xs text-white font-light">{{ __('Simpan Info Masuk') }}</span>
                    </label>
                </div>
    
                <x-secondary-button-full class="md:mt-28 mt-7">
                    {{ __('MASUK') }}
                </x-secondary-button-full>
            </form>
            
        </div>
    </section>

    
     
    
</body>
</html>

{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="nim" :value="__('NIM')" />
            <x-text-input id="nim" class="block mt-1 w-full" type="text" name="nim" :value="old('nim')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('nim')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>

            
        </div>
    </form>
</x-guest-layout> --}}
