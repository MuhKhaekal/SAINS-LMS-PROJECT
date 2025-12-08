@extends('dashboard.asisten.asisten-base')

@section('page-title', 'SAINS | Pretest')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:mt-24">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Kelola Sesi Ujian</h1>
                <p class="text-sm text-gray-500 mt-1">Buka akses ujian agar praktikan dapat mulai mengerjakan.</p>
            </div>
            <div>
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            @if ($testSession && $testSession->is_open)
                <div
                    class="bg-green-50 border-b border-green-100 px-6 py-3 flex items-center justify-center md:justify-start gap-2 text-green-700 text-sm font-medium animate-pulse">
                    <span class="relative flex h-3 w-3">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                    </span>
                    Sesi Ujian Sedang Berlangsung
                </div>
            @endif

            <div class="p-6 md:p-8 flex flex-col md:flex-row gap-8 md:gap-12">
                <div class="flex-1 space-y-6">
                    <div>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                        {{ $test->test_type == 'POSTTEST' ? 'bg-cyan-50 text-cyan-700 border border-cyan-200' : 'bg-yellow-50 text-yellow-700 border border-yellow-200' }}">
                            {{ $test->test_type }}
                        </span>
                    </div>

                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-3">{{ $test->title }}</h2>
                        <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                            {{ $test->description ?: 'Tidak ada deskripsi tambahan untuk ujian ini.' }}
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-6 pt-4 border-t border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-indigo-50 text-indigo-600 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium uppercase">Jumlah Soal</p>
                                <p class="text-base font-bold text-gray-800">{{ count($questions) }} Soal</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-pink-50 text-pink-600 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium uppercase">Durasi Waktu</p>
                                <p class="text-base font-bold text-gray-800">{{ $test->duration }} Menit</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="md:w-1/3 flex flex-col justify-center items-center bg-gray-50 rounded-xl border border-gray-200 p-6 text-center">

                    @if ($testSession && $testSession->is_open)
                        <div
                            class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Akses Terbuka</h3>
                        <p class="text-sm text-gray-500 mb-6">Mahasiswa dapat mengakses dan mengerjakan ujian sekarang.</p>

                        <form action="{{ route('ujian-asisten.close', $test->id) }}" method="POST" class="w-full">
                            @csrf
                            <x-danger-button class="w-full justify-center py-3 text-base">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                                Tutup Tes
                            </x-danger-button>
                        </form>
                    @else
                        <div class="w-16 h-16 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Akses Tertutup</h3>
                        <p class="text-sm text-gray-500 mb-6">Klik tombol di bawah untuk membuka akses ujian bagi mahasiswa.
                        </p>

                        <form action="{{ route('ujian-asisten.open', $test->id) }}" method="POST" class="w-full">
                            @csrf
                            <x-primary-button
                                class="w-full justify-center py-3 text-base bg-indigo-600 hover:bg-indigo-700">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Buka Tes
                            </x-primary-button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
