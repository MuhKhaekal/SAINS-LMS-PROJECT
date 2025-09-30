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
    
    <div class="hidden md:block relative">
        <div class="fixed top-0 w-full z-10">
            @include('layouts.navigation-asisten')
        </div>
    </div>

    <div class="md:hidden relative z-30">
        <div class="fixed top-0 bg-white shadow-md w-full">
            <h1 class="text-center p-4 font-bold">@yield('page-title')</h1>
        </div>
    </div>      

    <div class="mt-12 mb-20 md:mt-0 no-scrollbar">
        @yield('content')
    </div>
    
    <div class="md:hidden relative"">
        <div class="fixed bottom-0 w-full bg-primary rounded-t-xl">
            <ul class="flex justify-center">
                <li class="text-xs font-semibold rounded-lg m-2 py-3 flex flex-col justify-center items-center w-1/3 hover:bg-gray-700 hover:text-gray-300 {{ request()->routeIs('dashboard') ? 'text-secondary bg-gray-600 ' : ' text-gray-500 hover:bg-gray-700 group' }}">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
                    </svg>  
                    <a class="mt-2 font-thin" href="{{ route('dashboard') }}">Beranda</a>
                </li>
                <li class="text-xs font-semibold rounded-lg m-2 py-3 flex flex-col justify-center items-center w-1/3 hover:bg-gray-700 hover:text-gray-300 {{ request()->routeIs('sertifikat.index') ? 'text-secondary bg-gray-600 ' : ' text-gray-500 hover:bg-gray-700 group' }}">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M16 10c0-.55228-.4477-1-1-1h-3v2h3c.5523 0 1-.4477 1-1Z"/>
                        <path d="M13 15v-2h2c1.6569 0 3-1.3431 3-3 0-1.65685-1.3431-3-3-3h-2.256c.1658-.46917.256-.97405.256-1.5 0-.51464-.0864-1.0091-.2454-1.46967C12.8331 4.01052 12.9153 4 13 4h7c.5523 0 1 .44772 1 1v9c0 .5523-.4477 1-1 1h-2.5l1.9231 4.6154c.2124.5098-.0287 1.0953-.5385 1.3077-.5098.2124-1.0953-.0287-1.3077-.5385L15.75 16l-1.827 4.3846c-.1825.438-.6403.6776-1.0889.6018.1075-.3089.1659-.6408.1659-.9864v-2.6002L14 15h-1ZM6 5.5C6 4.11929 7.11929 3 8.5 3S11 4.11929 11 5.5 9.88071 8 8.5 8 6 6.88071 6 5.5Z"/>
                        <path d="M15 11h-4v9c0 .5523-.4477 1-1 1-.55228 0-1-.4477-1-1v-4H8v4c0 .5523-.44772 1-1 1s-1-.4477-1-1v-6.6973l-1.16797 1.752c-.30635.4595-.92722.5837-1.38675.2773-.45952-.3063-.5837-.9272-.27735-1.3867l2.99228-4.48843c.09402-.14507.2246-.26423.37869-.34445.11427-.05949.24148-.09755.3763-.10887.03364-.00289.06747-.00408.10134-.00355H15c.5523 0 1 .44772 1 1 0 .5523-.4477 1-1 1Z"/>
                    </svg>
                    <a class="mt-2 font-thin" href="{{ route('dashboard') }}">Halaqah</a>
                </li>
                <li class="text-xs font-semibold rounded-lg m-2 py-3 flex flex-col justify-center items-center w-1/3 hover:bg-gray-700 hover:text-gray-300 {{ request()->routeIs('sertifikat.index') ? 'text-secondary bg-gray-600 ' : ' text-gray-500 hover:bg-gray-700 group' }}">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17 6h-2V5h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2h-.541A5.965 5.965 0 0 1 14 10v4a1 1 0 1 1-2 0v-4c0-2.206-1.794-4-4-4-.075 0-.148.012-.22.028C7.686 6.022 7.596 6 7.5 6A4.505 4.505 0 0 0 3 10.5V16a1 1 0 0 0 1 1h7v3a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-3h5a1 1 0 0 0 1-1v-6c0-2.206-1.794-4-4-4Zm-9 8.5H7a1 1 0 1 1 0-2h1a1 1 0 1 1 0 2Z"/>
                      </svg>
                      
                    <a class="mt-2 font-thin" href="{{ route('dashboard') }}">Pengumuman</a>
                </li>
                <li class="text-xs font-semibold rounded-lg m-2 py-3 flex flex-col justify-center items-center w-1/3 hover:bg-gray-700 hover:text-gray-300 {{ request()->routeIs('sertifikat.index') ? 'text-secondary bg-gray-600 ' : ' text-gray-500 hover:bg-gray-700 group' }}">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.008-3.018a1.502 1.502 0 0 1 2.522 1.159v.024a1.44 1.44 0 0 1-1.493 1.418 1 1 0 0 0-1.037.999V14a1 1 0 1 0 2 0v-.539a3.44 3.44 0 0 0 2.529-3.256 3.502 3.502 0 0 0-7-.255 1 1 0 0 0 2 .076c.014-.398.187-.774.48-1.044Zm.982 7.026a1 1 0 1 0 0 2H12a1 1 0 1 0 0-2h-.01Z" clip-rule="evenodd"/>
                      </svg>
                      
                    <a class="mt-2 font-thin" href="{{ route('dashboard') }}">FAQ</a>
                </li>
                <li class="text-xs font-semibold rounded-lg m-2 py-3 flex flex-col justify-center items-center w-1/3 hover:bg-gray-700 hover:text-gray-300 {{ request()->routeIs('sertifikat.index') ? 'text-secondary bg-gray-600 ' : ' text-gray-500 hover:bg-gray-700 group' }}">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H4Zm10 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-8-5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm1.942 4a3 3 0 0 0-2.847 2.051l-.044.133-.004.012c-.042.126-.055.167-.042.195.006.013.02.023.038.039.032.025.08.064.146.155A1 1 0 0 0 6 17h6a1 1 0 0 0 .811-.415.713.713 0 0 1 .146-.155c.019-.016.031-.026.038-.04.014-.027 0-.068-.042-.194l-.004-.012-.044-.133A3 3 0 0 0 10.059 14H7.942Z" clip-rule="evenodd"/>
                      </svg>
                      
                    <a class="mt-2 font-thin" href="{{ route('dashboard') }}">Profil</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="hidden md:block relative" data-aos="fade">
            @include('layouts.footer')
        
    </div>
</body>