@extends('dashboard.praktikan.praktikan-base')

@section('page-title', 'SAINS | Tugas')

@section('content')
    <section class="mt-4 mx-4 md:mx-24 md:mt-24">
        <h1 class="text-center mb-6 text-xl md:text-3xl font-bold">Daftar Tugas: {{ $selectedMeeting->meeting_name }}</h1>
        @forelse ($assignments as $index => $assignment)
            <div class="bg-white shadow-md rounded-lg p-6 border mb-4">

                <h2 class="md:block font-bold md:text-2xl border-b w-fit border-gray-300">Tugas {{ $index + 1 }}:
                    {{ $assignment->assignment_name }}
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
                        <img src="{{ $fileUrl }}"
                            class="w-full h-auto md:w-96 md:flex md:p-4 object-contain rounded-md"
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

                <div class="mt-4">
                    @php
                        $submitted = $userSubmissions[$assignment->id] ?? null;
                    @endphp

                    @if ($submitted)
                        <div class="flex gap-3 items-center">
                            <div class="flex justify-center items-center gap-x-2">
                                <svg class="w-6 h-6 text-green-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 2c-.791 0-1.55.314-2.11.874l-.893.893a.985.985 0 0 1-.696.288H7.04A2.984 2.984 0 0 0 4.055 7.04v1.262a.986.986 0 0 1-.288.696l-.893.893a2.984 2.984 0 0 0 0 4.22l.893.893a.985.985 0 0 1 .288.696v1.262a2.984 2.984 0 0 0 2.984 2.984h1.262c.261 0 .512.104.696.288l.893.893a2.984 2.984 0 0 0 4.22 0l.893-.893a.985.985 0 0 1 .696-.288h1.262a2.984 2.984 0 0 0 2.984-2.984V15.7c0-.261.104-.512.288-.696l.893-.893a2.984 2.984 0 0 0 0-4.22l-.893-.893a.985.985 0 0 1-.288-.696V7.04a2.984 2.984 0 0 0-2.984-2.984h-1.262a.985.985 0 0 1-.696-.288l-.893-.893A2.984 2.984 0 0 0 12 2Zm3.683 7.73a1 1 0 1 0-1.414-1.413l-4.253 4.253-1.277-1.277a1 1 0 0 0-1.415 1.414l1.985 1.984a1 1 0 0 0 1.414 0l4.96-4.96Z"
                                        clip-rule="evenodd" />
                                </svg>

                                <p class="text-green-600 text-sm font-semibold">
                                    Terselesaikan
                                </p>
                            </div>

                            @if (is_null($submitted->score))
                                <a href="{{ route('pengajuan-tugas.edit', $submitted->id) }}" class=""
                                    data-tooltip-target="tooltip-edit-{{ $index }}">
                                    <svg class="w-7 h-7 text-secondary p-1 bg-yellow-500 hover:bg-yellow-600 hover:text-white rounded-md"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <div id="tooltip-edit-{{ $index }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 font-medium text-white transition-opacity duration-300 bg-dark rounded-base shadow-xs opacity-0 tooltip bg-primary rounded-md text-xs">
                                    Edit Jawaban
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>

                                <button class="py-2" data-tooltip-target="tooltip-delete-{{ $index }}"
                                    data-modal-target="default-modal-delete" data-modal-toggle="default-modal-delete"
                                    data-id="{{ $submitted->id }}">
                                    <svg class="w-7 h-7 text-secondary bg-red-500 hover:bg-red-600 hover:text-white rounded-md p-1"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div id="tooltip-delete-{{ $index }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 font-medium text-white transition-opacity duration-300 bg-dark rounded-base shadow-xs opacity-0 tooltip bg-primary rounded-md text-xs">
                                    Hapus Jawaban
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            @else
                                <span class="text-gray-500 text-xs font-semibold ml-2">
                                    | Nilai: {{ $submitted->score }}
                                </span>
                            @endif
                        </div>
                    @else
                        <a href="{{ route('pengajuan-tugas.index', [
                            'meeting_name' => $selectedMeeting->meeting_name,
                            'halaqah_name' => $selectedHalaqah->halaqah_name,
                            'assignment_id' => $assignment->id,
                        ]) }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-secondary hover:text-white uppercase tracking-widest bg-green-500 hover:bg-green-600 focus:bg-green-700 active:bg-green-900 mt-4">
                            Pengajuan Tugas
                        </a>
                    @endif
                </div>


            </div>
        @empty
            <p class="text-gray-400 italic text-center text-sm mt-12 bg-white p-8 border shadow-md rounded-md">Belum ada
                tugas</p>
        @endforelse
    </section>

    <div class="md:mx-24 mx-4 my-8">
        <a href="{{ url()->previous() }}"
            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md  hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 md:basis-2/12 text-center flex items-center justify-center gap-2 w-fit">
            Kembali
        </a>
    </div>

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
                            <p class="text-secondary text-center mt-5">Apakah anda yakin menghapus file pengajuan tugas
                                ini?</p>
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

                        deleteForm.action = `/pengajuan-tugas/${id}`;
                    });
                });
            });
        </script>


    </section>

    @if (session('success'))
        <div id="alert-success"
            class="fixed top-4 right-4 z-50 flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 rounded-lg shadow-lg opacity-0 translate-x-10 transition-all duration-500 ease-out"
            role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
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
            class="fixed top-4 right-4 z-50 flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 rounded-lg shadow-lg opacity-0 translate-x-10 transition-all duration-500 ease-out"
            role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
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
