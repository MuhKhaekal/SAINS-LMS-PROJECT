@extends('dashboard.praktikan.praktikan-base')

@section('page-title', 'SAINS | Tugas')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Daftar Tugas</h1>
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
                    Kembali
                </a>
            </div>
        </div>

        {{-- LIST TUGAS --}}
        <div class="space-y-6">
            @forelse ($assignments as $index => $assignment)
                @php
                    // Cek apakah user sudah mengumpulkan tugas ini
                    $submitted = $userSubmissions[$assignment->id] ?? null;

                    // Setup file soal
                    $path = $assignment->file_location;
                    $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                    $fileUrl = asset('storage/' . $path);
                @endphp

                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div class="flex flex-col md:flex-row">

                        {{-- BAGIAN KIRI: INFO TUGAS --}}
                        <div class="p-6 md:w-2/3 border-b md:border-b-0 md:border-r border-gray-100">
                            <div class="flex items-center gap-3 mb-3">
                                <span
                                    class="bg-indigo-100 text-indigo-700 text-xs font-bold px-2.5 py-0.5 rounded border border-indigo-200">
                                    Tugas #{{ $index + 1 }}
                                </span>
                                <h2 class="text-lg font-bold text-gray-800">{{ $assignment->assignment_name }}</h2>
                            </div>

                            <p class="text-sm text-gray-600 leading-relaxed mb-4">
                                {{ $assignment->description ?: 'Tidak ada instruksi khusus.' }}
                            </p>

                            {{-- Tombol Download Soal --}}
                            <div class="flex items-center gap-2">
                                <a href="{{ $fileUrl }}"
                                    download="{{ $assignment->assignment_name . '.' . $extension }}"
                                    class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-50 text-gray-700 border border-gray-200 rounded-lg text-xs font-medium hover:bg-gray-100 transition">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                    Download Soal ({{ strtoupper($extension) }})
                                </a>
                            </div>
                        </div>

                        {{-- BAGIAN KANAN: STATUS PENGUMPULAN --}}
                        <div class="p-6 md:w-1/3 bg-gray-50 flex flex-col justify-center">

                            @if ($submitted)
                                {{-- KONDISI: SUDAH MENGUMPULKAN --}}
                                <div class="text-center">
                                    <div
                                        class="inline-flex items-center justify-center w-10 h-10 bg-green-100 text-green-600 rounded-full mb-2">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-bold text-gray-800">Sudah Dikumpulkan</h3>
                                    <p class="text-xs text-gray-500 mb-4">{{ $submitted->created_at->diffForHumans() }}</p>

                                    {{-- Cek Nilai --}}
                                    @if (!is_null($submitted->score))
                                        <div class="bg-white border border-gray-200 rounded-lg p-3 mb-2">
                                            <span class="block text-xs text-gray-500 uppercase">Nilai</span>
                                            <span class="text-2xl font-bold text-indigo-600">{{ $submitted->score }}</span>
                                        </div>
                                    @else
                                        {{-- File Jawaban & Aksi --}}
                                        <div class="space-y-2">
                                            <a href="{{ asset('storage/' . $submitted->file_location) }}" target="_blank"
                                                class="block w-full py-2 text-xs font-medium text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded border border-indigo-200 text-center transition">
                                                Lihat Jawaban Saya
                                            </a>
                                            <div class="flex gap-2">
                                                <a href="{{ route('pengajuan-tugas.edit', $submitted->id) }}"
                                                    class="flex-1 py-2 text-xs font-medium text-yellow-700 bg-yellow-50 hover:bg-yellow-100 rounded border border-yellow-200 text-center transition">
                                                    Edit
                                                </a>
                                                <button type="button" data-modal-target="default-modal-delete"
                                                    data-modal-toggle="default-modal-delete" data-id="{{ $submitted->id }}"
                                                    class="flex-1 py-2 text-xs font-medium text-red-700 bg-red-50 hover:bg-red-100 rounded border border-red-200 text-center transition">
                                                    Hapus
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @else
                                {{-- KONDISI: BELUM MENGUMPULKAN --}}
                                <div class="text-center">
                                    <div
                                        class="inline-flex items-center justify-center w-10 h-10 bg-gray-200 text-gray-500 rounded-full mb-2">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-bold text-gray-800">Belum Mengumpulkan</h3>
                                    <p class="text-xs text-gray-500 mb-4">Silakan kerjakan dan upload jawaban.</p>

                                    <a href="{{ route('pengajuan-tugas.index', [
                                        'meeting_name' => $selectedMeeting->meeting_name,
                                        'halaqah_name' => $selectedHalaqah->halaqah_name,
                                        'assignment_id' => $assignment->id,
                                    ]) }}"
                                        class="block w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-lg shadow-sm transition transform hover:-translate-y-0.5">
                                        Kumpulkan Tugas
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            @empty
                {{-- EMPTY STATE --}}
                <div
                    class="flex flex-col items-center justify-center py-16 bg-white rounded-xl border-2 border-dashed border-gray-300 text-center">
                    <div class="p-4 bg-gray-50 rounded-full mb-3">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Tidak ada tugas</h3>
                    <p class="text-sm text-gray-500 mt-1">Belum ada tugas yang diberikan untuk pertemuan ini.</p>
                </div>
            @endforelse
        </div>

        <section>
            <style>
                body>div.bg-gray-900\/50,
                body>div.dark\:bg-gray-900\/80,
                body>div[data-modal-backdrop] {
                    background-color: rgba(12, 11, 11, 0.2) !important;
                    backdrop-filter: blur(6px) !important;
                }
            </style>
            <div id="default-modal-delete" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full] max-h-full backdrop-blur-sm
             ">

                <div class="relative p-4 w-full max-w-2xl max-h-full mt-36 md:mt-0">
                    <div class="relative bg-primary rounded-lg shadow-sm px-4">
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                            <h3 class="text-xl font-semibold text-white">
                                Konfirmasi
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                                data-modal-hide="default-modal-delete">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <div class="p-4 md:p-5 space-y-4">
                            <div class="flex flex-col items-center justify-center w-full">
                                <svg class="w-10 h-10 md:w-20 md:h-20 text-secondary" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="text-secondary text-center mt-5">Apakah anda yakin menghapus file pengajuan tugas
                                    ini?</p>
                            </div>
                        </div>

                        <div class="flex justify-center gap-5 p-4 md:p-5 border-t border-gray-200 rounded-b">
                            <x-delete-button class="text-center" data-modal-hide="default-modal-delete">
                                {{ __('Batal') }}
                            </x-delete-button>
                            <form id="deleteForm" action="" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-secondary-button class="text-center">
                                    {{ __('Hapus') }}
                                </x-secondary-button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const deleteModal = document.getElementById('default-modal-delete');
                    const deleteForm = document.getElementById('deleteForm');

                    document.querySelectorAll('[data-modal-target="default-modal-delete"]').forEach(button => {
                        button.addEventListener('click', () => {
                            const id = button.getAttribute('data-id');

                            deleteForm.action = `/pengajuan-tugas/${id}`;
                        });
                    });
                });
            </script>


        </section>

        {{-- SCRIPT MODAL HAPUS --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deleteButtons = document.querySelectorAll('[data-modal-target="default-modal-delete"]');
                const deleteForm = document.getElementById('deleteForm');

                deleteButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const id = button.getAttribute('data-id');
                        deleteForm.action = `/pengajuan-tugas/${id}`;
                    });
                });
            });
        </script>

    </div>

    @if (session('success'))
        <div id="alert-success"
            class="fixed top-4 right-4 z-50 flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 rounded-lg shadow-lg opacity-0 translate-x-10 transition-all duration-500 ease-out"
            role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
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
            class="fixed top-4 right-4 z-50 flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 rounded-lg shadow-lg opacity-0 translate-x-10 transition-all duration-500 ease-out"
            role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
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

            window.addEventListener("pageshow", function(event) {
                if (event.persisted) {
                    const alertSuccess = document.getElementById("alert-success");
                    const alertError = document.getElementById("alert-error");

                    if (alertSuccess) alertSuccess.remove();
                    if (alertError) alertError.remove();
                }
            });
        </script>
    @endif
@endsection
