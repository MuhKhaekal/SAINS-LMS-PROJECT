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
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <style>
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #E6E6E2 inset !important;
            -webkit-text-fill-color: #093B3B !important;
        }
    </style>
</head>

<body class="font-poppins" style="background-color: #f4f6f9">
    <div class="flex">
        <!-- Header -->
        <div class="md:hidden flex bg-primary text-secondary items-center py-3 fixed w-full top-0 z-40">
            <div class="w-10 ">
                <!-- Tombol hanya muncul di mobile -->
                <button id="toggleSidebar" class="p-2">
                    <svg class="w-6 h-6 text-secondary" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <div class="flex-1">
                <h1 class="text-center font-semibold -ms-8">@yield('page-title')</h1>
            </div>
        </div>


        <div id="mobileSidebar"
            class="fixed top-0 left-0 md:left-auto md:right-0 z-50 w-80 h-screen overflow-y-auto bg-primary text-secondary 
            transition-transform duration-300 transform -translate-x-full md:translate-x-0 md:static md:flex md:flex-col">

            <!-- Logo -->
            <div class="text-secondary text-md font-bold flex items-center justify-center px-4 py-6">
                <a href="" class="text-2xl font-semibold">[ SAINS UNHAS ]</a>
            </div>

            <!-- Menu -->
            <div class="h-full overflow-y-auto flex flex-col flex-1 mt-0 no-scrollbar pb-10">
                <ul class="space-y-4">
                    <li
                        class="text-lg font-semibold rounded-lg mx-2 px-5 py-3 flex justify-items-center hover:bg-gray-700 hover:text-gray-300 {{ request()->routeIs('dashboard') ? 'text-secondary bg-gray-600 ' : ' text-gray-500 hover:bg-gray-700 group' }}">
                        <svg class="w-6 h-6 me-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M13.5 2c-.178 0-.356.013-.492.022l-.074.005a1 1 0 0 0-.934.998V11a1 1 0 0 0 1 1h7.975a1 1 0 0 0 .998-.934l.005-.074A7.04 7.04 0 0 0 22 10.5 8.5 8.5 0 0 0 13.5 2Z" />
                            <path
                                d="M11 6.025a1 1 0 0 0-1.065-.998 8.5 8.5 0 1 0 9.038 9.039A1 1 0 0 0 17.975 13H11V6.025Z" />
                        </svg>
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li
                        class="text-lg font-semibold rounded-lg mx-2 px-5 py-3 flex justify-items-center hover:bg-gray-700 hover:text-gray-300 {{ request()->routeIs('daftar-pengguna.*') ? 'text-secondary bg-gray-600' : ' text-gray-500  hover:bg-gray-700 group' }}">
                        <svg class="w-6 h-6 me-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                clip-rule="evenodd" />
                        </svg>

                        <a href="{{ route('daftar-pengguna.index') }}">Daftar Pengguna</a>
                    </li>
                    <li
                        class="text-lg font-semibold rounded-lg mx-2 px-5 py-3 flex justify-items-center hover:bg-gray-700 hover:text-gray-300 {{ request()->routeIs('daftar-fakultas.*') ? 'text-secondary bg-gray-600' : ' text-gray-500  hover:bg-gray-700 group' }}">
                        <svg class="w-6 h-6 me-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route('daftar-fakultas.index') }}">Daftar Fakultas</a>
                    </li>
                    <li
                        class="text-lg font-semibold rounded-lg mx-2 px-5 py-3 flex justify-items-center hover:bg-gray-700 hover:text-gray-300 {{ request()->routeIs('daftar-prodi.*') ? 'text-secondary bg-gray-600' : ' text-gray-500  hover:bg-gray-700 group' }}">
                        <svg class="w-6 h-6 me-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="m6 10.5237-2.27075.6386C3.29797 11.2836 3 11.677 3 12.125V20c0 .5523.44772 1 1 1h2V10.5237Z" />
                            <path fill-rule="evenodd"
                                d="M12.5547 3.16795c-.3359-.22393-.7735-.22393-1.1094 0l-6.00002 4c-.45952.30635-.5837.92722-.27735 1.38675.30636.45953.92723.5837 1.38675.27735L8 7.86853V21h8V7.86853l1.4453.96352c.0143.00957.0289.01873.0435.02746.1597.09514.3364.14076.5112.1406.3228-.0003.6395-.15664.832-.44541.3064-.45953.1822-1.0804-.2773-1.38675l-6-4ZM10 12c0-.5523.4477-1 1-1h2c.5523 0 1 .4477 1 1s-.4477 1-1 1h-2c-.5523 0-1-.4477-1-1Zm1-4c-.5523 0-1 .44772-1 1s.4477 1 1 1h2c.5523 0 1-.44772 1-1s-.4477-1-1-1h-2Zm8 12c0-.5523.4477-1 1-1h.01c.5523 0 1 .4477 1 1s-.4477 1-1 1H20c-.5523 0-1-.4477-1-1Zm1-8c.5523 0 1 .4477 1 1v4c0 .5523-.4477 1-1 1s-1-.4477-1-1v-4c0-.5523.4477-1 1-1Z"
                                clip-rule="evenodd" />
                        </svg>

                        <a href="{{ route('daftar-prodi.index') }}">Daftar Program Studi</a>
                    </li>
                    <li
                        class="text-lg font-semibold rounded-lg mx-2 px-5 py-3 flex justify-items-center hover:bg-gray-700 hover:text-gray-300 {{ request()->routeIs('daftar-kelas.*') ? 'text-secondary bg-gray-600' : ' text-gray-500  hover:bg-gray-700 group' }}">
                        <svg class="w-6 h-6 me-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z"
                                clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route('daftar-kelas.index') }}">Daftar Kelas</a>
                    </li>
                    <li
                        class="text-lg font-semibold rounded-lg mx-2 px-5 py-3 flex justify-items-center hover:bg-gray-700 hover:text-gray-300 {{ request()->routeIs('daftar-halaqah.*') ? 'text-secondary bg-gray-600' : ' text-gray-500  hover:bg-gray-700 group' }}">
                        <svg class="w-6 h-6 me-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M16 10c0-.55228-.4477-1-1-1h-3v2h3c.5523 0 1-.4477 1-1Z" />
                            <path
                                d="M13 15v-2h2c1.6569 0 3-1.3431 3-3 0-1.65685-1.3431-3-3-3h-2.256c.1658-.46917.256-.97405.256-1.5 0-.51464-.0864-1.0091-.2454-1.46967C12.8331 4.01052 12.9153 4 13 4h7c.5523 0 1 .44772 1 1v9c0 .5523-.4477 1-1 1h-2.5l1.9231 4.6154c.2124.5098-.0287 1.0953-.5385 1.3077-.5098.2124-1.0953-.0287-1.3077-.5385L15.75 16l-1.827 4.3846c-.1825.438-.6403.6776-1.0889.6018.1075-.3089.1659-.6408.1659-.9864v-2.6002L14 15h-1ZM6 5.5C6 4.11929 7.11929 3 8.5 3S11 4.11929 11 5.5 9.88071 8 8.5 8 6 6.88071 6 5.5Z" />
                            <path
                                d="M15 11h-4v9c0 .5523-.4477 1-1 1-.55228 0-1-.4477-1-1v-4H8v4c0 .5523-.44772 1-1 1s-1-.4477-1-1v-6.6973l-1.16797 1.752c-.30635.4595-.92722.5837-1.38675.2773-.45952-.3063-.5837-.9272-.27735-1.3867l2.99228-4.48843c.09402-.14507.2246-.26423.37869-.34445.11427-.05949.24148-.09755.3763-.10887.03364-.00289.06747-.00408.10134-.00355H15c.5523 0 1 .44772 1 1 0 .5523-.4477 1-1 1Z" />
                        </svg>
                        <a href="{{ route('daftar-halaqah.index') }}">Daftar Halaqah</a>
                    </li>
                    <li
                        class="text-lg font-semibold rounded-lg mx-2 px-5 py-3 flex justify-items-center hover:bg-gray-700 hover:text-gray-300 {{ request()->routeIs('pertemuan.*') ? 'text-secondary bg-gray-600' : ' text-gray-500  hover:bg-gray-700 group' }}">
                        <svg class="w-6 h-6 me-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                clip-rule="evenodd" />
                        </svg>

                        <a href="{{ route('pertemuan.index') }}">Kelola Pertemuan</a>
                    </li>
                    <li
                        class="text-lg font-semibold rounded-lg mx-2 px-5 py-3 flex justify-items-center hover:bg-gray-700 hover:text-gray-300 {{ request()->routeIs('faq.*') ? 'text-secondary bg-gray-600' : ' text-gray-500  hover:bg-gray-700 group' }}">
                        <svg class="w-6 h-6 me-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.008-3.018a1.502 1.502 0 0 1 2.522 1.159v.024a1.44 1.44 0 0 1-1.493 1.418 1 1 0 0 0-1.037.999V14a1 1 0 1 0 2 0v-.539a3.44 3.44 0 0 0 2.529-3.256 3.502 3.502 0 0 0-7-.255 1 1 0 0 0 2 .076c.014-.398.187-.774.48-1.044Zm.982 7.026a1 1 0 1 0 0 2H12a1 1 0 1 0 0-2h-.01Z"
                                clip-rule="evenodd" />
                        </svg>

                        <a href="{{ route('faq.index') }}">FAQ</a>
                    </li>
                    <li
                        class="text-lg font-semibold rounded-lg mx-2 px-5 py-3 flex justify-items-center hover:bg-gray-700 hover:text-gray-300 {{ request()->routeIs('pengumuman.*') ? 'text-secondary bg-gray-600' : ' text-gray-500  hover:bg-gray-700 group' }}">
                        <svg class="w-6 h-6 me-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17 6h-2V5h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2h-.541A5.965 5.965 0 0 1 14 10v4a1 1 0 1 1-2 0v-4c0-2.206-1.794-4-4-4-.075 0-.148.012-.22.028C7.686 6.022 7.596 6 7.5 6A4.505 4.505 0 0 0 3 10.5V16a1 1 0 0 0 1 1h7v3a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-3h5a1 1 0 0 0 1-1v-6c0-2.206-1.794-4-4-4Zm-9 8.5H7a1 1 0 1 1 0-2h1a1 1 0 1 1 0 2Z" />
                        </svg>
                        <a href="{{ route('pengumuman.index') }}">Pengumuman</a>
                    </li>
                    <li
                        class="text-lg font-semibold rounded-lg mx-2 px-5 py-3 flex justify-items-center hover:bg-gray-700 hover:text-gray-300 {{ request()->routeIs('sertifikat.*') ? 'text-secondary bg-gray-600' : ' text-gray-500  hover:bg-gray-700 group' }}">
                        <svg class="w-6 h-6 me-5 aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11 9a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" />
                            <path fill-rule="evenodd"
                                d="M9.896 3.051a2.681 2.681 0 0 1 4.208 0c.147.186.38.282.615.255a2.681 2.681 0 0 1 2.976 2.975.681.681 0 0 0 .254.615 2.681 2.681 0 0 1 0 4.208.682.682 0 0 0-.254.615 2.681 2.681 0 0 1-2.976 2.976.681.681 0 0 0-.615.254 2.682 2.682 0 0 1-4.208 0 .681.681 0 0 0-.614-.255 2.681 2.681 0 0 1-2.976-2.975.681.681 0 0 0-.255-.615 2.681 2.681 0 0 1 0-4.208.681.681 0 0 0 .255-.615 2.681 2.681 0 0 1 2.976-2.975.681.681 0 0 0 .614-.255ZM12 6a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z"
                                clip-rule="evenodd" />
                            <path
                                d="M5.395 15.055 4.07 19a1 1 0 0 0 1.264 1.267l1.95-.65 1.144 1.707A1 1 0 0 0 10.2 21.1l1.12-3.18a4.641 4.641 0 0 1-2.515-1.208 4.667 4.667 0 0 1-3.411-1.656Zm7.269 2.867 1.12 3.177a1 1 0 0 0 1.773.224l1.144-1.707 1.95.65A1 1 0 0 0 19.915 19l-1.32-3.93a4.667 4.667 0 0 1-3.4 1.642 4.643 4.643 0 0 1-2.53 1.21Z" />
                        </svg>

                        <a href="{{ route('sertifikat.index') }}">Sertifikat</a>
                    </li>

                    <hr>
                    <li class="text-lg font-semibold mx-2 px-5">
                        <p class="text-gray-300">{{ Auth::user()->name }}</p>
                    </li>
                    <li
                        class="text-lg font-semibold rounded-lg mx-2 px-5 py-3 flex items-center hover:bg-gray-700 text-red-500">
                        <svg class="w-7 h-7 me-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
                        </svg>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="hover:text-red-400">
                                Logout
                            </button>
                        </form>
                    </li>

                </ul>
            </div>
        </div>

        <div id="overlay" class="fixed inset-0 bg-black/30 backdrop-blur-sm hidden z-40 md:hidden"></div>

        <!-- Content -->
        <div class="flex-1 h-screen overflow-y-auto">
            <div class="pb-20 mx-4">
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

        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    </script>

</body>

</html>
