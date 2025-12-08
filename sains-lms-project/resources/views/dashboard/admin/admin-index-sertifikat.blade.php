@extends('dashboard.admin.admin-base')

@section('page-title', 'Sertifikat')

@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- HEADER --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Sertifikat</h1>
            <p class="text-sm text-gray-500 mt-1">Unggah dan kelola sertifikat untuk praktikan dan asisten.</p>
        </div>

        {{-- SECTION 1: GENERAL UPLOAD / INFO --}}
        <section
            class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8 flex flex-col md:flex-row items-start md:items-center gap-6">
            <div class="p-3 bg-blue-50 rounded-full text-blue-600 shrink-0">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-semibold text-gray-800">Upload Sertifikat Umum</h3>
                <p class="text-sm text-gray-600 mt-1 leading-relaxed">
                    Gunakan bagian ini untuk mengunggah template sertifikat master atau sertifikat kegiatan umum yang
                    berlaku bagi seluruh peserta. Pastikan format file sesuai (PDF/JPG).
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <x-primary-button class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Unggah Master
                </x-primary-button>
            </div>
        </section>

        {{-- SECTION 2: GRID SERTIFIKAT INDIVIDU --}}
        <section>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Daftar Penerima Sertifikat</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- Kategori: REGULER (Praktikan) --}}
                <div
                    class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md transition-shadow duration-300 group">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-2 bg-indigo-50 text-indigo-600 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>
                        <span
                            class="bg-gray-100 text-gray-600 text-xs font-medium px-2.5 py-0.5 rounded-full">Praktikan</span>
                    </div>
                    <h3 class="font-bold text-gray-900">Sertifikat Peserta</h3>
                    <p class="text-sm text-gray-500 mt-1 mb-4">Fulan bin Fulana</p>
                    <button type="button"
                        class="w-full py-2 px-4 border border-indigo-600 text-indigo-600 hover:bg-indigo-50 rounded-lg text-sm font-medium transition flex justify-center items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Unggah File
                    </button>
                </div>

                {{-- Kategori: REGULER (Asisten) --}}
                <div
                    class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md transition-shadow duration-300 group">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <span
                            class="bg-gray-100 text-gray-600 text-xs font-medium px-2.5 py-0.5 rounded-full">Asisten</span>
                    </div>
                    <h3 class="font-bold text-gray-900">Sertifikat Asisten</h3>
                    <p class="text-sm text-gray-500 mt-1 mb-4">Fulan bin Fulana</p>
                    <button type="button"
                        class="w-full py-2 px-4 border border-blue-600 text-blue-600 hover:bg-blue-50 rounded-lg text-sm font-medium transition flex justify-center items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Unggah File
                    </button>
                </div>

                {{-- Kategori: TERBAIK (Card dengan aksen Emas/Kuning) --}}
                <div
                    class="bg-gradient-to-br from-yellow-50 to-white rounded-xl border border-yellow-200 p-5 hover:shadow-md transition-shadow duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-2 -mr-2 w-16 h-16 bg-yellow-400 rounded-full opacity-20 blur-xl">
                    </div>

                    <div class="flex items-start justify-between mb-4 relative z-10">
                        <div class="p-2 bg-yellow-100 text-yellow-700 rounded-lg">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        </div>
                        <span
                            class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2.5 py-0.5 rounded-full border border-yellow-200">Terbaik</span>
                    </div>
                    <h3 class="font-bold text-gray-900">Praktikan Akhwat Terbaik</h3>
                    <p class="text-sm text-gray-500 mt-1 mb-4">Fulan bin Fulana</p>

                    {{-- Tombol Aksi untuk kategori terbaik dibuat filled agar menonjol --}}
                    <button type="button"
                        class="w-full py-2 px-4 border border-yellow-600 text-yellow-600 hover:bg-yellow-50 rounded-lg text-sm font-medium transition flex justify-center items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Unggah File
                    </button>
                </div>

                {{-- Kategori: TERBAIK (Praktikan Ikhwan) --}}
                <div
                    class="bg-gradient-to-br from-yellow-50 to-white rounded-xl border border-yellow-200 p-5 hover:shadow-md transition-shadow duration-300 relative">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-2 bg-yellow-100 text-yellow-700 rounded-lg">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        </div>
                        <span
                            class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2.5 py-0.5 rounded-full border border-yellow-200">Terbaik</span>
                    </div>
                    <h3 class="font-bold text-gray-900">Praktikan Ikhwan Terbaik</h3>
                    <p class="text-sm text-gray-500 mt-1 mb-4">Fulan bin Fulana</p>
                    <button type="button"
                        class="w-full py-2 px-4 border border-yellow-600 text-yellow-600 hover:bg-yellow-50 rounded-lg text-sm font-medium transition flex justify-center items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Unggah File
                    </button>
                </div>

                {{-- Kategori: TERBAIK (Asisten Akhwat) --}}
                <div
                    class="bg-gradient-to-br from-indigo-50 to-white rounded-xl border border-indigo-200 p-5 hover:shadow-md transition-shadow duration-300 relative">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-2 bg-indigo-100 text-indigo-700 rounded-lg">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                            </svg>
                        </div>
                        <span
                            class="bg-indigo-100 text-indigo-800 text-xs font-bold px-2.5 py-0.5 rounded-full border border-indigo-200">Asisten
                            Terbaik</span>
                    </div>
                    <h3 class="font-bold text-gray-900">Asisten Akhwat Terbaik</h3>
                    <p class="text-sm text-gray-500 mt-1 mb-4">Fulan bin Fulana</p>
                    <button type="button"
                        class="w-full py-2 px-4 border border-blue-800 text-blue-800 hover:bg-blue-50 rounded-lg text-sm font-medium transition flex justify-center items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Unggah File
                    </button>
                </div>

                {{-- Kategori: TERBAIK (Asisten Ikhwan) --}}
                <div
                    class="bg-gradient-to-br from-indigo-50 to-white rounded-xl border border-indigo-200 p-5 hover:shadow-md transition-shadow duration-300 relative">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-2 bg-indigo-100 text-indigo-700 rounded-lg">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                            </svg>
                        </div>
                        <span
                            class="bg-indigo-100 text-indigo-800 text-xs font-bold px-2.5 py-0.5 rounded-full border border-indigo-200">Asisten
                            Terbaik</span>
                    </div>
                    <h3 class="font-bold text-gray-900">Asisten Ikhwan Terbaik</h3>
                    <p class="text-sm text-gray-500 mt-1 mb-4">Fulan bin Fulana</p>
                    <button type="button"
                        class="w-full py-2 px-4 border border-blue-800 text-blue-800 hover:bg-blue-50 rounded-lg text-sm font-medium transition flex justify-center items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Unggah File
                    </button>
                </div>

            </div>
        </section>
    </div>
@endsection
