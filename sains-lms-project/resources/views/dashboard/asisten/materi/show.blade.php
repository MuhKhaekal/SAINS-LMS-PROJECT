@extends('dashboard.asisten.asisten-base')

@section('page-title', $material->material_name)

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:mt-24">
        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-6">
            <div class="flex-1">
                <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
                    <a href="{{ url()->previous() }}" class="hover:text-indigo-600 hover:underline transition">Materi</a>
                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-gray-700">Preview</span>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 leading-tight">
                    {{ $material->material_name }}
                </h1>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ url()->previous() }}"
                    class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                    Kembali
                </a>

                @php
                    $path = $material->file_location;
                    $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                    $fileUrl = asset('storage/' . $path);
                @endphp
                <a href="{{ $fileUrl }}" download="{{ $material->material_name . '.' . $extension }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 shadow-sm flex items-center gap-2 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Download File
                </a>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

            @if ($material->description)
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Deskripsi Materi</h3>
                    <p class="text-sm text-gray-700 leading-relaxed">
                        {{ $material->description }}
                    </p>
                </div>
            @endif

            <div class="p-6 bg-gray-100 min-h-[400px] flex items-center justify-center">

                @if ($extension === 'pdf')
                    <div class="w-full h-[600px] bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <iframe src="{{ $fileUrl }}" class="w-full h-full" frameborder="0">
                            <p class="p-4 text-center">Browser Anda tidak mendukung preview PDF. Silakan download file.</p>
                        </iframe>
                    </div>
                @elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))
                    <div class="relative group">
                        <img src="{{ $fileUrl }}"
                            class="max-w-full max-h-[600px] h-auto object-contain rounded-lg shadow-md bg-white p-2"
                            alt="{{ $material->material_name }}" />
                        <div
                            class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition rounded-lg pointer-events-none">
                        </div>
                    </div>
                @elseif (in_array($extension, ['mp3', 'wav', 'ogg']))
                    <div class="w-full max-w-2xl bg-white p-8 rounded-xl shadow-sm border border-gray-200 text-center">
                        <div
                            class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-gray-900 font-medium mb-4">Audio Player</h3>
                        <audio controls class="w-full">
                            <source src="{{ $fileUrl }}">
                            Browser Anda tidak mendukung elemen audio.
                        </audio>
                    </div>
                @elseif (in_array($extension, ['mp4', 'webm', 'ogg']))
                    <div class="w-full max-w-4xl bg-black rounded-xl overflow-hidden shadow-lg">
                        <video controls class="w-full h-auto max-h-[600px]">
                            <source src="{{ $fileUrl }}" type="video/{{ $extension }}">
                            Browser Anda tidak mendukung tag video.
                        </video>
                    </div>
                @else
                    <div class="text-center max-w-md w-full bg-white p-8 rounded-xl shadow-sm border border-gray-200">
                        @php
                            $iconPath = match (true) {
                                in_array($extension, ['doc', 'docx'])
                                    => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                                in_array($extension, ['xls', 'xlsx'])
                                    => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                                in_array($extension, ['ppt', 'pptx'])
                                    => 'M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z',
                                default
                                    => 'M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z',
                            };

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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="{{ $iconPath }}"></path>
                            </svg>
                        </div>

                        <h3 class="text-lg font-bold text-gray-900 mb-2">Pratinjau Tidak Tersedia</h3>
                        <p class="text-sm text-gray-500 mb-6">
                            File bertipe <strong>.{{ strtoupper($extension) }}</strong> tidak dapat ditampilkan langsung di
                            browser. Silakan unduh file untuk melihat isinya.
                        </p>

                        <a href="{{ $fileUrl }}" download="{{ $material->material_name . '.' . $extension }}"
                            class="inline-flex justify-center items-center w-full px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition shadow-md font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Unduh File Sekarang
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
