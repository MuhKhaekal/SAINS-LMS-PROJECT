@extends('dashboard.admin.admin-base')

@section('page-title', 'SAINS - Review Soal')

@section('content')
    <section class="m-4 md:mx-12 mt-20 md:mt-6">

        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Review Soal Pretest</h2>
                <p class="text-sm text-gray-600 mt-1">Kelola dan tinjau semua soal pretest</p>
            </div>
            <div class="text-sm bg-blue-50 text-blue-700 px-4 py-2 rounded-lg border border-blue-200">
                Total: <span class="font-bold">{{ count($questions) }}</span> soal
            </div>
        </div>

        @forelse ($questions as $index => $q)
            <div
                class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 mb-4 overflow-hidden">
                <div class="bg-secondary px-5 py-3 border-b border-gray-200 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="bg-primary text-white text-sm font-bold px-3 py-1 rounded-full">
                            {{ $index + 1 }}
                        </span>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                            {{ $q->type === 'mcq' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800' }}">
                            {{ $q->type === 'mcq' ? 'Pilihan Ganda' : 'Essay' }}
                        </span>
                    </div>

                    <button type="button" class="font-medium hover:underline" data-modal-target="default-modal-delete"
                        data-modal-toggle="default-modal-delete" data-id="{{ $q->id }}">
                        <svg class="w-7 h-7 text-secondary bg-red-500 hover:bg-red-600 hover:text-white rounded-md p-1"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                </div>

                <div class="px-5 py-4">
                    <div class="mb-4">
                        <p class="text-sm font-semibold text-gray-500 mb-2">Pertanyaan:</p>
                        <p class="text-gray-800 leading-relaxed text-base">
                            {{ $q->question }}
                        </p>
                    </div>

                    @if ($q->type === 'mcq')
                        <div class="mt-4">
                            <p class="text-sm font-semibold text-gray-500 mb-3">Pilihan Jawaban:</p>
                            <div class="space-y-2">
                                @foreach ($q->options as $optIndex => $option)
                                    <div
                                        class="flex items-start gap-3 p-3 rounded-lg border transition-all duration-200
                                        {{ $option->is_correct
                                            ? 'bg-green-50 border-green-300 shadow-sm'
                                            : 'bg-gray-50 border-gray-200 hover:border-gray-300' }}">
                                        <span
                                            class="flex-shrink-0 w-7 h-7 flex items-center justify-center rounded-full text-sm font-semibold
                                            {{ $option->is_correct ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-700' }}">
                                            {{ chr(65 + $optIndex) }}
                                        </span>
                                        <span class="flex-1 text-gray-800 {{ $option->is_correct ? 'font-semibold' : '' }}">
                                            {{ $option->option_text }}
                                        </span>
                                        @if ($option->is_correct)
                                            <span
                                                class="flex-shrink-0 inline-flex items-center gap-1 bg-green-500 text-white text-xs px-2 py-1 rounded-full font-medium">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if ($q->type === 'essay')
                        <div class="mt-4 bg-purple-50 border border-purple-200 rounded-lg p-4">
                            <p class="text-sm font-semibold text-purple-700 mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                                Jawaban Kunci Essay:
                            </p>
                            <p class="text-gray-800 leading-relaxed">
                                {{ $q->correct_answer ?? 'Tidak ada jawaban kunci yang ditentukan' }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-white border-2 border-dashed border-gray-300 rounded-lg p-12 text-center">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum ada soal pretest</h3>
                <p class="text-gray-500 mb-6">Mulai buat soal pretest pertama Anda untuk ditampilkan di sini</p>
                <a href="{{ route('buat-test.create') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs  text-secondary uppercase tracking-widest bg-primary hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Buat Soal Baru
                </a>
            </div>
        @endforelse

    </section>

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
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3
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
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3
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
