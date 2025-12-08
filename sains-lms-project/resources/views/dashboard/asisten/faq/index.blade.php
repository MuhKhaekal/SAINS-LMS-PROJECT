@extends('dashboard.asisten.asisten-base')

@section('page-title', 'SAINS | FAQ')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:mt-24">
        <div class="relative w-full h-48 md:h-64 rounded-2xl overflow-hidden mb-8 shadow-lg group">
            <div style="background-image: url('/assets/images/background-halaqah.png');"
                class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105">
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-transparent"></div>
            <div class="z-10 h-full flex flex-col justify-center px-6 md:px-12 text-white">
                <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-2" data-aos="fade-right">
                    FAQ Asisten
                </h1>
                <p class="text-white/80 text-sm md:text-lg font-light max-w-xl" data-aos="fade-right" data-aos-delay="100">
                    Kelola pertanyaan yang sering diajukan oleh praktikan di halaqah Anda.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <section class="lg:col-span-7 space-y-4">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Ditampilkan ke Praktikan
                    </h2>
                    <span
                        class="text-xs font-medium text-gray-500 bg-gray-100 px-2.5 py-1 rounded-full border border-gray-200">
                        {{ $faqs->where('status', true)->count() }} Pertanyaan
                    </span>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    @forelse ($faqs->where('status', true) as $index => $faq)
                        <div class="border-b border-gray-100 last:border-0">
                            <button type="button"
                                class="w-full flex items-center justify-between p-5 text-left bg-white hover:bg-gray-50 transition-colors focus:outline-none group"
                                data-target="#accordion-body-{{ $faq->id }}">
                                <span
                                    class="font-semibold text-gray-800 text-sm md:text-base group-hover:text-indigo-600 transition-colors">
                                    {{ $faq->question }}
                                </span>
                                <div class="bg-gray-100 p-1.5 rounded-full group-hover:bg-indigo-100 transition-colors">
                                    <svg class="w-4 h-4 text-gray-500 group-hover:text-indigo-600 transition-transform duration-300"
                                        data-accordion-icon xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 5 5 1 1 5" />
                                    </svg>
                                </div>
                            </button>

                            <div id="accordion-body-{{ $faq->id }}"
                                class="max-h-0 overflow-hidden transition-all duration-500 ease-in-out bg-gray-50/50">
                                <div class="p-5 border-t border-gray-100">
                                    <p class="text-sm text-gray-600 leading-relaxed mb-4">
                                        {{ $faq->answer }}
                                    </p>

                                    <div class="flex justify-end pt-3 border-t border-gray-200/60">
                                        <form action="{{ route('faq.deleteFromListFaqAsisten', ['id' => $faq->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="inline-flex items-center gap-1.5 text-xs font-medium text-red-600 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition-colors"
                                                title="Sembunyikan dari daftar">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                                                    </path>
                                                </svg>
                                                Sembunyikan
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-100 mb-3">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                    </path>
                                </svg>
                            </div>
                            <p class="text-gray-500 text-sm">Belum ada FAQ yang ditampilkan.</p>
                        </div>
                    @endforelse
                </div>
            </section>

            <section class="lg:col-span-5 space-y-4">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                            </path>
                        </svg>
                        Draf / Arsip
                    </h2>
                    <span
                        class="text-xs font-medium text-gray-500 bg-gray-100 px-2.5 py-1 rounded-full border border-gray-200">
                        {{ $faqs->where('status', false)->count() }} Item
                    </span>
                </div>

                <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 h-[500px] overflow-y-auto custom-scrollbar">
                    @forelse ($faqs->where('status', false) as $index => $faq)
                        <div
                            class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm mb-3 hover:shadow-md transition-shadow duration-200 group">

                            <div class="flex justify-between items-start gap-3 mb-2">
                                <h3 class="font-bold text-gray-800 text-sm leading-snug">{{ $faq->question }}</h3>

                                <div class="flex gap-1 shrink-0 opacity-60 group-hover:opacity-100 transition-opacity">
                                    <button type="button" data-modal-target="default-modal-update"
                                        data-modal-toggle="default-modal-update" data-id="{{ $faq->id }}"
                                        data-question="{{ $faq->question }}" data-answer="{{ $faq->answer }}"
                                        class="text-gray-500 hover:text-yellow-600 transition-colors p-1 rounded hover:bg-yellow-50"
                                        title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button type="button" data-modal-target="default-modal-delete"
                                        data-modal-toggle="default-modal-delete" data-id="{{ $faq->id }}"
                                        class="text-gray-500 hover:text-red-600 transition-colors p-1 rounded hover:bg-red-50"
                                        title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="text-xs text-gray-500 line-clamp-2 mb-3">
                                {{ $faq->answer ?? 'Belum ada jawaban.' }}
                            </div>

                            <div class="pt-3 border-t border-gray-100 flex justify-end">
                                @if ($faq->answer)
                                    <form action="{{ route('faq.addToListFaqAsisten', ['id' => $faq->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-sm transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                            Tampilkan
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs text-orange-500 italic bg-orange-50 px-2 py-1 rounded">
                                        Lengkapi jawaban dulu
                                    </span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center h-48 text-center">
                            <svg class="w-10 h-10 text-gray-300 mb-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                </path>
                            </svg>
                            <p class="text-gray-400 text-sm">Tidak ada draf tersimpan.</p>
                        </div>
                    @endforelse
                </div>
            </section>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const accordionBtns = document.querySelectorAll("[data-target]");

            accordionBtns.forEach(btn => {
                btn.addEventListener("click", () => {
                    const targetId = btn.getAttribute("data-target");
                    const content = document.querySelector(targetId);
                    const icon = btn.querySelector("[data-accordion-icon]");

                    // Toggle logic
                    if (content.classList.contains("max-h-0")) {
                        content.classList.remove("max-h-0");
                        content.style.maxHeight = content.scrollHeight + "px";
                        icon.classList.add("rotate-180");
                    } else {
                        content.style.maxHeight = content.scrollHeight + "px";
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

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f9fafb;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
    </style>


    <section>
        <style>
            body>div.bg-gray-900\/50,
            body>div.dark\:bg-gray-900\/80,
            body>div[data-modal-backdrop] {
                background-color: rgba(12, 11, 11, 0.2) !important;
                backdrop-filter: blur(6px) !important;
            }
        </style>

        <div id="default-modal-update" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full] max-h-full backdrop-blur-sm">

            <div class="relative p-4 w-full max-w-2xl max-h-full mt-28 md:mt-0">
                <div class="relative bg-primary rounded-lg shadow-sm px-4">
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                        <h3 class="text-xl font-semibold text-white">
                            Jawab Pertanyaan FAQ
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                            data-modal-hide="default-modal-update">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <form action="" method="POST" id="formUpdate">
                        @csrf
                        @method('PUT')
                        <div class="p-4 md:p-5 space-y-4 mb-4">
                            <div class="">
                                <p class="text-secondary">Pertanyaan</p>
                                <x-text-input-secondary id="question" class="block w-full mt-1" type="text"
                                    name="question" :value="old('question')" required autofocus autocomplete="username"
                                    placeholder="Masukkan Pertanyaan" />
                                <x-input-error :messages="$errors->get('question')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Jawaban</p>
                                <textarea id="answer" name="answer" rows="4"
                                    class="block bg-secondary border border-default-medium text-heading text-sm rounded-md 
                               focus:ring-brand focus:border-brand w-full p-3.5 shadow-xs placeholder:text-body mt-1"
                                    placeholder="Masukkan jawaban..."></textarea>
                            </div>
                        </div>

                        <div class="flex justify-center gap-5 p-4 md:p-5 border-t border-gray-200 rounded-b">
                            <x-delete-button class="text-center" data-modal-hide="default-modal-update">
                                {{ __('Batal') }}
                            </x-delete-button>
                            <x-secondary-button class="text-center">
                                {{ __('Simpan') }}
                            </x-secondary-button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('default-modal-update');
                const questionInput = modal.querySelector('#question');
                const answerInput = modal.querySelector('#answer');
                const form = modal.querySelector('form');


                document.querySelectorAll('[data-modal-target="default-modal-update"]').forEach(button => {
                    button.addEventListener('click', () => {

                        const id = button.getAttribute('data-id');
                        const question = button.getAttribute('data-question');
                        const answer = button.getAttribute('data-answer');


                        questionInput.value = question;
                        answerInput.value = answer;

                        if (form) {
                            form.action = `/faq-asisten/${id}`;
                        }
                    });
                });
            });
        </script>
    </section>

    <section>
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
                            <p class="text-secondary text-center mt-5">Apakah anda yakin menghapus data FAQ ini?</p>
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

                        deleteForm.action = `/faq-asisten/${id}`;
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
