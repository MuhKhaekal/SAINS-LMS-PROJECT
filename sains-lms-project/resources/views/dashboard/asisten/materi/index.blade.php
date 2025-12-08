@extends('dashboard.asisten.asisten-base')

@section('page-title', 'SAINS | Materi')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:mt-24">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Materi Pembelajaran</h1>
                <div class="flex items-center gap-2 mt-1 text-sm text-gray-500">
                    <span>{{ $selectedHalaqah->halaqah_name }}</span>
                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="font-medium text-gray-700">{{ $selectedMeeting->meeting_name }}</span>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
                <x-primary-button data-modal-target="default-modal-add" data-modal-toggle="default-modal-add">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Materi
                </x-primary-button>
            </div>
        </div>

        <div class="space-y-4">
            @forelse ($materials as $index => $material)
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 hover:shadow-md transition-all duration-200 group">
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-4 flex-1 min-w-0">
                            <div
                                class="flex-shrink-0 w-12 h-12 bg-cyan-50 text-cyan-600 rounded-lg flex items-center justify-center border border-cyan-100 group-hover:bg-cyan-100 transition-colors">
                                @php
                                    $extension = pathinfo($material->file_location, PATHINFO_EXTENSION);
                                    $icon = match (strtolower($extension)) {
                                        'pdf'
                                            => 'M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z',
                                        'ppt',
                                        'pptx'
                                            => 'M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z', 
                                        default
                                            => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                                    };
                                @endphp
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="{{ $icon }}"></path>
                                </svg>
                            </div>

                            <div class="min-w-0">
                                <h3
                                    class="text-sm font-bold text-gray-900 truncate group-hover:text-cyan-700 transition-colors">
                                    {{ $material->material_name }}
                                </h3>
                                <p class="text-xs text-gray-500 mt-0.5 truncate">
                                    {{ $material->description ?: 'Tidak ada deskripsi' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <a href="{{ route('materi-asisten.show', $material) }}" target="_blank"
                                class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors"
                                title="Lihat Materi">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </a>

                            <button type="button" data-modal-target="default-modal-update"
                                data-modal-toggle="default-modal-update" data-id="{{ $material->id }}"
                                data-material-name="{{ $material->material_name }}"
                                data-description="{{ $material->description }}"
                                data-file-location="{{ $material->file_location }}"
                                class="p-2 text-gray-400 hover:text-yellow-600 transition-colors rounded hover:bg-yellow-50"
                                title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                            </button>

                            <button type="button" data-modal-target="default-modal-delete"
                                data-modal-toggle="default-modal-delete" data-id="{{ $material->id }}"
                                class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                title="Hapus">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>

                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="flex flex-col items-center justify-center py-12 bg-white rounded-xl border-2 border-dashed border-gray-300 text-center">
                    <div class="p-4 bg-gray-50 rounded-full mb-3">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium text-gray-900">Belum ada materi</h3>
                    <p class="text-xs text-gray-500 mt-1">Unggah materi pembelajaran untuk pertemuan ini.</p>
                </div>
            @endforelse
        </div>

    </div>

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
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
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
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
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
