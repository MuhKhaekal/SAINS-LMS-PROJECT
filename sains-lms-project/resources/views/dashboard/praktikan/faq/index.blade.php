@extends('dashboard.praktikan.praktikan-base')

@section('page-title', 'SAINS | FAQ')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- HERO SECTION --}}
        <div class="relative w-full h-48 md:h-64 rounded-2xl overflow-hidden mb-8 shadow-lg group">
            {{-- Background Image --}}
            <div style="background-image: url('/assets/images/background-halaqah.png');"
                class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105">
            </div>
            {{-- Gradient Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-transparent"></div>

            {{-- Content --}}
            <div class=" h-full flex flex-col justify-center px-6 md:px-12 text-white">
                <span class="text-white/80 text-sm md:text-lg font-medium tracking-wider mb-1 uppercase">Pusat Bantuan</span>
                <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-2" data-aos="fade-right">
                    Frequently Asked Questions
                </h1>
                <p class="text-white/80 text-sm md:text-base font-light max-w-xl" data-aos="fade-right" data-aos-delay="100">
                    Temukan jawaban atas pertanyaan umum seputar kegiatan halaqah dan materi.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            {{-- KOLOM KIRI: DAFTAR FAQ --}}
            <section class="lg:col-span-8 space-y-4">
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2 mb-4">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                    Pertanyaan Umum
                </h2>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    @forelse ($faqs->where('status', true) as $index => $faq)
                        <div class="border-b border-gray-100 last:border-0">
                            {{-- Accordion Button --}}
                            <button type="button"
                                class="w-full flex items-center justify-between p-5 text-left bg-white hover:bg-gray-50 transition-colors focus:outline-none group"
                                data-target="#accordion-body-{{ $faq->id }}">
                                <span
                                    class="font-semibold text-gray-800 text-sm md:text-base group-hover:text-indigo-600 transition-colors pr-4">
                                    {{ $faq->question }}
                                </span>
                                <div
                                    class="bg-gray-100 p-1.5 rounded-full group-hover:bg-indigo-100 transition-colors flex-shrink-0">
                                    <svg class="w-4 h-4 text-gray-500 group-hover:text-indigo-600 transition-transform duration-300"
                                        data-accordion-icon xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 5 5 1 1 5" />
                                    </svg>
                                </div>
                            </button>

                            {{-- Accordion Body --}}
                            <div id="accordion-body-{{ $faq->id }}"
                                class="max-h-0 overflow-hidden transition-all duration-500 ease-in-out bg-gray-50/50">
                                <div class="p-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-12 text-center">
                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                            <p class="text-gray-500 font-medium">Belum ada FAQ yang ditampilkan.</p>
                            <p class="text-gray-400 text-sm mt-1">Silakan ajukan pertanyaan baru melalui formulir di
                                samping.</p>
                        </div>
                    @endforelse
                </div>
            </section>

            {{-- KOLOM KANAN: FORM PENGAJUAN (Sticky) --}}
            <section class="lg:col-span-4 lg:sticky lg:top-6">
                <div class="bg-indigo-50 rounded-xl p-6 border border-indigo-100">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-white rounded-lg text-indigo-600 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-indigo-900">Punya Pertanyaan Lain?</h3>
                    </div>

                    <p class="text-sm text-indigo-700 mb-6 leading-relaxed">
                        Jika jawaban tidak ditemukan di FAQ, silakan kirimkan pertanyaan Anda kepada Asisten.
                    </p>

                    <form action="{{ route('faq-praktikan.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="question" class="sr-only">Pertanyaan Anda</label>
                            <textarea name="question" id="question" rows="5"
                                class="block w-full p-3 text-sm text-gray-900 bg-white rounded-lg border border-indigo-200 focus:ring-indigo-500 focus:border-indigo-500 resize-none placeholder-gray-400 shadow-sm transition"
                                placeholder="Tuliskan pertanyaan Anda secara detail disini..." required></textarea>
                        </div>

                        <x-secondary-button
                            class="w-full justify-center bg-indigo-600 text-white hover:bg-indigo-700 border-transparent">
                            {{ __('Kirim Pertanyaan') }}
                        </x-secondary-button>
                    </form>
                </div>
            </section>

        </div>
    </div>

    {{-- SCRIPT ACCORDION (Vanilla JS) --}}
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
                        content.style.maxHeight = content.scrollHeight +
                        "px"; // Needed for transition
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
