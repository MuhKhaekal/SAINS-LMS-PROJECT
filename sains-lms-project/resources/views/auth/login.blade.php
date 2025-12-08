<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Studi Al-Qur'an Intensif Unhas (SAINS)</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #093B3B inset !important;
            -webkit-text-fill-color: #E6E6E2 !important;
        }
    </style>
</head>

<body class="bg-primary text-white font-poppins min-h-screen flex flex-col md:flex-row">

    {{-- BAGIAN KIRI: BRANDING & IMAGE --}}
    <section class="relative w-full md:w-1/2 h-72 md:h-screen flex-shrink-0 overflow-hidden">
        {{-- Background Image --}}
        <div style="background-image: url('/assets/images/background-login.png')"
            class="absolute inset-0 bg-cover bg-center transition-transform duration-700 hover:scale-105">
        </div>

        {{-- Gradient Overlay (Agar teks terbaca jelas) --}}
        <div
            class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-r from-primary/90 via-primary/60 to-transparent">
        </div>

        {{-- Content --}}
        <div class="relative z-10 h-full flex flex-col justify-center px-8 md:px-20">
            <h1 class="text-2xl md:text-5xl font-bold leading-tight mb-4" data-aos="fade-right">
                Selangkah Lebih Dekat dengan <span class="text-yellow-400">Tajwid</span>
            </h1>
            <p class="text-sm md:text-lg font-light text-gray-200 leading-relaxed max-w-md" data-aos="fade-up"
                data-aos-delay="100">
                Sebuah layanan E-Learning gratis yang siap membantumu menjadi seorang ahli!
            </p>
        </div>
    </section>

    {{-- BAGIAN KANAN: FORM LOGIN --}}
    <section class="w-full md:w-1/2 flex flex-col justify-center items-center p-8 md:p-16 bg-primary">
        <div class="w-full max-w-md space-y-8">

            {{-- Header Form --}}
            <div class="text-center md:text-left">
                <h2 class="text-3xl font-bold tracking-tight text-white" data-aos="fade-down">
                    Selamat Datang
                </h2>
                <p class="mt-2 text-sm text-gray-400" data-aos="fade-left">
                    Masuk untuk melanjutkan pembelajaran Anda.
                </p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6" data-aos="fade-up">
                @csrf

                {{-- Input NIM --}}
                <div>
                    <label for="nim" class="sr-only">NIM</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            {{-- Icon User --}}
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <x-text-input id="nim"
                            class="block w-full pl-10 py-3 bg-primary-dark border-gray-600 placeholder-gray-400 text-white focus:ring-secondary focus:border-secondary sm:text-sm rounded-lg"
                            type="text" name="nim" :value="old('nim')" required autofocus autocomplete="username"
                            placeholder="Masukkan NIM" />
                    </div>
                    <x-input-error :messages="$errors->get('nim')" class="mt-2 text-red-400 text-xs" />
                </div>

                {{-- Input Password --}}
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            {{-- Icon Lock --}}
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <x-text-input id="password"
                            class="block w-full pl-10 py-3 bg-primary-dark border-gray-600 placeholder-gray-400 text-white focus:ring-secondary focus:border-secondary sm:text-sm rounded-lg"
                            type="password" name="password" required autocomplete="current-password"
                            placeholder="Masukkan Password" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-xs" />
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox"
                            class="h-4 w-4 text-secondary focus:ring-secondary border-gray-600 rounded bg-gray-700">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-300">
                            Ingat Saya
                        </label>
                    </div>
                    {{-- Optional: Lupa Password Link --}}
                    {{-- <a href="#" class="text-sm font-medium text-secondary hover:text-white transition">Lupa Password?</a> --}}
                </div>

                {{-- Button Login --}}
                <div>
                    <x-secondary-button-full
                        class="w-full justify-center py-3 text-base font-bold tracking-wide shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        {{ __('MASUK SEKARANG') }}
                    </x-secondary-button-full>
                </div>
            </form>

            <p class="text-center text-xs text-gray-500 mt-8">
                &copy; {{ date('Y') }} SAINS - Universitas Hasanuddin
            </p>
        </div>
    </section>

</body>

</html>
