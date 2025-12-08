@extends('dashboard.praktikan.praktikan-base')

@section('page-title', 'SAINS | Materi')

@section('content')


    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- HEADER & NAVIGATION --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Materi Pembelajaran</h1>
                <div class="flex items-center gap-2 mt-1 text-sm text-gray-500">
                    <span>{{ $selectedHalaqah->halaqah_name }}</span>
                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="font-medium text-gray-700">{{ $selectedMeeting->meeting_name }}</span>
                </div>
            </div>
            <div>
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Daftar
                </a>
            </div>
        </div>

        {{-- CONTENT LOOP --}}
        <div class="space-y-8">
            @forelse ($materials as $index => $material)
                @php
                    $path = $material->file_location;
                    $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                    $fileUrl = asset('storage/' . $path);
                @endphp

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

                    {{-- Card Header: Title & Description --}}
                    <div class="p-6 md:p-8 border-b border-gray-100">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1">
                                <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-2">
                                    {{ $material->material_name }}
                                </h2>
                                <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                                    {{ $material->description ?: 'Silakan pelajari materi berikut ini.' }}
                                </p>
                            </div>

                            {{-- Quick Download Button --}}
                            <a href="{{ $fileUrl }}" download="{{ $material->material_name . '.' . $extension }}"
                                class="hidden md:inline-flex items-center px-4 py-2 bg-indigo-50 text-indigo-700 rounded-lg text-sm font-medium hover:bg-indigo-100 transition"
                                title="Download File">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Unduh
                            </a>
                        </div>
                    </div>

                    {{-- Preview Area --}}
                    <div class="bg-gray-50 p-4 md:p-8 flex justify-center min-h-[300px]">

                        {{-- PDF PREVIEW --}}
                        @if ($extension === 'pdf')
                            <div
                                class="w-full h-[500px] md:h-[700px] bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                                <iframe src="{{ $fileUrl }}" class="w-full h-full" frameborder="0">
                                    <div class="flex flex-col items-center justify-center h-full p-6 text-center">
                                        <p class="text-gray-600 mb-4">Browser Anda tidak mendukung preview PDF.</p>
                                        <a href="{{ $fileUrl }}" download class="btn-primary">Download PDF</a>
                                    </div>
                                </iframe>
                            </div>

                            {{-- IMAGE PREVIEW --}}
                        @elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))
                            <div class="relative group max-w-full">
                                <img src="{{ $fileUrl }}"
                                    class="max-w-full max-h-[600px] h-auto object-contain rounded-lg shadow-md bg-white p-2"
                                    alt="{{ $material->material_name }}" />
                                <a href="{{ $fileUrl }}" download
                                    class="absolute bottom-4 right-4 bg-white/90 hover:bg-white text-gray-800 px-4 py-2 rounded-lg shadow-lg text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity">
                                    Download Gambar
                                </a>
                            </div>

                            {{-- AUDIO PREVIEW --}}
                        @elseif (in_array($extension, ['mp3', 'wav', 'ogg']))
                            <div
                                class="w-full max-w-2xl bg-white p-8 rounded-2xl shadow-sm border border-gray-200 text-center">
                                <div
                                    class="w-16 h-16 bg-cyan-100 text-cyan-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-gray-900 font-medium mb-2">Putar Audio</h3>
                                <p class="text-xs text-gray-500 mb-6">{{ $material->material_name }}</p>
                                <audio controls class="w-full">
                                    <source src="{{ $fileUrl }}">
                                    Browser Anda tidak mendukung elemen audio.
                                </audio>
                            </div>

                            {{-- FALLBACK (OFFICE FILES, ZIP, ETC) --}}
                        @else
                            <div
                                class="text-center max-w-md w-full bg-white p-8 rounded-2xl shadow-sm border border-gray-200">
                                {{-- Icon Logic --}}
                                @php
                                    $bgColor = match (true) {
                                        in_array($extension, ['doc', 'docx']) => 'bg-blue-100 text-blue-600',
                                        in_array($extension, ['xls', 'xlsx']) => 'bg-green-100 text-green-600',
                                        in_array($extension, ['ppt', 'pptx']) => 'bg-orange-100 text-orange-600',
                                        default => 'bg-gray-100 text-gray-600',
                                    };
                                @endphp

                                <div
                                    class="w-20 h-20 {{ $bgColor }} rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>

                                <h3 class="text-lg font-bold text-gray-900 mb-2">Pratinjau Tidak Tersedia</h3>
                                <p class="text-sm text-gray-500 mb-6">
                                    File <strong>.{{ strtoupper($extension) }}</strong> tidak dapat ditampilkan di browser.
                                    Silakan unduh untuk membukanya.
                                </p>

                                <a href="{{ $fileUrl }}" download="{{ $material->material_name . '.' . $extension }}"
                                    class="inline-flex justify-center items-center w-full px-4 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition shadow-md font-medium">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                    Unduh Materi
                                </a>
                            </div>
                        @endif

                    </div>
                </div>
            @empty
                <div
                    class="flex flex-col items-center justify-center py-16 bg-white rounded-2xl border-2 border-dashed border-gray-300 text-center">
                    <div class="p-4 bg-gray-50 rounded-full mb-3">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Belum ada materi</h3>
                    <p class="text-sm text-gray-500 mt-1">Materi untuk pertemuan ini belum tersedia.</p>
                </div>
            @endforelse
        </div>

    </div>
@endsection
