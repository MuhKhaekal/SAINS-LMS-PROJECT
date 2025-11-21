@extends('dashboard.asisten.asisten-base')

@section('page-title', 'SAINS | FAQ')

@section('content')
    <div class="mx-2 md:mt-20 md:mx-24">
        <div style="background-image: url('/assets/images/background-halaqah.png');"
            class="bg-no-repeat md:bg-center bg-contain w-full aspect-[30/9] flex items-center justify-center rounded-2xl overflow-hidden">
            <div class="relative text-secondary flex justify-center items-center md:w-1/2 md:mx-24">
                <h1 class="font-semibold text-xl md:text-6xl text-center py-10 md:py-0" data-aos="fade-right">
                    FAQ
                </h1>
            </div>
        </div>
    </div>

    <section class="md:flex md:flex-row-reverse md:mx-24 md:gap-5">
        <section class="md:flex-1">
            <h1 class="font-semibold text-sm md:text-lg mx-4 md:mx-0 mt-5" data-aos="fade-right">
                Daftar FAQ yang ditampilkan:
            </h1>

            <section class="mx-4">
                <div id="accordion-1" class="my-2">
                    <h2>
                        <button type="button"
                            class="shadow-md flex text-xs md:text-sm items-center justify-between w-full p-5 font-medium rtl:text-right bg-white transition-colors duration-300 focus:outline-none"
                            data-target="#accordion-body-1">
                            <span class="font-bold flex-1 text-start">Lorem, ipsum dolor sit amet consectetur adipisicing
                                elit?</span>
                            <svg data-accordion-icon class="w-3 h-3 shrink-0" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>

                    <div id="accordion-body-1"
                        class="max-h-0 shadow-md overflow-hidden transition-all duration-500 ease-in-out">
                        <div class="p-5 border border-b-0 border-gray-200 bg-white text-xs md:text-sm">
                            <p class="mb-2 text-black">
                                Flowbite is an open-source library of interactive components built on top of Tailwind CSS.
                            </p>
                            <x-delete-button class="text-center">
                                {{ __('Hapus dari Daftar') }}
                            </x-delete-button>
                        </div>
                    </div>
                </div>
            </section>

        </section>

        <section
            class="overflow-y-auto h-60 md:h-96 border border-dashed rounded-md border-blue-200 mx-4 mt-5 p-2 text-xs md:text-sm md:flex-1">
            <div class="bg-white p-4 rounded-md mb-2">
                <h1 class="font-bold">Apakah program SAINS wajib diikuti?</h1>
                <p class="mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, repellendus.</p>
                <div class="flex justify-between mt-2">
                    <x-edit-button class="text-center me-3">
                        {{ __('Edit Jawaban') }}
                    </x-edit-button>
                    <x-secondary-button class="text-center">
                        {{ __('Tambahkan') }}
                    </x-secondary-button>
                </div>
            </div>

        </section>
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
