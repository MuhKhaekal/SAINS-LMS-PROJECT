@extends('dashboard.admin.admin-base')

@section('page-title', 'SAINS - Pertemuan')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- HEADER: Judul & Tombol Tambah --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Daftar Pertemuan</h1>
                <p class="text-sm text-gray-500 mt-1">Atur topik pembahasan, materi, dan jadwal ujian.</p>
            </div>
            <div>
                <x-primary-button data-modal-target="default-modal-add" data-modal-toggle="default-modal-add">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Pertemuan
                </x-primary-button>
            </div>
        </div>

        {{-- LIST PERTEMUAN --}}
        <div class="space-y-4">
            @forelse ($meetings as $index => $meeting)
                <div
                    class="group bg-white rounded-xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition-all duration-300 relative overflow-hidden">

                    {{-- Decorative Side Bar based on Type --}}
                    <div
                        class="absolute left-0 top-0 bottom-0 w-1 {{ $meeting->type == 'ujian' ? 'bg-red-500' : 'bg-indigo-500' }}">
                    </div>

                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 pl-3">

                        {{-- KONTEN UTAMA --}}
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                {{-- Badge Nama Pertemuan --}}
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-bold uppercase tracking-wide {{ $meeting->type == 'ujian' ? 'bg-red-50 text-red-700 ring-1 ring-red-600/10' : 'bg-indigo-50 text-indigo-700 ring-1 ring-indigo-600/10' }}">
                                    {{ $meeting->meeting_name }}
                                </span>

                                {{-- Badge Tipe --}}
                                @if ($meeting->type == 'ujian')
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-red-100 text-red-800">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                            </path>
                                        </svg>
                                        UJIAN
                                    </span>
                                @endif
                            </div>

                            {{-- Topik --}}
                            <h3 class="text-lg font-bold text-gray-900 mb-1">
                                {{ $meeting->topic }}
                            </h3>

                            {{-- Deskripsi --}}
                            <p class="text-sm text-gray-600 leading-relaxed max-w-3xl">
                                {{ $meeting->description }}
                            </p>
                        </div>

                        {{-- AKSI / TOMBOL --}}
                        <div class="flex items-center gap-2 md:self-start mt-4 md:mt-0">

                            {{-- Tombol Khusus Ujian --}}
                            @if ($meeting->type == 'ujian')
                                <a href="{{ route('buat-test.create') }}"
                                    class="inline-flex items-center gap-2 px-3 py-1.5 bg-emerald-50 text-emerald-700 text-xs font-semibold rounded-lg hover:bg-emerald-100 transition border border-emerald-200 mr-2"
                                    data-tooltip-target="tooltip-ujian-{{ $index }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    Buat Soal
                                </a>
                                <div id="tooltip-ujian-{{ $index }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                    Kelola Soal Ujian
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            @endif

                            {{-- Tombol Edit --}}
                            <button type="button" data-modal-target="default-modal-update"
                                data-modal-toggle="default-modal-update" data-id="{{ $meeting->id }}"
                                data-meeting-name="{{ $meeting->meeting_name }}" data-topic="{{ $meeting->topic }}"
                                data-type="{{ $meeting->type }}" data-description="{{ $meeting->description }}"
                                class="text-gray-500 hover:text-yellow-600 transition-colors p-1 rounded hover:bg-yellow-50"
                                title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                            </button>
                            <div id="tooltip-edit-{{ $index }}" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                Edit Pertemuan
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>

                            {{-- Tombol Hapus --}}
                            <button type="button" data-modal-target="default-modal-delete"
                                data-modal-toggle="default-modal-delete" data-id="{{ $meeting->id }}"
                                class="text-gray-500 hover:text-red-600 transition-colors p-1 rounded hover:bg-red-50"
                                title="Hapus">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                            <div id="tooltip-delete-{{ $index }}" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                Hapus Pertemuan
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="flex flex-col items-center justify-center py-12 bg-white rounded-xl border border-dashed border-gray-300">
                    <div class="p-4 bg-gray-50 rounded-full mb-3">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <p class="text-gray-500 font-medium">Belum ada pertemuan dibuat</p>
                    <p class="text-gray-400 text-sm">Klik tombol di atas untuk menambahkan.</p>
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
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full] max-h-full backdrop-blur-sm
         ">

            <div class="relative p-4 w-full max-w-2xl max-h-full mt-28 md:mt-0">
                <div class="relative bg-primary rounded-lg shadow-sm px-4">
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                        <h3 class="text-xl font-semibold text-white">
                            Tambah Data Pertemuan
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

                    <form action="{{ route('pertemuan.store') }}" method="POST">
                        @csrf
                        <div class="p-4 md:p-5 space-y-4 mb-4">
                            <div class="">
                                <p class="text-secondary">Nama Pertemuan</p>
                                <x-text-input-secondary id="meeting_name" class="block w-full mt-1" type="text"
                                    name="meeting_name" :value="old('meeting_name')" required autofocus autocomplete="username"
                                    placeholder="contoh: Pertemuan 1" />
                                <x-input-error :messages="$errors->get('meeting_name')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Topik Pertemuan</p>
                                <x-text-input-secondary id="topic" class="block w-full mt-1" type="text"
                                    name="topic" :value="old('topic')" required autofocus autocomplete="username"
                                    placeholder="contoh: Makharijul Huruf" />
                                <x-input-error :messages="$errors->get('topic')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Tipe Pertemuan</p>
                                <select id="type" name="type"
                                    class="mt-1 bg-secondary border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="pretest">Pre Test</option>
                                    <option value="skb">Kelas Besar</option>
                                    <option value="skk">Kelas Kecil</option>
                                    <option value="posttest">Post Test</option>
                                    <option value="ujian">Ujian Akhir</option>
                                    <option value="ramah-tamah">Ramah Tamah</option>
                                </select>
                            </div>
                            <div class="">
                                <p class="text-secondary">Deskripsi Pertemuan</p>
                                <textarea name="description" id="description" rows="4"
                                    class="shadow-md block p-2.5 w-full text-sm text-gray-900 bg-secondary rounded-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500 "
                                    placeholder="Isi deskripsi disini ... "></textarea>
                                <x-input-error :messages="$errors->get('description')" />
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
                            Edit Data Pertemuan
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

                    <form action="" method="POST" id="formUpdate">
                        @csrf
                        @method('PUT')
                        <div class="p-4 md:p-5 space-y-4 mb-4">
                            <div class="">
                                <p class="text-secondary">Nama Pertemuan</p>
                                <x-text-input-secondary id="meeting_name" class="block w-full mt-1" type="text"
                                    name="meeting_name" :value="old('meeting_name')" required autofocus autocomplete="username"
                                    placeholder="contoh: Pertemuan 1" />
                                <x-input-error :messages="$errors->get('meeting_name')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Topik Pertemuan</p>
                                <x-text-input-secondary id="topic" class="block w-full mt-1" type="text"
                                    name="topic" :value="old('topic')" required autofocus autocomplete="username"
                                    placeholder="contoh: Makharijul Huruf" />
                                <x-input-error :messages="$errors->get('topic')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Tipe Pertemuan</p>
                                <select id="type" name="type"
                                    class="mt-1 bg-secondary border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="pretest">Pre Test</option>
                                    <option value="skb">Kelas Besar</option>
                                    <option value="skk">Kelas Kecil</option>
                                    <option value="posttest">Post Test</option>
                                    <option value="ujian">Ujian Akhir</option>
                                    <option value="ramah-tamah">Ramah Tamah</option>
                                </select>
                            </div>
                            <div class="">
                                <p class="text-secondary">Deskripsi Pertemuan</p>
                                <textarea name="description" id="description" rows="4"
                                    class="shadow-md block p-2.5 w-full text-sm text-gray-900 bg-secondary rounded-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500 "
                                    placeholder="Isi deskripsi disini ... "></textarea>
                                <x-input-error :messages="$errors->get('description')" />
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
                const meetingNameInput = modal.querySelector('#meeting_name');
                const topicInput = modal.querySelector('#topic');
                const typeSelect = modal.querySelector('#type');
                const descriptionInput = modal.querySelector('#description');
                const form = modal.querySelector('form');


                document.querySelectorAll('[data-modal-target="default-modal-update"]').forEach(button => {
                    button.addEventListener('click', () => {

                        const id = button.getAttribute('data-id');
                        const meetingName = button.getAttribute('data-meeting-name');
                        const topic = button.getAttribute('data-topic');;
                        const type = button.getAttribute('data-type');;
                        const description = button.getAttribute('data-description');


                        meetingNameInput.value = meetingName;
                        topicInput.value = topic;
                        typeSelect.value = type;
                        descriptionInput.value = description;

                        if (form) {
                            form.action = `/pertemuan/${id}`;
                        }
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
                            <p class="text-secondary text-center mt-5">Apakah anda yakin menghapus data pertemuan ini?</p>
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

                        deleteForm.action = `/pertemuan/${id}`;
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
