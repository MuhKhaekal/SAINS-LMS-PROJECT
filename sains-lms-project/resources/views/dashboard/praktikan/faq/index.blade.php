@extends('dashboard.praktikan.praktikan-base')

@section('page-title', 'SAINS | FAQ')

@section('content')
    <div class="mx-3 md:mt-20 md:mx-24">
        <div style="background-image: url('/assets/images/background-halaqah.png');"
            class="bg-no-repeat md:bg-center bg-contain w-full aspect-[30/9] flex items-center justify-center overflow-hidden">
            <div class="relative text-secondary flex justify-center items-center md:w-1/2 md:mx-24">
                <h1 class="font-semibold text-xl md:text-5xl text-center py-10 md:py-0" data-aos="fade-right">
                    FAQ
                </h1>
            </div>
        </div>
    </div>

    <section class="md:flex md:mx-24 mx-4 md:gap-5">
        <section class="md:flex-1">

            <section class="">
                <div id="accordion-1" class="my-2">
                    @forelse ($faqs->where('status', true) as $index => $faq)
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

                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="font-normal text-center text-gray-400 italic my-2 text-xs md:text-sm mt-8">Belum ada FAQ
                            yang ditampilkan</p>
                    @endforelse
                </div>
            </section>
        </section>

        <section class="text-xs md:text-sm md:flex-1  border mt-4 p-4 border-dashed border-gray-500 md:border-gray-300 rounded-md">
            <form action="{{ route('faq-praktikan.store') }}" method="POST">
                @csrf

                <h1 class="text-center text-lg font-bold">Tuliskan pertanyaan anda disini</h1>
                <textarea class="rounded-md w-full h-20 mt-2" name="question" id="" placeholder="Isi pertanyaan disini ..."></textarea>
                <x-secondary-button class="mt-2">Kirim</x-secondary-button>
            </form>
        </section>
    </section>

    <script>
        document.querySelectorAll("[data-target]").forEach(btn => {
            btn.addEventListener("click", () => {
                const content = document.querySelector(btn.dataset.target);
                const icon = btn.querySelector("svg");

                if (content.classList.contains("max-h-0")) {
                    content.style.maxHeight = content.scrollHeight + "px";
                    content.classList.remove("max-h-0");
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
