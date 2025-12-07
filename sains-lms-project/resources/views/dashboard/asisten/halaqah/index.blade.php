@extends('dashboard.asisten.asisten-base')

@section('page-title', 'SAINS | Halaqah')

@section('content')
    <div class="mx-3 md:mt-20 md:mx-32">
        <div style="background-image: url('/assets/images/background-halaqah.png');"
            class="bg-no-repeat md:bg-center bg-contain w-full aspect-[30/9] flex items-center justify-center overflow-hidden">
            <div class="relative text-secondary flex justify-center items-center md:w-1/2 md:mx-24">
                <h1 class="font-semibold text-xl md:text-5xl text-center py-10 md:py-0" data-aos="fade-right">
                    {{ $selectedHalaqah->halaqah_name }}
                </h1>
            </div>
        </div>
    </div>

    <section class="akumulasi-nilai grid grid-cols-1 md:grid-cols-4 md:gap-0 gap-2 m-3 md:mx-32">
        <div
            class="border shadow-md p-4 text-xs font-bold rounded-lg md:rounded-e-none bg-white transition duration-300 ease-in hover:scale-105">
            <a href="" class="flex md:flex-col md:py-4 items-center">
                <div class="bg-red-500 rounded p-2 me-3">
                    <svg class="w-6 h-6 md:w-12 md:h-12 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm2-2a1 1 0 1 0 0 2h3a1 1 0 1 0 0-2h-3Zm0 3a1 1 0 1 0 0 2h3a1 1 0 1 0 0-2h-3Zm-6 4a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-6Zm8 1v1h-2v-1h2Zm0 3h-2v1h2v-1Zm-4-3v1H9v-1h2Zm0 3H9v1h2v-1Z"
                            clip-rule="evenodd" />
                    </svg>

                </div>
                <p class="md:mt-4 md:text-base">
                    Akumulasi Nilai
                </p>
            </a>
        </div>
        <div
            class="border shadow-md p-4 text-xs font-bold rounded-lg md:rounded-none bg-white transition duration-300 ease-in hover:scale-105">
            <a href="" class="flex md:flex-col md:py-4 items-center">
                <div class="bg-yellow-500 rounded p-2 me-3">
                    <svg class="w-6 h-6 md:w-12 md:h-12 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-3 8a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Zm2 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="md:mt-4 md:text-base">
                    Daftar Nilai Pre-Test
                </p>
            </a>
        </div>
        <div
            class="border shadow-md p-4 text-xs font-bold rounded-lg md:rounded-none bg-white transition duration-300 ease-in hover:scale-105">
            <a href="" class="flex md:flex-col md:py-4 items-center">
                <div class="bg-emerald-600 rounded p-2 me-3">
                    <svg class="w-6 h-6 md:w-12 md:h-12 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm-1 9a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2Zm2-5a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1Zm4 4a1 1 0 1 0-2 0v3a1 1 0 1 0 2 0v-3Z"
                            clip-rule="evenodd" />
                    </svg>

                </div>
                <p class="md:mt-4 md:text-base">
                    Daftar Nilai Per-pekan
                </p>
            </a>
        </div>
        <div
            class="border shadow-md p-4 text-xs font-bold rounded-lg md:rounded-s-none bg-white transition duration-300 ease-in hover:scale-105">
            <a href="" class="flex md:flex-col md:py-4 items-center ">
                <div class="bg-cyan-800 rounded p-2 me-3">
                    <svg class="w-6 h-6 md:w-12 md:h-12 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-3 8a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Zm2 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="md:mt-4 md:text-base">
                    Daftar Nilai Post-Test
                </p>
            </a>
        </div>
    </section>

    <section class="mx-4 md:mx-32">
        @forelse ($meetings as $index => $meeting)
            <div id="accordion-{{ $index }}" class="my-2">

                <button type="button"
                    class="shadow-md flex items-center justify-between w-full p-5 text-xs font-medium rounded-t-xl bg-white transition-colors duration-300 focus:outline-none"
                    data-target="#accordion-body-{{ $index }}">

                    <div class="flex items-center md:justify-start md:gap-3 w-full md:text-base">
                        <span
                            class="w-40 md:w-52 bg-secondary text-primary font-bold p-1 me-2 rounded-md ">{{ $meeting->meeting_name }}</span>
                        <span class="font-bold text-left w-full">{{ $meeting->topic }}</span>
                    </div>

                    <svg data-accordion-icon class="w-3 h-3 shrink-0 ms-2 flex-none" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                </button>

                <div id="accordion-body-{{ $index }}"
                    class="max-h-0 shadow-md overflow-hidden transition-all duration-500 ease-in-out">
                    <div class="p-5 border border-b-0 border-gray-200 bg-white text-xs md:text-base">
                        <p class="mb-2 text-black">
                            {{ $meeting->description }}
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-3 md:gap-0 mt-3">
                            <div class="border p-3 ">
                                <a href="{{ route('presensi-asisten.index', ['meeting_name' => $meeting->meeting_name, 'halaqah_name' => $selectedHalaqah->halaqah_name]) }}"
                                    class="flex items-center md:flex-col md:justify-center md:py-4 transition duration-300 ease-in hover:scale-105">
                                    <div class="bg-primary rounded-md p-2 text-white text-center me-3 md:me-0">
                                        <svg class="w-6 h-6 md:w-12 md:h-12 text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                                clip-rule="evenodd" />
                                        </svg>

                                    </div>
                                    <p class="font-bold md:mt-4">Presensi</p>
                                </a>
                            </div>
                            @if ($meeting->type == 'pretest')
                                <div class="border p-3 ">
                                    <a href="{{ route('pretest-asisten.index', ['meeting_name' => $meeting->meeting_name, 'halaqah_name' => $selectedHalaqah->halaqah_name]) }}" class="flex md:flex-col md:py-4 items-center">
                                        <div class="bg-yellow-500 rounded p-2 me-3 md:me-0">
                                            <svg class="w-6 h-6 md:w-12 md:h-12 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-3 8a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Zm2 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <p class="font-bold md:mt-4">
                                            Mulai Pre-Test
                                        </p>
                                    </a>
                                </div>
                            @endif
                            @if ($meeting->type == 'posttest')
                                <div class="border p-3 ">
                                    <a href="" class="flex md:flex-col md:py-4 items-center ">
                                        <div class="bg-cyan-800 rounded p-2">
                                            <svg class="w-6 h-6 md:w-12 md:h-12 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-3 8a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Zm2 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <p class="font-bold md:mt-4">
                                            Mulai Post-Test
                                        </p>
                                    </a>
                                </div>
                            @endif
                            @if ($meeting->type == 'skk')
                                <div class="border p-3">
                                    <a href="{{ route('materi-asisten.index', ['meeting_name' => $meeting->meeting_name, 'halaqah_name' => $selectedHalaqah->halaqah_name]) }}"
                                        class="flex items-center md:flex-col md:justify-center md:py-4 transition duration-300 ease-in hover:scale-105">
                                        <div class="bg-cyan-800 rounded-md p-2 text-white me-3">
                                            <svg class="w-6 h-6 md:w-12 md:h-12 text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v6.41A7.5 7.5 0 1 0 10.5 22H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z"
                                                    clip-rule="evenodd" />
                                                <path fill-rule="evenodd"
                                                    d="M9 16a6 6 0 1 1 12 0 6 6 0 0 1-12 0Zm6-3a1 1 0 0 1 1 1v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 1 1 0-2h1v-1a1 1 0 0 1 1-1Z"
                                                    clip-rule="evenodd" />
                                            </svg>

                                        </div>
                                        <p class="font-bold md:mt-4">Unggah Materi</p>
                                    </a>
                                </div>
                                <div class="border p-3">
                                    <a href="{{ route('tugas-asisten.index', ['meeting_name' => $meeting->meeting_name, 'halaqah_name' => $selectedHalaqah->halaqah_name]) }}"
                                        class="flex items-center md:flex-col md:justify-center md:py-4 transition duration-300 ease-in hover:scale-105">
                                        <div class="bg-red-400 rounded-md p-2 text-white me-3">
                                            <svg class="w-6 h-6 md:w-12 md:h-12 text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M8 7V2.221a2 2 0 0 0-.5.365L3.586 6.5a2 2 0 0 0-.365.5H8Zm2 0V2h7a2 2 0 0 1 2 2v.126a5.087 5.087 0 0 0-4.74 1.368v.001l-6.642 6.642a3 3 0 0 0-.82 1.532l-.74 3.692a3 3 0 0 0 3.53 3.53l3.694-.738a3 3 0 0 0 1.532-.82L19 15.149V20a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z"
                                                    clip-rule="evenodd" />
                                                <path fill-rule="evenodd"
                                                    d="M17.447 8.08a1.087 1.087 0 0 1 1.187.238l.002.001a1.088 1.088 0 0 1 0 1.539l-.377.377-1.54-1.542.373-.374.002-.001c.1-.102.22-.182.353-.237Zm-2.143 2.027-4.644 4.644-.385 1.924 1.925-.385 4.644-4.642-1.54-1.54Zm2.56-4.11a3.087 3.087 0 0 0-2.187.909l-6.645 6.645a1 1 0 0 0-.274.51l-.739 3.693a1 1 0 0 0 1.177 1.176l3.693-.738a1 1 0 0 0 .51-.274l6.65-6.646a3.088 3.088 0 0 0-2.185-5.275Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <p class="font-bold md:mt-4">Unggah Tugas</p>
                                    </a>
                                </div>
                            @endif


                        </div>

                    </div>
                </div>
            </div>
        @empty
            <p>Belum ada data pertemuan</p>
        @endforelse

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



@endsection
