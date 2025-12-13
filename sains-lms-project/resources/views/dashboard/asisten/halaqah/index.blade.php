@extends('dashboard.asisten.asisten-base')

@section('page-title', 'SAINS | Halaqah')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:mt-24">
        <div class="relative w-full h-48 md:h-64 rounded-2xl overflow-hidden mb-8 shadow-lg group">
            <div style="background-image: url('/assets/images/background-halaqah.png');"
                class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105">
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-transparent"></div>
            <div class="relative h-full flex flex-col justify-center px-6 md:px-12">
                <span class="text-white/80 text-sm md:text-lg font-medium tracking-wider mb-1 uppercase">Dashboard
                    Asisten</span>
                <h1 class="text-3xl md:text-5xl font-bold text-white leading-tight" data-aos="fade-right">
                    {{ $selectedHalaqah->halaqah_name }}
                </h1>
            </div>
        </div>

        <section class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <a href="#"
                class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
                <div class="flex flex-col items-center text-center gap-3">
                    <div
                        class="p-3 bg-red-50 text-red-600 rounded-full group-hover:bg-red-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm2-2a1 1 0 1 0 0 2h3a1 1 0 1 0 0-2h-3Zm0 3a1 1 0 1 0 0 2h3a1 1 0 1 0 0-2h-3Zm-6 4a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-6Zm8 1v1h-2v-1h2Zm0 3h-2v1h2v-1Zm-4-3v1H9v-1h2Zm0 3H9v1h2v-1Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-xs md:text-sm font-bold text-gray-700">Akumulasi Nilai</span>
                </div>
            </a>

            <a href="{{ route('pretest.index', ['halaqah_name' => $selectedHalaqah->halaqah_name]) }}"
                class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
                <div class="flex flex-col items-center text-center gap-3">
                    <div
                        class="p-3 bg-yellow-50 text-yellow-600 rounded-full group-hover:bg-yellow-500 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-3 8a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Zm2 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-xs md:text-sm font-bold text-gray-700">Nilai Pre-Test</span>
                </div>
            </a>

            <a href="{{ route('nilai-perpekan.index', ['halaqah_name' => $selectedHalaqah->halaqah_name]) }}"
                class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
                <div class="flex flex-col items-center text-center gap-3">
                    <div
                        class="p-3 bg-emerald-50 text-emerald-600 rounded-full group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm-1 9a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2Zm2-5a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1Zm4 4a1 1 0 1 0-2 0v3a1 1 0 1 0 2 0v-3Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-xs md:text-sm font-bold text-gray-700">Nilai Per-pekan</span>
                </div>
            </a>

            <a href="#"
                class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
                <div class="flex flex-col items-center text-center gap-3">
                    <div
                        class="p-3 bg-cyan-50 text-cyan-600 rounded-full group-hover:bg-cyan-700 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-3 8a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Zm2 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-xs md:text-sm font-bold text-gray-700">Nilai Post-Test</span>
                </div>
            </a>
        </section>

        <section class="space-y-4">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Daftar Pertemuan</h2>

            @forelse ($meetings as $index => $meeting)
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">

                    <button type="button"
                        class="w-full flex items-center justify-between p-5 bg-white hover:bg-gray-50 transition-colors focus:outline-none group"
                        data-target="#accordion-body-{{ $index }}">

                        <div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-4 text-left">
                            <span
                                class="bg-indigo-100 text-indigo-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide w-fit">
                                {{ $meeting->meeting_name }}
                            </span>

                            <span
                                class="text-sm md:text-base font-bold text-gray-800 group-hover:text-indigo-600 transition-colors">
                                {{ $meeting->topic }}
                            </span>
                        </div>

                        <div class="bg-gray-100 p-1.5 rounded-full group-hover:bg-indigo-100 transition-colors">
                            <svg class="w-4 h-4 text-gray-500 group-hover:text-indigo-600 transition-transform duration-300"
                                data-accordion-icon xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5 5 1 1 5" />
                            </svg>
                        </div>
                    </button>

                    <div id="accordion-body-{{ $index }}"
                        class="max-h-0 overflow-hidden transition-all duration-500 ease-in-out bg-gray-50/50">
                        <div class="p-5 border-t border-gray-100">

                            <p class="text-sm text-gray-600 mb-6 leading-relaxed">
                                {{ $meeting->description }}
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <a href="{{ route('presensi-asisten.index', ['meeting_name' => $meeting->meeting_name, 'halaqah_name' => $selectedHalaqah->halaqah_name]) }}"
                                    class="flex items-center gap-3 p-3 bg-white border border-indigo-100 rounded-lg hover:border-indigo-300 hover:shadow-sm transition group">
                                    <div
                                        class="p-2 bg-indigo-50 text-indigo-600 rounded-lg group-hover:bg-indigo-600 group-hover:text-white transition">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <span
                                        class="text-sm font-semibold text-gray-700 group-hover:text-indigo-600">Presensi</span>
                                </a>

                                @if ($meeting->type == 'pretest')
                                    <a href="{{ route('pretest.create', ['halaqah_name' => $selectedHalaqah->halaqah_name]) }}"
                                        class="flex items-center gap-3 p-3 bg-white border border-rose-100 rounded-lg hover:border-rose-300 hover:shadow-sm transition group">
                                        <div
                                            class="p-2 bg-yellow-50 text-yellow-600 rounded-lg group-hover:bg-yellow-600 group-hover:text-white transition">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-3 8a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Zm2 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-700 group-hover:text-yellow-600">Mulai
                                            Pre-test</span>
                                    </a>
                                @endif
                                @if ($meeting->type == 'posttest')
                                    <a href="{{ route('posttest.create', ['halaqah_name' => $selectedHalaqah->halaqah_name]) }}"
                                        class="flex items-center gap-3 p-3 bg-white border border-cyan-100 rounded-lg hover:border-cyan-300 hover:shadow-sm transition group">
                                        <div
                                            class="p-2 bg-cyan-50 text-cyan-700 rounded-lg group-hover:bg-cyan-700 group-hover:text-white transition">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-3 8a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Zm2 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-700 group-hover:text-cyan-700">Mulai
                                            Post-test</span>
                                    </a>
                                @endif
                                @if ($meeting->type == 'ujian')
                                    <a href="{{ route('ujian-asisten.index', ['meeting_name' => $meeting->meeting_name, 'halaqah_name' => $selectedHalaqah->halaqah_name]) }}"
                                        class="flex items-center gap-3 p-3 bg-white border border-rose-100 rounded-lg hover:border-rose-300 hover:shadow-sm transition group">
                                        <div
                                            class="p-2 bg-rose-50 text-rose-600 rounded-lg group-hover:bg-rose-600 group-hover:text-white transition">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-3 8a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Zm2 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-700 group-hover:text-rose-600">Mulai
                                            Ujian</span>
                                    </a>
                                @endif


                                @if ($meeting->type == 'ramah-tamah')
                                    <a href="{{ route('asisten.sertifikat.validasi', ['halaqah_name' => $selectedHalaqah->halaqah_name]) }}"
                                        class="flex items-center gap-3 p-3 bg-white border border-amber-100 rounded-lg hover:border-amber-300 hover:shadow-sm transition group">

                                        <div
                                            class="p-2 bg-amber-50 text-amber-600 rounded-lg group-hover:bg-amber-600 group-hover:text-white transition">
                                            {{-- Ikon Clipboard Check --}}
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                                </path>
                                            </svg>
                                        </div>

                                        <span class="text-sm font-semibold text-gray-700 group-hover:text-amber-600">
                                            Sahkan Sertifikat Praktikan
                                        </span>
                                    </a>

                                    @if ($hasSertifUmum)
                                        <a href="{{ route('sertifikat.download', ['type' => 'sertifikat-asisten-umum']) }}"
                                            target="_blank"
                                            class="flex items-center gap-3 p-3 bg-white border border-emerald-100 rounded-lg hover:border-emerald-300 hover:shadow-sm transition group">

                                            <div
                                                class="p-2 bg-emerald-50 text-emerald-600 rounded-lg group-hover:bg-emerald-600 group-hover:text-white transition">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                            </div>

                                            <span class="text-sm font-semibold text-gray-700 group-hover:text-emerald-600">
                                                Klaim Sertifikat Asisten
                                            </span>
                                        </a>
                                    @endif

                                    @if ($hasSertifTerbaik)
                                        <a href="{{ route('sertifikat.download', ['type' => $typeTerbaik]) }}"
                                            target="_blank"
                                            class="flex items-center gap-3 p-3 bg-gradient-to-r from-yellow-50 to-white border border-yellow-200 rounded-lg hover:border-yellow-400 hover:shadow-md transition group relative overflow-hidden">

                                            <div
                                                class="absolute top-0 right-0 -mt-2 -mr-2 w-10 h-10 bg-yellow-300 rounded-full opacity-30 blur-lg">
                                            </div>

                                            <div
                                                class="p-2 bg-yellow-100 text-yellow-600 rounded-lg group-hover:bg-yellow-500 group-hover:text-white transition z-10">
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            </div>

                                            <span class="text-sm font-bold text-gray-800 group-hover:text-yellow-600 z-10">
                                                Klaim Sertifikat {{ $labelTerbaik }}
                                            </span>
                                        </a>
                                    @endif
                                @endif

                                @if ($meeting->type == 'skk')
                                    <a href="{{ route('materi-asisten.index', ['meeting_name' => $meeting->meeting_name, 'halaqah_name' => $selectedHalaqah->halaqah_name]) }}"
                                        class="flex items-center gap-3 p-3 bg-white border border-cyan-100 rounded-lg hover:border-cyan-300 hover:shadow-sm transition group">
                                        <div
                                            class="p-2 bg-cyan-50 text-cyan-600 rounded-lg group-hover:bg-cyan-600 group-hover:text-white transition">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v6.41A7.5 7.5 0 1 0 10.5 22H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z"
                                                    clip-rule="evenodd" />
                                                <path fill-rule="evenodd"
                                                    d="M9 16a6 6 0 1 1 12 0 6 6 0 0 1-12 0Zm6-3a1 1 0 0 1 1 1v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 1 1 0-2h1v-1a1 1 0 0 1 1-1Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-700 group-hover:text-cyan-600">Unggah
                                            Materi</span>
                                    </a>

                                    <a href="{{ route('tugas-asisten.index', ['meeting_name' => $meeting->meeting_name, 'halaqah_name' => $selectedHalaqah->halaqah_name]) }}"
                                        class="flex items-center gap-3 p-3 bg-white border border-orange-100 rounded-lg hover:border-orange-300 hover:shadow-sm transition group">
                                        <div
                                            class="p-2 bg-orange-50 text-orange-600 rounded-lg group-hover:bg-orange-500 group-hover:text-white transition">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M8 7V2.221a2 2 0 0 0-.5.365L3.586 6.5a2 2 0 0 0-.365.5H8Zm2 0V2h7a2 2 0 0 1 2 2v.126a5.087 5.087 0 0 0-4.74 1.368v.001l-6.642 6.642a3 3 0 0 0-.82 1.532l-.74 3.692a3 3 0 0 0 3.53 3.53l3.694-.738a3 3 0 0 0 1.532-.82L19 15.149V20a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z"
                                                    clip-rule="evenodd" />
                                                <path fill-rule="evenodd"
                                                    d="M17.447 8.08a1.087 1.087 0 0 1 1.187.238l.002.001a1.088 1.088 0 0 1 0 1.539l-.377.377-1.54-1.542.373-.374.002-.001c.1-.102.22-.182.353-.237Zm-2.143 2.027-4.644 4.644-.385 1.924 1.925-.385 4.644-4.642-1.54-1.54Zm2.56-4.11a3.087 3.087 0 0 0-2.187.909l-6.645 6.645a1 1 0 0 0-.274.51l-.739 3.693a1 1 0 0 0 1.177 1.176l3.693-.738a1 1 0 0 0 .51-.274l6.65-6.646a3.088 3.088 0 0 0-2.185-5.275Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <span
                                            class="text-sm font-semibold text-gray-700 group-hover:text-orange-600">Unggah
                                            Tugas</span>
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-gray-50 border-2 border-dashed border-gray-300 rounded-xl p-8 text-center">
                    <p class="text-gray-500 italic">Belum ada data pertemuan yang tersedia.</p>
                </div>
            @endforelse
        </section>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const accordionBtns = document.querySelectorAll("[data-target]");

            accordionBtns.forEach(btn => {
                btn.addEventListener("click", () => {
                    const targetId = btn.getAttribute("data-target");
                    const content = document.querySelector(targetId);
                    const icon = btn.querySelector("[data-accordion-icon]");

                    if (content.classList.contains("max-h-0")) {
                        content.classList.remove("max-h-0");
                        content.style.maxHeight = content.scrollHeight + "px";
                        icon.classList.add("rotate-180");
                    } else {
                        content.style.maxHeight = content.scrollHeight +
                            "px";
                        setTimeout(() => {
                            content.style.maxHeight = "0px";
                            content.classList.add("max-h-0");
                        }, 10);
                        icon.classList.remove("rotate-180");
                    }
                });
            });
        });
    </script>
@endsection
