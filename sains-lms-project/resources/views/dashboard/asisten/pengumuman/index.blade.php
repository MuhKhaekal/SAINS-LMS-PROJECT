@extends('dashboard.asisten.asisten-base')

@section('page-title', 'SAINS | Pengumuman')

@section('content')
    <section class="mx-4 md:mx-24 md:mt-24 md:flex md:gap-24">
        <section class="md:flex-1">
            <form action="{{ route('pengumuman-asisten.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="message" class="block mb-2 text-sm text-gray-900 md:text-xl">Pengumuman</label>
                <textarea name="content" id="message" rows="4"
                    class="shadow-md block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500 "
                    placeholder="Isi pengumuman disini ... "></textarea>
                <x-input-error :messages="$errors->get('content')" />

                <label class="block mb-2 text-sm mt-4 text-gray-900 md:text-xl" for="file_input">Lampiran</label>
                <input
                    class="p-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                    id="file_input" type="file" name="file_location"
                    accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.mp3,.wav,.m4a,.jpg,.jpeg,.png">
                <x-input-error :messages="$errors->get('file_location')" />

                <div class="flex justify-end mt-5">

                    <x-primary-button class="text-center">
                        {{ __('Unggah') }}
                    </x-primary-button>

                </div>
            </form>
        </section>

        <section class="md:flex-1">
            @forelse ($announcements as $index => $announcement)
                <div class="flex mt-4 mb-10">

                    <div class="me-2">
                        <svg class="w-6 h-6 text-primary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 20a7.966 7.966 0 0 1-5.002-1.756l.002.001v-.683c0-1.794 1.492-3.25 3.333-3.25h3.334c1.84 0 3.333 1.456 3.333 3.25v.683A7.966 7.966 0 0 1 12 20ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10c0 5.5-4.44 9.963-9.932 10h-.138C6.438 21.962 2 17.5 2 12Zm10-5c-1.84 0-3.333 1.455-3.333 3.25S10.159 13.5 12 13.5c1.84 0 3.333-1.455 3.333-3.25S13.841 7 12 7Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>

                    <div class=" bg-primary w-full rounded-e-3xl rounded-bl-3xl p-4">
                        <h1 class="text-white text-sm font bold">{{ $announcement->user->nama }}</h1>
                        <div class="bg-gray-600 p-2 mt-2 rounded-lg">
                            <p class="text-xs font-thin text-white">{{ $announcement->content }}</p>
                            @if ($announcement->file_location)
                                <a class="flex items-center mt-2"
                                    href="{{ asset('storage/' . $announcement->file_location) }}">
                                    <svg class="w-4 h-4 me-3 text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M3 6a2 2 0 0 1 2-2h5.532a2 2 0 0 1 1.536.72l1.9 2.28H3V6Zm0 3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9H3Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <p class="text-white text-xs hover:text-blue-500 hover:underline">File Lampiran</p>
                                </a>
                            @endif

                            <div class="flex space-x-4 text-xs text-gray-500 mt-2">
                                @if ($announcement->file_location)
                                    @php
                                        $extension = pathinfo($announcement->file_location, PATHINFO_EXTENSION);
                                    @endphp
                                    <p>* {{ strtoupper($extension) }}</p>
                                @endif

                                <p>* {{ $announcement->created_at->timezone('Asia/Makassar')->format('d M Y, H:i') }}</p>

                            </div>
                        </div>
                        @if ($announcement->user_id == auth()->id() && auth()->user()->role == 'asisten')
                            <div class="flex mt-2 space-x-2 justify-end">
                                <button type="button" data-tooltip-target="tooltip-edit-{{ $index }}"
                                    data-modal-target="default-modal-update" data-modal-toggle="default-modal-update"
                                    data-id="{{ $announcement->id }}" data-content="{{ $announcement->content }}"
                                    data-file-location="{{ $announcement->file_location }}"
                                    class="font-medium hover:underline">
                                    <svg class="w-7 h-7 text-secondary bg-yellow-500 hover:bg-yellow-600 hover:text-white rounded-md p-1"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <div id="tooltip-edit-{{ $index }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 font-medium text-white transition-opacity duration-300 bg-dark rounded-base shadow-xs opacity-0 tooltip bg-primary rounded-md text-xs">
                                    Edit
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>

                                <button type="button" class="font-medium hover:underline"
                                    data-tooltip-target="tooltip-delete-{{ $index }}"
                                    data-modal-target="default-modal-delete" data-modal-toggle="default-modal-delete"
                                    data-id="{{ $announcement->id }}">
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
                                    Hapus
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-400 text-center italic">Belum ada pengumuman</p>
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
                            Edit Pengumuman
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

                    <form action="" method="POST" id="formUpdate" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="p-4 md:p-5 space-y-4 mb-4">
                            <div class="">
                                <p class="text-secondary">Isi Pengumuman</p>
                                <textarea name="content" id="content" rows="4"
                                    class="shadow-md block p-2.5 w-full text-sm text-primary bg-secondary rounded-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500 "
                                    placeholder="Isi pengumuman disini ... "></textarea>
                                <x-input-error :messages="$errors->get('content')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Lampiran</p>
                                <input
                                    class="p-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                    id="file_input" type="file" name="file_location"
                                    accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.mp3,.wav,.m4a,.jpg,.jpeg,.png">
                                <x-input-error :messages="$errors->get('file_location')" />
                            </div>
                            <div id="file-info" class="text-sm text-secondary mt-1"></div>
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
                const contentInput = modal.querySelector('#content');
                const form = modal.querySelector('#formUpdate');
                const fileInfo = modal.querySelector('#file-info');
                document.querySelectorAll('[data-modal-target="default-modal-update"]').forEach(button => {
                    button.addEventListener('click', () => {

                        const id = button.getAttribute('data-id');
                        const content = button.getAttribute('data-content');
                        const fileLocation = button.getAttribute('data-file-location');

                        contentInput.value = content;


                        fileInfo.innerHTML = fileLocation ?
                            `<a href="/storage/${fileLocation}" target="_blank" class="text-blue-500 underline">Lihat File Lama</a>` :
                            `<span class="text-gray-400">Tidak ada file</span>`;


                        form.action = `/pengumuman-asisten/${id}`;
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
                            <p class="text-secondary text-center mt-5">Apakah anda yakin menghapus pengumuman ini?</p>
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

                        deleteForm.action = `/pengumuman-asisten/${id}`;
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
