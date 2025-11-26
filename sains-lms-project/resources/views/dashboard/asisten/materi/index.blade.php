@extends('dashboard.asisten.asisten-base')

@section('page-title', 'SAINS | Materi')

@section('content')
    <section class="mx-4 md:mx-24 mt-5 md:mt-20">
        <h1 class="font-bold text-lg text-center">Daftar Materi {{ $selectedMeeting->meeting_name }}</h1>

        @forelse ($materials as $index => $material)
            <div class="flex items-center bg-white shadow-md p-4 rounded-md mt-2 gap-3">
                <div class="bg-cyan-800 rounded-md p-2 text-white">
                    <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v6.41A7.5 7.5 0 1 0 10.5 22H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z"
                            clip-rule="evenodd" />
                        <path fill-rule="evenodd"
                            d="M9 16a6 6 0 1 1 12 0 6 6 0 0 1-12 0Zm6-3a1 1 0 0 1 1 1v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 1 1 0-2h1v-1a1 1 0 0 1 1-1Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>

                <p class="flex-1 break-words">
                    {{ $material->material_name }}
                </p>



                <div class="flex gap-2 ml-auto">
                    <a data-tooltip-target="tooltip-preview-{{ $index }}" href="{{ route('materi-asisten.show', $material) }}"
                        class="font-medium hover:underline">
                        <svg class="w-7 h-7 text-secondary bg-green-500 hover:bg-green-600 p-1 rounded-md hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M21.707 21.707a1 1 0 0 1-1.414 0l-3.5-3.5a1 1 0 0 1 1.414-1.414l3.5 3.5a1 1 0 0 1 0 1.414ZM2 10a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm9-3a1 1 0 1 0-2 0v2H7a1 1 0 0 0 0 2h2v2a1 1 0 1 0 2 0v-2h2a1 1 0 1 0 0-2h-2V7Z"
                                clip-rule="evenodd" />
                        </svg>

                    </a>
                    <div id="tooltip-preview-{{ $index }}" role="tooltip"
                        class="absolute z-10 invisible inline-block px-3 py-2 font-medium text-white transition-opacity duration-300 bg-dark rounded-base shadow-xs opacity-0 tooltip bg-primary rounded-md text-xs">
                        Preview
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>

                    <button data-tooltip-target="tooltip-edit-{{ $index }}" data-modal-target="default-modal-update"
                        data-modal-toggle="default-modal-update" data-id="{{ $material->id }}"
                        data-material-name="{{ $material->material_name }}" data-description="{{ $material->description }}"
                        data-file-location="{{ $material->file_location }}" type="button"
                        class="font-medium hover:underline">
                        <svg class="w-7 h-7 text-secondary bg-yellow-500 hover:bg-yellow-600 hover:text-white rounded-md p-1"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
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

                    <button data-tooltip-target="tooltip-delete-{{ $index }}" data-modal-target="default-modal-delete"
                        data-id="{{ $material->id }}" data-modal-toggle="default-modal-delete" type="button"
                        class="font-medium hover:underline">
                        <svg class="w-7 h-7 text-secondary bg-red-500 hover:bg-red-600 hover:text-white rounded-md p-1"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
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
            </div>
        @empty
            <p class="italic text-gray-400 text-center text-xs md:text-sm mt-2">Belum ada materi yang diunggah</p>
        @endforelse



        <x-primary-button-full class="mt-5 text-center" data-modal-target="default-modal-add"
            data-modal-toggle="default-modal-add">
            {{ __('+ Tambah Materi') }}
        </x-primary-button-full>
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

        <div id="default-modal-add" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full] max-h-full backdrop-blur-sm">

            <div class="relative p-4 w-full max-w-2xl max-h-full mt-28 md:mt-0">
                <div class="relative bg-primary rounded-lg shadow-sm px-4">
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                        <h3 class="text-xl font-semibold text-white">
                            Tambah Materi
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                            data-modal-hide="default-modal-add">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <form action="{{ route('materi-asisten.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="meeting_id" value="{{ $selectedMeeting->id }}">
                        <input type="hidden" name="halaqah_id" value="{{ $selectedHalaqah->id }}">
                        <div class="p-4 md:p-5 space-y-4 mb-4">
                            <div class="">
                                <p class="text-secondary">Judul Materi</p>
                                <x-text-input-secondary id="material_name" class="block w-full mt-1" type="text"
                                    name="material_name" :value="old('material_name')" required autofocus autocomplete="username"
                                    placeholder="Pertemuan 1 - Makharijul Huruf" />
                                <x-input-error :messages="$errors->get('material_name')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Deskripsi</p>
                                <textarea name="description" id="description" rows="4"
                                    class="shadow-md block p-2.5 w-full text-sm text-gray-900 bg-secondary rounded-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500 "
                                    placeholder="Isi deskripsi disini ... "></textarea>
                                <x-input-error :messages="$errors->get('description')" />
                            </div>
                            <div class="">
                                <div class="">
                                    <p class="text-secondary mb-1">Unggah File</p>

                                    <label for="file_input"
                                        class="p-4 flex flex-col items-center justify-center w-full border border-gray-500 border-dashed rounded-lg cursor-pointer bg-primary hover:bg-gray-700 transition duration-150">

                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-10 h-10 text-secondary" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M19 10V4a1 1 0 0 0-1-1H9.914a1 1 0 0 0-.707.293L5.293 7.207A1 1 0 0 0 5 7.914V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2M10 3v4a1 1 0 0 1-1 1H5m5 6h9m0 0-2-2m2 2-2 2" />
                                            </svg>

                                            <p class="text-xs text-secondary mt-2">
                                                <span class="font-semibold">Klik untuk unggah</span> atau seret & letakkan
                                            </p>
                                            <p class="text-xs text-gray-400 mt-1">PDF, PPT, DOCX, JPG, PNG (max 10MB)</p>
                                        </div>

                                        <input class="hidden" id="file_input" type="file" name="file_location"
                                            accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.mp3,.wav,.m4a,.jpg,.jpeg,.png">
                                    </label>

                                    <p id="file_name" class="text-sm text-gray-300 mt-2"></p>
                                    <x-input-error :messages="$errors->get('file')" />
                                </div>

                                <script>
                                    document.getElementById('file_input').addEventListener('change', function() {
                                        const fileNameText = document.getElementById('file_name');
                                        fileNameText.textContent = this.files.length ? "File dipilih: " + this.files[0].name : "";
                                    });
                                </script>

                            </div>

                        </div>

                        <div class="flex justify-center gap-5 p-4 md:p-5 border-t border-gray-200 rounded-b">
                            <x-delete-button class="text-center" data-modal-hide="default-modal-add">
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
                            Edit Materi
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
                        <input type="hidden" name="meeting_id" value="{{ $selectedMeeting->id }}">
                        <input type="hidden" name="halaqah_id" value="{{ $selectedHalaqah->id }}">
                        <div class="p-4 md:p-5 space-y-4 mb-4">
                            <div class="">
                                <p class="text-secondary">Judul Materi</p>
                                <x-text-input-secondary id="material_name" class="block w-full mt-1" type="text"
                                    name="material_name" :value="old('material_name')" required autofocus autocomplete="username"
                                    placeholder="Pertemuan 1 - Makharijul Huruf" />
                                <x-input-error :messages="$errors->get('material_name')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Deskripsi</p>
                                <textarea name="description" id="description" rows="4"
                                    class="shadow-md block p-2.5 w-full text-sm text-gray-900 bg-secondary rounded-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500 "
                                    placeholder="Isi deskripsi disini ... "></textarea>
                                <x-input-error :messages="$errors->get('description')" />
                            </div>
                            <div class="">
                                <div class="">
                                    <p class="text-secondary mb-1">Unggah File</p>

                                    <label for="file_input_update"
                                        class="p-4 flex flex-col items-center justify-center w-full border border-gray-500 border-dashed rounded-lg cursor-pointer bg-primary hover:bg-gray-700 transition duration-150">

                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-10 h-10 text-secondary" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M19 10V4a1 1 0 0 0-1-1H9.914a1 1 0 0 0-.707.293L5.293 7.207A1 1 0 0 0 5 7.914V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2M10 3v4a1 1 0 0 1-1 1H5m5 6h9m0 0-2-2m2 2-2 2" />
                                            </svg>

                                            <p class="text-xs text-secondary mt-2">
                                                <span class="font-semibold">Klik untuk unggah</span> atau seret & letakkan
                                            </p>
                                            <p class="text-xs text-gray-400 mt-1">PDF, PPT, DOCX, JPG, PNG (max 10MB)</p>
                                        </div>

                                        <input class="hidden" id="file_input_update" type="file" name="file_location"
                                            accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.mp3,.wav,.m4a,.jpg,.jpeg,.png">
                                    </label>

                                    <p id="file_name" class="text-sm text-gray-300 mt-2"></p>
                                    <x-input-error :messages="$errors->get('file_location')" />
                                    <div id="file-info" class="text-sm text-secondary mt-1"></div>
                                </div>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const modal = document.getElementById('default-modal-update');
                                        const fileInput = modal.querySelector('#file_input_update');
                                        const fileNameText = modal.querySelector('#file_name');

                                        fileInput.addEventListener('change', function() {
                                            fileNameText.textContent =
                                                this.files.length ? "File dipilih: " + this.files[0].name : "";
                                        });
                                    });
                                </script>

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
                const materialNameInput = modal.querySelector('#material_name');
                const descriptionInput = modal.querySelector('#description');
                const form = modal.querySelector('#formUpdate');
                const fileInfo = modal.querySelector('#file-info');
                document.querySelectorAll('[data-modal-target="default-modal-update"]').forEach(button => {
                    button.addEventListener('click', () => {

                        const id = button.getAttribute('data-id');
                        const materialName = button.getAttribute('data-material-name');
                        const description = button.getAttribute('data-description');
                        const fileLocation = button.getAttribute('data-file-location');

                        materialNameInput.value = materialName;
                        descriptionInput.value = description;


                        if (fileInfo) {
                            fileInfo.innerHTML = fileLocation ?
                                `<a download="${materialName}" href="/storage/${fileLocation}" target="_blank" class="text-blue-500 underline">Lihat File Lama</a>` :
                                `<span class="text-gray-400">Tidak ada file</span>`;
                        }

                        form.action = `/materi-asisten/${id}`;
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
                            <p class="text-secondary text-center mt-5">Apakah anda yakin menghapus materi ini?</p>
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

                        deleteForm.action = `/materi-asisten/${id}`;
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
