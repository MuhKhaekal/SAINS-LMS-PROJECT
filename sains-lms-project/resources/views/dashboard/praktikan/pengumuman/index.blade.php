@extends('dashboard.praktikan.praktikan-base')

@section('page-title', 'SAINS | Pengumuman')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- HEADER --}}
        <div class="mb-8 text-center md:text-left">
            <h1 class="text-2xl font-bold text-gray-800">Papan Pengumuman</h1>
            <p class="text-sm text-gray-500 mt-1">Informasi terbaru dari Asisten dan Dosen.</p>
        </div>

        {{-- DAFTAR PENGUMUMAN --}}
        <div class="space-y-6">
            @forelse ($announcements as $index => $announcement)
                <div class="flex gap-4 group">

                    {{-- Avatar (Inisial Nama Pengirim) --}}
                    <div class="flex-shrink-0">
                        <div
                            class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-sm border-2 border-white shadow-sm">
                            {{ substr($announcement->user->nama, 0, 1) }}
                        </div>
                    </div>

                    {{-- Konten Pengumuman --}}
                    <div class="flex-1">
                        {{-- Meta Data (Nama & Waktu) --}}
                        <div class="flex items-baseline justify-between mb-1">
                            <h3 class="text-sm font-bold text-gray-900">{{ $announcement->user->nama }}</h3>
                            <span class="text-xs text-gray-500">
                                {{ $announcement->created_at->timezone('Asia/Makassar')->format('d M Y, H:i') }} WITA
                            </span>
                        </div>

                        {{-- Chat Bubble / Card --}}
                        <div
                            class="bg-white p-5 rounded-2xl rounded-tl-none shadow-sm border border-gray-200 relative hover:shadow-md transition-shadow duration-200">

                            {{-- Isi Pesan --}}
                            <div class="text-sm text-gray-700 leading-relaxed whitespace-pre-line mb-3">
                                {{ $announcement->content }}
                            </div>

                            {{-- File Lampiran --}}
                            @if ($announcement->file_location)
                                @php
                                    $extension = pathinfo($announcement->file_location, PATHINFO_EXTENSION);
                                    $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                @endphp

                                <div class="mt-3 pt-3 border-t border-gray-100">
                                    <a href="{{ asset('storage/' . $announcement->file_location) }}" target="_blank"
                                        class="inline-flex items-center gap-3 p-2 pr-4 bg-gray-50 border border-gray-200 rounded-lg hover:bg-indigo-50 hover:border-indigo-200 transition group/file w-full sm:w-auto">

                                        {{-- Icon File --}}
                                        <div
                                            class="p-2 bg-white rounded-md border border-gray-200 group-hover/file:border-indigo-200">
                                            @if ($isImage)
                                                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            @endif
                                        </div>

                                        {{-- Text File --}}
                                        <div class="flex flex-col text-left">
                                            <span
                                                class="text-xs font-semibold text-gray-700 group-hover/file:text-indigo-700">Unduh
                                                Lampiran</span>
                                            <span class="text-[10px] text-gray-500 uppercase">{{ $extension }}
                                                File</span>
                                        </div>

                                        {{-- Download Arrow Icon --}}
                                        <svg class="w-4 h-4 text-gray-400 ml-auto group-hover/file:text-indigo-500"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                        </svg>
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="flex flex-col items-center justify-center py-16 bg-white rounded-xl border-2 border-dashed border-gray-300 text-center">
                    <div class="p-4 bg-gray-50 rounded-full mb-3">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium text-gray-900">Tidak ada pengumuman</h3>
                    <p class="text-xs text-gray-500 mt-1">Belum ada informasi terbaru yang dibagikan.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
