@extends('dashboard.admin.admin-base')

@section('page-title', 'SAINS - Review Soal')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Tinjau Soal Ujian</h1>
                <p class="text-sm text-gray-500 mt-1">Periksa kembali pertanyaan, opsi jawaban, dan kunci jawaban.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="bg-indigo-50 text-indigo-700 px-4 py-2 rounded-lg border border-indigo-100 text-sm font-medium">
                    Total: <span class="font-bold text-lg">{{ count($questions) }}</span> Soal
                </div>
                <a href="{{ url()->previous() }}"
                    class="text-gray-500 bg-white border border-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 hover:bg-gray-100 hover:text-gray-900 focus:z-10 transition">
                    Kembali
                </a>
            </div>
        </div>

        {{-- LIST SOAL --}}
        <div class="space-y-6">
            @forelse ($questions as $index => $q)
                <div
                    class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">

                    {{-- Question Header --}}
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <span
                                class="flex items-center justify-center w-8 h-8 rounded-full bg-indigo-600 text-white font-bold text-sm">
                                {{ $index + 1 }}
                            </span>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                            {{ $q->type === 'mcq' ? 'bg-indigo-100 text-indigo-700' : 'bg-pink-100 text-pink-700' }}">
                                {{ $q->type === 'mcq' ? 'Pilihan Ganda' : 'Uraian / Essay' }}
                            </span>
                        </div>

                        {{-- Delete Action --}}
                        <button type="button" data-modal-target="default-modal-delete"
                            data-modal-toggle="default-modal-delete" data-id="{{ $q->id }}"
                            class="text-gray-400 hover:text-red-600 p-2 rounded-lg hover:bg-red-50 transition"
                            title="Hapus Soal">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                        </button>
                    </div>

                    <div class="p-6">
                        {{-- Question Text --}}
                        <div class="mb-6">
                            <h3 class="text-gray-900 font-medium text-lg leading-relaxed">
                                {{ $q->question }}
                            </h3>
                        </div>

                        {{-- Options / Answer Key --}}
                        @if ($q->type === 'mcq')
                            <div class="space-y-3">
                                @foreach ($q->options as $optIndex => $option)
                                    <div
                                        class="relative flex items-center p-3 rounded-lg border transition-all duration-200
                                    {{ $option->is_correct
                                        ? 'bg-emerald-50 border-emerald-500 ring-1 ring-emerald-500'
                                        : 'bg-white border-gray-200' }}">

                                        {{-- Option Letter (A, B, C...) --}}
                                        <div
                                            class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold border mr-4
                                        {{ $option->is_correct
                                            ? 'bg-emerald-500 text-white border-emerald-500'
                                            : 'bg-gray-100 text-gray-500 border-gray-200' }}">
                                            {{ chr(65 + $optIndex) }}
                                        </div>

                                        {{-- Option Text --}}
                                        <div
                                            class="flex-1 text-sm {{ $option->is_correct ? 'text-emerald-900 font-medium' : 'text-gray-700' }}">
                                            {{ $option->option_text }}
                                        </div>

                                        {{-- Correct Indicator Icon --}}
                                        @if ($option->is_correct)
                                            <div
                                                class="absolute right-4 flex items-center justify-center w-6 h-6 bg-emerald-100 rounded-full">
                                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        @if ($q->type === 'essay')
                            <div class="bg-pink-50 border border-pink-200 rounded-lg p-4 mt-2">
                                <div class="flex items-center gap-2 mb-2 text-pink-700 font-semibold text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                                        </path>
                                    </svg>
                                    Kunci Jawaban / Poin Penting:
                                </div>
                                <p class="text-gray-700 text-sm leading-relaxed">
                                    {{ $q->correct_answer ?? 'Tidak ada kunci jawaban spesifik yang diatur.' }}
                                </p>
                                @if (isset($q->maxWords))
                                    <div class="mt-3 pt-2 border-t border-pink-200 text-xs text-pink-600 text-right">
                                        Maksimal Karakter: {{ $q->maxWords }}
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                {{-- Empty State --}}
                <div class="text-center py-16 bg-white rounded-xl border-2 border-dashed border-gray-300">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Belum ada soal ujian</h3>
                    <p class="text-gray-500 mt-1 mb-6 max-w-sm mx-auto">Mulai tambahkan soal pilihan ganda atau essay untuk
                        melengkapi ujian ini.</p>
                    <a href="{{ route('buat-test.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Buat Soal Baru
                    </a>
                </div>
            @endforelse
        </div>

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
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
                            <p class="text-secondary text-center mt-5">Apakah anda yakin menghapus soal ini?</p>
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

                        deleteForm.action = `/buat-test/${id}`;
                    });
                });
            });
        </script>


    </section>

    @if (session('success'))
        <div id="alert-success"
            class="fixed top-4 right-4 z-50 flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 rounded-lg shadow-lg 
          opacity-0 translate-x-10 transition-all duration-500 ease-out"
            role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3
                                                                                                           1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1
                                                                                                           1 1v4h1a1 1 0 0 1 0 2Z" />
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
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3
                                                                                                           1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1
                                                                                                           1 1v4h1a1 1 0 0 1 0 2Z" />
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
