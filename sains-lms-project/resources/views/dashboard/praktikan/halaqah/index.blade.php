@extends('dashboard.praktikan.praktikan-base')

@section('page-title', 'SAINS | Halaqah')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:mt-24">
        <div class="relative w-full h-48 md:h-64 rounded-2xl overflow-hidden mb-8 shadow-lg group">
            <div style="background-image: url('/assets/images/background-halaqah.png');"
                class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105">
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-transparent"></div>

            <div class=" h-full flex flex-col justify-center px-6 md:px-12 text-white">
                <span class="text-white/80 text-sm md:text-lg font-medium tracking-wider mb-1 uppercase">Ruang Belajar</span>
                <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-2" data-aos="fade-right">
                    {{ $selectedHalaqah->halaqah_name }}
                </h1>
                <p class="text-white/80 text-sm md:text-base font-light max-w-xl" data-aos="fade-right" data-aos-delay="100">
                    Selamat belajar! Akses materi, kerjakan tugas, dan ikuti ujian melalui daftar pertemuan di bawah ini.
                </p>
            </div>
        </div>

    
        <section class="space-y-4">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Daftar Pertemuan & Aktivitas</h2>

            @forelse ($meetings as $index => $meeting)
                <div
                    class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">

                    <button type="button"
                        class="w-full flex items-center justify-between p-5 bg-white hover:bg-gray-50 transition-colors focus:outline-none group"
                        data-target="#accordion-body-{{ $index }}">

                        <div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-4 text-left">
                            <span
                                class="bg-indigo-100 text-indigo-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide w-fit border border-indigo-200">
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
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @if ($meeting->type == 'ujian')
                                    <a href="{{ route('ujian-praktikan.index', ['meeting_name' => $meeting->meeting_name, 'halaqah_name' => $selectedHalaqah->halaqah_name]) }}"
                                        class="flex items-center gap-3 p-4 bg-white border border-rose-100 rounded-xl hover:border-rose-300 hover:shadow-sm transition group">
                                        <div
                                            class="p-3 bg-rose-50 text-rose-600 rounded-lg group-hover:bg-rose-600 group-hover:text-white transition">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M5.617 2.076a1 1 0 0 1 1.09.217L8 3.586l1.293-1.293a1 1 0 0 1 1.414 0L12 3.586l1.293-1.293a1 1 0 0 1 1.414 0L16 3.586l1.293-1.293A1 1 0 0 1 19 3v18a1 1 0 0 1-1.707.707L16 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L12 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L8 20.414l-1.293 1.293A1 1 0 0 1 5 21V3a1 1 0 0 1 .617-.924ZM9 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-gray-800 group-hover:text-rose-600">Mulai
                                                Ujian</span>
                                            <span class="text-xs text-gray-500">Kerjakan soal evaluasi</span>
                                        </div>
                                    </a>
                                @endif

                                @if ($meeting->type == 'skk')
                                    <a href="{{ route('materi-praktikan.index', ['meeting_name' => $meeting->meeting_name, 'halaqah_name' => $selectedHalaqah->halaqah_name]) }}"
                                        class="flex items-center gap-3 p-4 bg-white border border-cyan-100 rounded-xl hover:border-cyan-300 hover:shadow-sm transition group">
                                        <div
                                            class="p-3 bg-cyan-50 text-cyan-600 rounded-lg group-hover:bg-cyan-600 group-hover:text-white transition">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v6.41A7.5 7.5 0 1 0 10.5 22H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z"
                                                    clip-rule="evenodd" />
                                                <path fill-rule="evenodd"
                                                    d="M9 16a6 6 0 1 1 12 0 6 6 0 0 1-12 0Zm6-3a1 1 0 0 1 1 1v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 1 1 0-2h1v-1a1 1 0 0 1 1-1Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-gray-800 group-hover:text-cyan-600">Pelajari
                                                Materi</span>
                                            <span class="text-xs text-gray-500">Unduh bahan ajar</span>
                                        </div>
                                    </a>

                                    <a href="{{ route('tugas-praktikan.index', ['meeting_name' => $meeting->meeting_name, 'halaqah_name' => $selectedHalaqah->halaqah_name]) }}"
                                        class="flex items-center gap-3 p-4 bg-white border border-orange-100 rounded-xl hover:border-orange-300 hover:shadow-sm transition group">
                                        <div
                                            class="p-3 bg-orange-50 text-orange-600 rounded-lg group-hover:bg-orange-500 group-hover:text-white transition">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M8 7V2.221a2 2 0 0 0-.5.365L3.586 6.5a2 2 0 0 0-.365.5H8Zm2 0V2h7a2 2 0 0 1 2 2v.126a5.087 5.087 0 0 0-4.74 1.368v.001l-6.642 6.642a3 3 0 0 0-.82 1.532l-.74 3.692a3 3 0 0 0 3.53 3.53l3.694-.738a3 3 0 0 0 1.532-.82L19 15.149V20a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z"
                                                    clip-rule="evenodd" />
                                                <path fill-rule="evenodd"
                                                    d="M17.447 8.08a1.087 1.087 0 0 1 1.187.238l.002.001a1.088 1.088 0 0 1 0 1.539l-.377.377-1.54-1.542.373-.374.002-.001c.1-.102.22-.182.353-.237Zm-2.143 2.027-4.644 4.644-.385 1.924 1.925-.385 4.644-4.642-1.54-1.54Zm2.56-4.11a3.087 3.087 0 0 0-2.187.909l-6.645 6.645a1 1 0 0 0-.274.51l-.739 3.693a1 1 0 0 0 1.177 1.176l3.693-.738a1 1 0 0 0 .51-.274l6.65-6.646a3.088 3.088 0 0 0-2.185-5.275Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="text-sm font-bold text-gray-800 group-hover:text-orange-600">Kerjakan
                                                Tugas</span>
                                            <span class="text-xs text-gray-500">Kirim tugas mingguan</span>
                                        </div>
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="flex flex-col items-center justify-center py-16 bg-white rounded-xl border-2 border-dashed border-gray-300 text-center">
                    <div class="p-4 bg-gray-50 rounded-full mb-3">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Belum ada pertemuan</h3>
                    <p class="text-sm text-gray-500 mt-1">Data pertemuan akan muncul setelah ditambahkan oleh Asisten.</p>
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
