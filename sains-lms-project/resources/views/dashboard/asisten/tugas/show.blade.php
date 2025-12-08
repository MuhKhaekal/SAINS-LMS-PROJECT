@extends('dashboard.asisten.asisten-base')

@section('page-title', $assignment->assignment_name)

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:mt-24">
        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
                    <span class="text-gray-700">Tugas</span>
                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span>Penilaian</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $assignment->assignment_name }}</h1>
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

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Instruksi Tugas</h3>
                <p class="text-sm text-gray-700 leading-relaxed">
                    {{ $assignment->description ?: 'Tidak ada deskripsi tambahan.' }}
                </p>
            </div>

            @php
                $path = $assignment->file_location;
                $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                $fileUrl = asset('storage/' . $path);
            @endphp

            <div class="p-6 bg-gray-100 flex items-center justify-center min-h-[300px]">
                @if ($extension === 'pdf')
                    <iframe src="{{ $fileUrl }}"
                        class="w-full h-[500px] rounded-lg shadow-sm border border-gray-200 bg-white"
                        frameborder="0"></iframe>
                @elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))
                    <img src="{{ $fileUrl }}" class="max-w-full max-h-[500px] object-contain rounded-lg shadow-sm" />
                @elseif (in_array($extension, ['mp3', 'wav', 'ogg']))
                    <div class="w-full max-w-lg bg-white p-6 rounded-xl shadow-sm">
                        <audio controls class="w-full">
                            <source src="{{ $fileUrl }}">
                        </audio>
                    </div>
                @else
                    <div class="text-center bg-white p-8 rounded-xl shadow-sm border border-gray-200 max-w-sm">
                        <div
                            class="w-16 h-16 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600 mb-4">File <strong>.{{ strtoupper($extension) }}</strong> tidak
                            dapat dipratinjau.</p>
                        <a href="{{ $fileUrl }}" download="{{ $assignment->assignment_name . '.' . $extension }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                            Download File Soal
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <form action="{{ route('periksa-tugas.update') }}" method="POST" id="gradingForm">
            @csrf

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div
                    class="px-6 py-4 border-b border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4 bg-gray-50 sticky top-0 z-10">
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">Penilaian Praktikan</h2>
                        <p class="text-xs text-gray-500">Total Pengumpulan: {{ $assignment->submissions->count() }}</p>
                    </div>

                    @if ($assignment->submissions->count())
                        <x-primary-button type="submit">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            Simpan Semua Nilai
                        </x-primary-button>
                    @endif
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-3 w-10 text-center">No</th>
                                <th scope="col" class="px-6 py-3 min-w-[200px]">Identitas Praktikan</th>
                                <th scope="col" class="px-6 py-3">File Jawaban</th>
                                <th scope="col" class="px-6 py-3 w-48 text-center">Nilai (0-100)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($assignment->submissions as $index => $submission)
                                <tr class="bg-white hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-center text-gray-500">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-xs font-bold text-indigo-700">
                                                {{ substr($submission->user->nama, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $submission->user->nama }}</p>
                                                <p class="text-xs text-gray-500 font-mono">{{ $submission->user->nim }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($submission->file_path)
                                            <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank"
                                                class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 hover:underline transition text-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                                Unduh Jawaban
                                            </a>
                                        @else
                                            <span class="text-gray-400 italic text-xs">Tidak ada file</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="score-wrapper flex items-center justify-center gap-1">
                                            <button type="button"
                                                class="btn-minus w-8 h-8 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg flex items-center justify-center transition border border-gray-300">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M20 12H4"></path>
                                                </svg>
                                            </button>

                                            <input type="number" name="score[{{ $submission->id }}]"
                                                class="score-input w-16 h-8 text-center text-sm font-semibold text-gray-800 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                                value="{{ $submission->score ?? 0 }}" min="0" max="100">

                                            <button type="button"
                                                class="btn-plus w-8 h-8 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg flex items-center justify-center transition border border-gray-300">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                </path>
                                            </svg>
                                            <p class="text-gray-500 font-medium">Belum ada tugas yang dikumpulkan</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const MIN = 0;
            const MAX = 100;

            document.querySelectorAll('.score-wrapper').forEach(wrapper => {
                const input = wrapper.querySelector('.score-input');
                const btnPlus = wrapper.querySelector('.btn-plus');
                const btnMinus = wrapper.querySelector('.btn-minus');

                function updateButtons(val) {
                    btnMinus.disabled = val <= MIN;
                    btnPlus.disabled = val >= MAX;

                    btnMinus.classList.toggle('opacity-50', val <= MIN);
                    btnPlus.classList.toggle('opacity-50', val >= MAX);
                }

                btnPlus.addEventListener('click', () => {
                    let v = parseInt(input.value) || 0;
                    if (v < MAX) {
                        input.value = ++v;
                        updateButtons(v);
                    }
                });

                btnMinus.addEventListener('click', () => {
                    let v = parseInt(input.value) || 0;
                    if (v > MIN) {
                        input.value = --v;
                        updateButtons(v);
                    }
                });

                input.addEventListener('input', () => {
                    let v = parseInt(input.value);
                    if (isNaN(v) || v < MIN) v = MIN;
                    if (v > MAX) v = MAX;
                    updateButtons(v);
                });

                updateButtons(parseInt(input.value) || 0);
            });
        });
    </script>


    @if (session('success'))
        <div id="alert-success"
            class="fixed top-4 right-4 z-50 flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 rounded-lg shadow-lg 
          opacity-0 translate-x-10 transition-all duration-500 ease-out"
            role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <div class="ms-3 text-sm font-medium">{{ session('success') }}</div>
        </div>

        <script>
            const alert = document.getElementById('alert-success');
            setTimeout(() => alert.classList.remove('opacity-0', 'translate-x-10'), 100);
            setTimeout(() => {
                alert.classList.add('opacity-0', 'translate-x-10');
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        </script>
    @endif

    @if (session('error'))
        <div id="alert-error"
            class="fixed top-4 right-4 z-50 flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 rounded-lg shadow-lg 
          opacity-0 translate-x-10 transition-all duration-500 ease-out"
            role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <div class="ms-3 text-sm font-medium">{{ session('error') }}</div>
        </div>

        <script>
            const alertError = document.getElementById('alert-error');
            setTimeout(() => alertError.classList.remove('opacity-0', 'translate-x-10'), 100);
            setTimeout(() => {
                alertError.classList.add('opacity-0', 'translate-x-10');
                setTimeout(() => alertError.remove(), 500);
            }, 5000);
        </script>
    @endif
@endsection
