<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <title>@yield('page-title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>


</head>

<body class="font-poppins bg-slate-100 flex flex-col min-h-screen" style="background-color: #f4f6f9">

    <div class="hidden md:block relative">
        <div class="fixed top-0 w-full z-10">
            @include('layouts.navigation-praktikan')
        </div>
    </div>

    <div class="md:hidden relative z-30">
        <div class="fixed top-0 bg-white shadow-md w-full">
            <h1 class="text-center p-4 font-bold">@yield('page-title')</h1>
        </div>
    </div>

    <main class="flex-grow mt-16 mb-20 md:mt-0 no-scrollbar">
        @yield('content')
    </main>

    <div class="md:hidden relative z-50">
        {{-- Spacer agar konten tidak tertutup navbar --}}
        <div class="h-20"></div>
    
        {{-- Bottom Navbar --}}
        <div class="fixed bottom-0 w-full bg-white border-t border-gray-200 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] pb-safe">
            <ul class="flex justify-around items-center w-full h-16 px-2">
                
                {{-- 1. BERANDA --}}
                <li class="flex-1 group">
                    <a href="{{ route('dashboard') }}" 
                       class="flex flex-col items-center justify-center w-full h-full transition-colors duration-200
                       {{ request()->routeIs('dashboard') ? 'text-primary' : 'text-gray-400 hover:text-gray-600' }}">
                        
                        <svg class="w-6 h-6 mb-1 transition-transform group-active:scale-95" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="text-[10px] font-medium truncate">Beranda</span>
                    </a>
                </li>
    
                {{-- 2. HALAQAH --}}
                @php
                    $halaqahName = $halaqahsNavbar->first()->halaqah_name ?? 'Halaqah';
                @endphp
                <li class="flex-1 group">
                    <a href="{{ route('halaqah-praktikan.index', ['halaqah_name' => $halaqahName]) }}" 
                       class="flex flex-col items-center justify-center w-full h-full transition-colors duration-200
                       {{ request()->routeIs('halaqah-praktikan.*') ? 'text-primary' : 'text-gray-400 hover:text-gray-600' }}">
                        
                        <svg class="w-6 h-6 mb-1 transition-transform group-active:scale-95" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span class="text-[10px] font-medium truncate">Halaqah</span>
                    </a>
                </li>
    
                {{-- 3. PENGUMUMAN --}}
                <li class="flex-1 group">
                    <a href="{{ route('pengumuman-praktikan.index') }}" 
                       class="flex flex-col items-center justify-center w-full h-full transition-colors duration-200
                       {{ request()->routeIs('pengumuman-praktikan.*') ? 'text-primary' : 'text-gray-400 hover:text-gray-600' }}">
                        
                        <svg class="w-6 h-6 mb-1 transition-transform group-active:scale-95" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                        </svg>
                        <span class="text-[10px] font-medium truncate">Info</span>
                    </a>
                </li>
    
                {{-- 4. FAQ --}}
                <li class="flex-1 group">
                    <a href="{{ route('faq-praktikan.index') }}" 
                       class="flex flex-col items-center justify-center w-full h-full transition-colors duration-200
                       {{ request()->routeIs('faq-praktikan.*') ? 'text-primary' : 'text-gray-400 hover:text-gray-600' }}">
                        
                        <svg class="w-6 h-6 mb-1 transition-transform group-active:scale-95" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-[10px] font-medium truncate">FAQ</span>
                    </a>
                </li>
    
                {{-- 5. PROFIL --}}
                <li class="flex-1 group">
                    <a href="{{ route('profile-praktikan.edit') }}" 
                       class="flex flex-col items-center justify-center w-full h-full transition-colors duration-200
                       {{ request()->routeIs('profile-praktikan.*') ? 'text-primary' : 'text-gray-400 hover:text-gray-600' }}">
                        
                        <svg class="w-6 h-6 mb-1 transition-transform group-active:scale-95" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="text-[10px] font-medium truncate">Profil</span>
                    </a>
                </li>
    
            </ul>
        </div>
    </div>


    <div class="hidden md:block bg-white shadow-inner mt-auto">
        @include('layouts.footer')

    </div>
</body>
