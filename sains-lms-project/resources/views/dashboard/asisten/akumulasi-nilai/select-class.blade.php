@extends('dashboard.asisten.asisten-base')
@section('page-title', 'Konfigurasi Kelas PAI')

@section('content')
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:mt-24">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Konfigurasi Kelas</h1>
                <div class="flex items-center gap-2 mt-1 text-sm text-gray-500">
                    <span>{{ $selectedHalaqah->halaqah_name }}</span>
                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="font-medium text-gray-700">Setup Awal</span>
                </div>
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

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

            <div class="bg-indigo-50 border-b border-indigo-100 p-6 flex items-start gap-4">
                <div class="p-2 bg-white rounded-lg text-indigo-600 shadow-sm shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-indigo-900">Hubungkan Kelas PAI</h3>
                    <p class="text-sm text-indigo-700 mt-1 leading-relaxed">
                        Sebelum melihat akumulasi nilai, Anda perlu memilih <strong>Kelas PAI</strong> yang sesuai dengan
                        halaqah ini untuk sinkronisasi data Dosen dan Nilai Akhir.
                    </p>
                </div>
            </div>

            <div class="p-6 md:p-8">
                <form action="{{ route('akumulasi-nilai.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="halaqah_id" value="{{ $selectedHalaqah->id }}">
                    <input type="hidden" name="halaqah_name" value="{{ $selectedHalaqah->halaqah_name }}">

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Halaqah Binaan</label>
                            <div
                                class="flex items-center px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-500 select-none">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                                <span class="font-medium">{{ $selectedHalaqah->halaqah_name }}</span>
                            </div>
                        </div>

                        <div>
                            <label for="class_pai_id" class="block text-sm font-bold text-gray-800 mb-2">
                                Pilih Kelas PAI <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select name="class_pai_id" id="class_pai_id" required
                                    class="w-full pl-4 pr-10 py-3 border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 appearance-none bg-white transition">
                                    <option value="" disabled selected>-- Silakan Pilih Kelas --</option>
                                    @foreach ($classPais as $class)
                                        <option value="{{ $class->id }}">
                                            {{ $class->class_name }} &mdash; {{ $class->lecturer }}
                                        </option>
                                    @endforeach
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Data kelas ini akan digunakan untuk laporan akhir.
                            </p>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end">
                        <x-primary-button class="justify-center px-6 py-3 text-sm font-bold">
                            Simpan & Lanjutkan
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
