<!-- resources/views/dashboard/asisten/materi/show.blade.php -->
@extends('dashboard.asisten.asisten-base')

@section('page-title', $assignment->assignment_name)

@section('content')
    <section class="mt-4 md:mx-24 md:mt-24">

        <div class=" bg-white shadow-md rounded-lg p-6 border ">

            <h2 class="hidden md:block font-bold text-2xl border-b w-fit border-gray-300">{{ $assignment->assignment_name }}
            </h2>
            <p class="text-sm font-thin text-gray-800 my-4">
                {{ $assignment->description }}
            </p>

            @php
                $path = $assignment->file_location;
                $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                $fileUrl = asset('storage/' . $path);
            @endphp

            <div class="mt-6 w-full h-fit rounded-lg overflow-hidden border border-gray-300 md:flex justify-center">

                @if ($extension === 'pdf')
                    <iframe download="{{ $assignment->assignment_name . '.' . $extension }}" src="{{ $fileUrl }}"
                        class="w-full h-[400px] md:h-[600px]" frameborder="0"></iframe>
                @elseif (in_array($extension, ['jpg', 'jpeg', 'png']))
                    <img src="{{ $fileUrl }}" class="w-full h-auto md:w-96 md:flex md:p-4 object-contain rounded-md"
                        download="{{ $assignment->assignment_name . '.' . $extension }}" />
                @elseif (in_array($extension, ['mp3', 'wav']))
                    <div class="w-full flex justify-center items-center py-10 bg-gray-100">
                        <audio controls class="w-full max-w-xl"
                            download="{{ $assignment->assignment_name . '.' . $extension }}">
                            <source src="{{ $fileUrl }}">
                        </audio>
                    </div>
                @elseif (in_array($extension, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx']))
                    <div
                        class="w-full flex flex-col items-center justify-center py-10 px-4 text-center bg-gradient-to-br from-gray-50 to-gray-200 rounded-lg">

                        <div class="p-6 bg-white w-full max-w-md rounded-xl shadow-md border">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $assignment->assignment_name }}</h3>

                            <p class="text-gray-500 text-sm mt-2">
                                Pratinjau tidak tersedia untuk tipe file ini.
                            </p>

                            <div class="mt-5">
                                <a href="{{ $fileUrl }}"
                                    download="{{ $assignment->assignment_name . '.' . $extension }}"
                                    class="inline-flex items-center gap-2 bg-indigo-600 text-white px-5 py-2.5 rounded-lg shadow hover:bg-indigo-700 transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                                    </svg>
                                    Download File
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="h-full flex flex-col items-center justify-center text-center p-6">
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            File tidak dapat ditampilkan, silakan unduh untuk melihat.
                        </p>
                        <a href="{{ $fileUrl }}" download="{{ $assignment->assignment_name . '.' . $extension }}"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow">
                            Download File
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6 border mt-4">
            <h2 class="hidden md:block font-bold text-2xl border-b w-fit border-gray-300">Daftar Tugas Praktikan</h2>
            <form action="{{ route('periksa-tugas.update') }}" method="POST">
                @csrf
                @forelse ($assignment->submissions as $submission)
                    <div class="border rounded-md mt-4 p-4 flex justify-between">
                        <div class="flex items-center gap-x-4">
                            <svg class="w-8 h-8 text-white bg-red-500 p-1 rounded-md" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M8 7V2.221a2 2 0 0 0-.5.365L3.586 6.5a2 2 0 0 0-.365.5H8Zm2 0V2h7a2 2 0 0 1 2 2v.126a5.087 5.087 0 0 0-4.74 1.368v.001l-6.642 6.642a3 3 0 0 0-.82 1.532l-.74 3.692a3 3 0 0 0 3.53 3.53l3.694-.738a3 3 0 0 0 1.532-.82L19 15.149V20a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z"
                                    clip-rule="evenodd" />
                                <path fill-rule="evenodd"
                                    d="M17.447 8.08a1.087 1.087 0 0 1 1.187.238l.002.001a1.088 1.088 0 0 1 0 1.539l-.377.377-1.54-1.542.373-.374.002-.001c.1-.102.22-.182.353-.237Zm-2.143 2.027-4.644 4.644-.385 1.924 1.925-.385 4.644-4.642-1.54-1.54Zm2.56-4.11a3.087 3.087 0 0 0-2.187.909l-6.645 6.645a1 1 0 0 0-.274.51l-.739 3.693a1 1 0 0 0 1.177 1.176l3.693-.738a1 1 0 0 0 .51-.274l6.65-6.646a3.088 3.088 0 0 0-2.185-5.275Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="text-xs md:text-sm">
                                {{ $submission->user->nim }} - {{ $submission->user->nama }}
                            </p>
                        </div>

                        <div>
                            <label class="block mb-2.5 text-sm font-semibold">Beri Nilai:</label>

                            <div class="score-wrapper relative flex items-center max-w-[9rem] shadow rounded-base">

                                <button type="button"
                                    class="btn-minus text-body bg-gray-200 border border-gray-300 hover:bg-gray-300
                                   rounded-l-base h-8 px-3 text-sm">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-width="1" d="M5 12h14" />
                                    </svg>
                                </button>

                                <input type="text" name="score[{{ $submission->id }}]"
                                    class="score-input h-8 w-full text-center border-y border-gray-300 bg-gray-100"
                                    value="{{ $submission->score ?? 0 }}" />

                                <button type="button"
                                    class="btn-plus text-body bg-gray-200 border border-gray-300 hover:bg-gray-300
                                   rounded-r-base h-8 px-3 text-sm">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-width="1"
                                            d="M5 12h14m-7 7V5" />
                                    </svg>
                                </button>

                            </div>
                        </div>
                    </div>



                @empty
                    <p class="text-gray-400 mt-3 text-center italic">Belum ada yang mengumpulkan tugas.</p>
                @endforelse

                @if ($assignment->submissions->count())
                    <div class="flex justify-end mt-5 gap-x-2">

                        <a href="{{ url()->previous() }}"
                            class="bg-gray-300 text-gray-700 px-4 text-sm py-2 rounded-md  hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 text-center flex items-center justify-center ">
                            Kembali
                        </a>

                        <x-primary-button>
                            Simpan Nilai
                        </x-primary-button>
                    </div>
                @endif
            </form>

            <script>
                const MIN = 0;
                const MAX = 100;

                document.querySelectorAll('.score-wrapper').forEach(wrapper => {

                    const input = wrapper.querySelector('.score-input');
                    const btnPlus = wrapper.querySelector('.btn-plus');
                    const btnMinus = wrapper.querySelector('.btn-minus');

                    function updateButtons(value) {
                        btnMinus.disabled = value <= MIN;
                        btnPlus.disabled = value >= MAX;

                        btnMinus.classList.toggle("opacity-50", btnMinus.disabled);
                        btnPlus.classList.toggle("opacity-50", btnPlus.disabled);
                    }

                    btnPlus.addEventListener('click', () => {
                        let value = parseInt(input.value) || 0;
                        if (value < MAX) {
                            value++;
                            input.value = value;
                            updateButtons(value);
                        }
                    });

                    btnMinus.addEventListener('click', () => {
                        let value = parseInt(input.value) || 0;
                        if (value > MIN) {
                            value--;
                            input.value = value;
                            updateButtons(value);
                        }
                    });

                    input.addEventListener('input', () => {
                        let value = parseInt(input.value);

                        if (isNaN(value)) value = MIN;
                        if (value < MIN) value = MIN;
                        if (value > MAX) value = MAX;

                        input.value = value;
                        updateButtons(value);
                    });

                    updateButtons(parseInt(input.value) || 0);
                });
            </script>


        </div>
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
        </script>
    @endif
@endsection
