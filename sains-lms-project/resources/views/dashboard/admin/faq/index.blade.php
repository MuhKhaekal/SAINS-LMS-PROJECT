@extends('dashboard.admin.admin-base')

@section('page-title', 'SAINS - FAQ')

@section('content')
    <h1 class="font-extrabold text-2xl mt-20 md:mt-6 md:mx-12">Kelola FAQ</h1>


    <section class="md:flex md:flex-row-reverse md:mx-12 md:gap-5">
        <section class="md:flex-1">

            <section class="">
                <div id="accordion-1" class="my-2">
                    @forelse ($faqs->where('status', true) as $faq)
                        <div class="mb-2">
                            <button id="accordion-button-{{ $faq->id }}" type="button"
                                class="shadow-md flex text-xs md:text-sm items-center justify-between w-full p-5 font-medium bg-white transition-colors duration-300 focus:outline-none"
                                data-target="#accordion-body{{ $faq->id }}" aria-expanded="false"
                                aria-controls="accordion-body{{ $faq->id }}">
                                <span class="font-bold flex-1 text-start">{{ $faq->question }}</span>
                                <svg data-accordion-icon class="w-3 h-3 shrink-0" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>

                            <div id="accordion-body{{ $faq->id }}"
                                class="max-h-0 overflow-hidden transition-all duration-500 ease-in-out" role="region"
                                aria-labelledby="accordion-button-{{ $faq->id }}">
                                <div class="p-5 border border-b-0 border-gray-200 bg-white text-xs md:text-sm">
                                    <p class="mb-2 text-black">
                                        {{ $faq->answer }}
                                    </p>
                                    <form action="{{ route('faq.deleteFromListFaq', ['id' => $faq->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <x-delete-button-submit class="text-center">
                                            {{ __('Hapus dari Daftar') }}
                                        </x-delete-button-submit>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="font-normal text-center text-gray-400 italic my-2">Belum ada FAQ yang ditampilkan</p>
                    @endforelse
                </div>
            </section>
        </section>

        <section
            class="overflow-y-auto h-60 md:min-h-screen border border-dashed rounded-md border-blue-200 mt-5 p-2 text-xs md:text-sm md:flex-1">
            @forelse ($faqs->where('status', false) as $faq)
                <div class="bg-white p-4 rounded-md mb-2">
                    <h1 class="font-bold">{{ $faq->question }}</p>
                        @if ($faq->answer)
                            <p class="font-normal my-2">{{ $faq->answer }}</p>
                        @else
                            <p class="font-normal text-center text-gray-400 italic my-2">Belum ada jawaban</p>
                        @endif
                        <div class="flex justify-between mt-2">
                            @if ($faq->answer)
                                <x-edit-button class="text-center me-3" data-modal-target="default-modal-update"
                                    data-modal-toggle="default-modal-update" data-id="{{ $faq->id }}"
                                    data-question="{{ $faq->question }}" data-answer="{{ $faq->answer }}">
                                    {{ __('Edit Jawaban') }}
                                </x-edit-button>
                            @else
                                <x-primary-button class="text-center me-3" data-modal-target="default-modal-update"
                                    data-modal-toggle="default-modal-update" data-id="{{ $faq->id }}"
                                    data-question="{{ $faq->question }}" data-answer="{{ $faq->answer }}">
                                    {{ __('Jawab') }}
                                </x-primary-button>
                            @endif
                            <form action="{{ route('faq.addToListFaq', ['id' => $faq->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <x-secondary-button class="text-center">
                                    {{ __('Tambahkan') }}
                                </x-secondary-button>
                            </form>

                        </div>
                </div>
            @empty
            @endforelse

        </section>
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

        <div id="default-modal-update" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full] max-h-full backdrop-blur-sm
         ">

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
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
                            form.action = `/faq/${id}`;
                        }
                    });
                });
            });
        </script>
    </section>


    <script>
        document.querySelectorAll("[data-target]").forEach(btn => {
            btn.addEventListener("click", () => {
                const content = document.querySelector(btn.dataset.target);
                const icon = btn.querySelector("svg");

                if (content.classList.contains("max-h-0")) {
                    // buka smooth
                    content.style.maxHeight = content.scrollHeight + "px";
                    content.classList.remove("max-h-0");
                    icon.classList.add("rotate-180"); // 🔄 ikon berputar
                } else {
                    // tutup smooth
                    content.style.maxHeight = content.scrollHeight + "px";
                    setTimeout(() => {
                        content.style.maxHeight = "0px";
                        content.classList.add("max-h-0");
                    }, 10);
                    icon.classList.remove("rotate-180"); // 🔄 ikon balik lagi
                }
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
        </script>
    @endif
@endsection
