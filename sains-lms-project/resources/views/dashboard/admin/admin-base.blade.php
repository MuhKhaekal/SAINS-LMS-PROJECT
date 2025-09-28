<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-poppins">
    <div class="">
        <div class="flex bg-primary text-white items-center py-3">
            <div class="w-10">
                <button id="toggleSidebar" class="md:hidden p-2 ">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h10"/>
                    </svg>
                </button>
            </div>
            <div class="flex-1 -ms-10">
                <h1 class="text-center font-semibold">@yield('page-title')</h1>
            </div>
        </div>

    
        <div id="mobileSidebar" class="fixed top-0 left-0 z-50 w-80 h-screen overflow-y-auto md:pb-80 bg-primary text-white transition-transform duration-300 transform -translate-x-full md:hidden">
    
    
            <div class="text-white text-md font-bold flex items-center justify-center px-4 py-6">
                <a href="" class="text-2xl font-semibold">[ SAINS UNHAS ]</a>
            </div>
            
            <div class="h-full overflow-y-auto flex flex-col flex-1 mt-10">
                <ul class="space-y-4">
                    <li class="text-lg font-semibold rounded-lg mx-2 px-5 py-3 flex justify-items-center hover:bg-gray-700 hover:text-gray-300 {{ request()->routeIs('dashboard') ? 'text-white bg-gray-600 ' : ' text-gray-500 hover:bg-gray-700 group' }}">
                        <svg class="w-6 h-6 me-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.5 2c-.178 0-.356.013-.492.022l-.074.005a1 1 0 0 0-.934.998V11a1 1 0 0 0 1 1h7.975a1 1 0 0 0 .998-.934l.005-.074A7.04 7.04 0 0 0 22 10.5 8.5 8.5 0 0 0 13.5 2Z"/>
                            <path d="M11 6.025a1 1 0 0 0-1.065-.998 8.5 8.5 0 1 0 9.038 9.039A1 1 0 0 0 17.975 13H11V6.025Z"/>
                        </svg>
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="text-lg font-semibold rounded-lg mx-2 px-5 py-3 flex justify-items-center hover:bg-gray-700 hover:text-gray-300 {{ request()->routeIs('pertemuan.*') ? 'text-white bg-gray-600' : ' text-gray-500  hover:bg-gray-700 group' }}">
                        <svg class="w-6 h-6 me-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.5 2c-.178 0-.356.013-.492.022l-.074.005a1 1 0 0 0-.934.998V11a1 1 0 0 0 1 1h7.975a1 1 0 0 0 .998-.934l.005-.074A7.04 7.04 0 0 0 22 10.5 8.5 8.5 0 0 0 13.5 2Z"/>
                            <path d="M11 6.025a1 1 0 0 0-1.065-.998 8.5 8.5 0 1 0 9.038 9.039A1 1 0 0 0 17.975 13H11V6.025Z"/>
                        </svg>
                        <a href="{{ route('pertemuan.index') }}">Daftar Pengguna</a>
                    </li>
                    
                </ul>
            </div>
        </div>

        <div id="overlay" class="fixed inset-0 bg-black/30 backdrop-blur-sm hidden z-40"></div>

    
        <div class="flex-1 h-screen mb-48 md:mb-0 pb-5 overflow-y-auto">
            <div class="w-full p-4 font-bold bg-white border-b">
                <h1>Selamat Datang, <span class="text-blue-800">{{ Auth::user()->name }}!👋</span></h1>
                <div class="font-medium text-base text-gray-800"></div>
            </div>
    
            <div class="pb-20">
                @yield('content')
            </div>
        </div>
    </div>
    
    <script>
        const toggleButton = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('mobileSidebar');
        const overlay = document.getElementById('overlay');
        
        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });
        
        // klik overlay nutup sidebar
        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
        </script>
        
</body>
</html>
{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in as Admin!") }}
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout> --}}
