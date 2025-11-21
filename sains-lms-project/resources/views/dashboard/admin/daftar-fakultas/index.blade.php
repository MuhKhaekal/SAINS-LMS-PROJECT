@extends('dashboard.admin.admin-base')

@section('page-title', 'SAINS - Daftar Fakultas')

@section('content')
    <h1 class="text-primary font-extrabold text-2xl mt-20 md:mt-6 md:mx-12">Daftar Fakultas</h1>

    <section class="md:mx-12">
        <form method="GET" action="{{ route('daftar-fakultas.index') }}"
            class="flex flex-wrap md:flex-nowrap gap-2 items-center mt-6 w-full border border-dashed rounded-md p-4">

            <input type="text" name="search" placeholder="Cari ..." value="{{ request('search') }}"
                class="border border-gray-300 focus:border-gray-500 text-sm focus:ring-blue-500 rounded-md px-3 py-2 flex-grow md:basis-5/12 focus:outline-none">

            <button type="submit"
                class="bg-primary text-white px-4 py-2 rounded-md hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-1500 md:basis-2/12 w-full flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m21 21-4.35-4.35m2.1-5.4A7.75 7.75 0 1 1 4 8.75a7.75 7.75 0 0 1 14.75 2.5Z" />
                </svg>
                Cari
            </button>

            <a href="{{ route('daftar-fakultas.index') }}"
                class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md  hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 md:basis-2/12 w-full text-center flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Hapus Filter
            </a>
        </form>
    </section>

    <section class="md:mx-12">
        <form id="bulkDeleteForm" action="{{ route('daftar-fakultas.destroy-multiple') }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                <div class="flex gap-x-4 m-4">
                    <button type="button" id="bulkDeleteBtn"
                        class="px-4 py-2 bg-red-500 border border-transparent rounded-md font-normal text-xs text-white  tracking-widest hover:bg-red-600 focus:bg-red-600 active:bg-red-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        data-modal-target="default-modal-delete" data-modal-toggle="default-modal-delete">
                        Hapus yang Dipilih
                    </button>

                    <button type="button" id="clearSelectionBtn"
                        class="text-xs px-4 py-2 bg-gray-300 text-gray-700 rounded-md  hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 hidden">
                        Batalkan Pilihan
                    </button>
                </div>

                <table class="w-full text-sm text-left rtl:text-right text-gray-400">
                    <thead class="text-xs uppercase bg-primary text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 w-1/12">
                                <input type="checkbox" id="checkAll">
                            </th>
                            <th scope="col" class="px-6 py-3 w-2/12">
                                Kode Fakultas
                            </th>
                            <th scope="col" class="px-6 py-3 w-4/12">
                                Nama Fakultas
                            </th>
                            <th scope="col" class="px-6 py-3 w-2/12">
                                Jumlah Prodi
                            </th>
                            <th scope="col" class="px-6 py-3 w-2/12">
                                Jenis Halaqah
                            </th>
                            <th scope="col" class="px-6 py-3 w-1/12">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($faculties as $faculty)
                            <tr class="bg-white hover:bg-gray-100 text-primary border-b">
                                <td class="px-6 py-4">
                                    <input type="checkbox" name="ids[]" value="{{ $faculty->id }}" class="checkItem"
                                        data-id="{{ $faculty->id }}">
                                </td>

                                <td class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{ $faculty->faculty_code }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $faculty->faculty_name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $faculty->prodies_count }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $faculty->halaqahs_count }}
                                </td>
                                <td class="px-6 py-4 flex gap-2">
                                    <button type="button" data-modal-target="default-modal-update"
                                        data-modal-toggle="default-modal-update" data-id="{{ $faculty->id }}"
                                        data-faculty-code="{{ $faculty->faculty_code }}"
                                        data-faculty-name="{{ $faculty->faculty_name }}"
                                        class="font-medium hover:underline">
                                        <svg class="w-7 h-7 text-secondary bg-yellow-500 hover:bg-yellow-600 hover:text-white rounded-md p-1"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>

                                    <button type="button" class="font-medium hover:underline"
                                        data-modal-target="default-modal-delete" data-modal-toggle="default-modal-delete"
                                        data-id="{{ $faculty->id }}" data-faculty-name="{{ $faculty->faculty_name }}">
                                        <svg class="w-7 h-7 text-secondary bg-red-500 hover:bg-red-600 hover:text-white rounded-md p-1"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </form>


        <div class="mt-4">
            {{ $faculties->appends(request()->query())->links() }}
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const checkAll = document.getElementById('checkAll');
                const checkItems = document.querySelectorAll('.checkItem');
                const deleteBtn = document.getElementById('bulkDeleteBtn');
                const clearBtn = document.getElementById('clearSelectionBtn');

                let selectedIds = JSON.parse(localStorage.getItem('selectedIds') || '[]');

                checkItems.forEach(item => {
                    if (selectedIds.includes(item.value)) {
                        item.checked = true;
                    }
                });

                function toggleDeleteButton() {
                    const anyChecked = selectedIds.length > 0;

                    deleteBtn.classList.toggle('hidden', !anyChecked);
                    clearBtn.classList.toggle('hidden', !anyChecked);
                }
                toggleDeleteButton();

                checkItems.forEach(item => {
                    item.addEventListener('change', () => {
                        if (item.checked) {
                            if (!selectedIds.includes(item.value)) selectedIds.push(item.value);
                        } else {
                            selectedIds = selectedIds.filter(id => id !== item.value);
                        }

                        localStorage.setItem('selectedIds', JSON.stringify(selectedIds));
                        toggleDeleteButton();
                    });
                });

                checkAll.addEventListener('change', function() {
                    checkItems.forEach(item => {
                        item.checked = checkAll.checked;

                        if (checkAll.checked && !selectedIds.includes(item.value)) {
                            selectedIds.push(item.value);
                        } else if (!checkAll.checked) {
                            selectedIds = selectedIds.filter(id => id !== item.value);
                        }
                    });

                    localStorage.setItem('selectedIds', JSON.stringify(selectedIds));
                    toggleDeleteButton();
                });

                const bulkForm = document.getElementById('bulkDeleteForm');
                bulkForm.addEventListener('submit', function() {
                    selectedIds.forEach(id => {
                        const hidden = document.createElement('input');
                        hidden.type = 'hidden';
                        hidden.name = 'ids[]';
                        hidden.value = id;
                        bulkForm.appendChild(hidden);
                    });

                    localStorage.removeItem('selectedIds');
                });

                clearBtn.addEventListener('click', function() {
                    selectedIds = [];
                    checkItems.forEach(item => item.checked = false);
                    checkAll.checked = false;

                    localStorage.removeItem('selectedIds');
                    toggleDeleteButton();
                });
            });
        </script>


    </section>

    <section class="md:mx-12 mt-10 flex justify-center md:justify-start md:mt-5 gap-4">
        <x-primary-button class="text-center" data-modal-target="default-modal-add"
            data-modal-toggle="default-modal-add">
            {{ __('+ Tambah Data Fakultas') }}
        </x-primary-button>
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
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full] max-h-full backdrop-blur-sm
         ">

            <div class="relative p-4 w-full max-w-2xl max-h-full mt-28 md:mt-0">
                <div class="relative bg-primary rounded-lg shadow-sm px-4">
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                        <h3 class="text-xl font-semibold text-white">
                            Tambah Data Fakultas
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

                    <form action="{{ route('daftar-fakultas.store') }}" method="POST">
                        @csrf
                        <div class="p-4 md:p-5 space-y-4 mb-4">
                            <div class="">
                                <p class="text-secondary">Kode Fakultas</p>
                                <x-text-input-secondary id="faculty_code" class="block w-full mt-1" type="text"
                                    name="faculty_code" :value="old('faculty_code')" required autofocus autocomplete="faculty_code"
                                    placeholder="Kode Fakultas" />
                                <x-input-error :messages="$errors->get('faculty_code')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Nama Fakultas</p>
                                <x-text-input-secondary id="faculty_name" class="block w-full mt-1" type="text"
                                    name="faculty_name" :value="old('faculty_name')" required autofocus autocomplete="faculty_name"
                                    placeholder="Nama Fakultas" />
                                <x-input-error :messages="$errors->get('faculty_name')" />
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
                            Edit Data Fakultas
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
                                <p class="text-secondary">Kode Fakultas</p>
                                <x-text-input-secondary id="faculty_code" class="block w-full mt-1" type="text"
                                    name="faculty_code" :value="old('faculty_code')" required autofocus autocomplete="faculty_code"
                                    placeholder="Kode Fakultas" />
                                <x-input-error :messages="$errors->get('faculty_code')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Nama Fakultas</p>
                                <x-text-input-secondary id="faculty_name" class="block w-full mt-1" type="text"
                                    name="faculty_name" :value="old('faculty_name')" required autofocus autocomplete="Nama Fakultas"
                                    placeholder="faculty_name" />
                                <x-input-error :messages="$errors->get('faculty_name')" />
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
                const facultyCode = modal.querySelector('#faculty_code');
                const facultyName = modal.querySelector('#faculty_name');
                const form = modal.querySelector('form');


                document.querySelectorAll('[data-modal-target="default-modal-update"]').forEach(button => {
                    button.addEventListener('click', () => {

                        const id = button.getAttribute('data-id');
                        const code = button.getAttribute('data-faculty-code');
                        const name = button.getAttribute('data-faculty-name');


                        facultyCode.value = code;
                        facultyName.value = name;

                        if (form) {
                            form.action = `/daftar-fakultas/${id}`;
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
                            <p class="text-secondary text-center mt-5">Apakah anda yakin untuk menghapus data "<span
                                    id="faculty_name"></span>"?</p>
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
                const modal = document.getElementById('default-modal-delete');
                const facultyName = modal.querySelector('#faculty_name');
                const form = document.getElementById('deleteForm');
                const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
                const bulkForm = document.getElementById('bulkDeleteForm');

                document.querySelectorAll('[data-modal-target="default-modal-delete"]').forEach(button => {
                    if (button !== bulkDeleteBtn) {
                        button.addEventListener('click', () => {
                            const id = button.getAttribute('data-id');
                            const name = button.getAttribute('data-faculty-name');

                            facultyName.textContent = name;
                            form.action = `/daftar-fakultas/${id}`;
                            form.dataset.type = 'single';
                        });
                    }
                });

                bulkDeleteBtn.addEventListener('click', () => {
                    const selectedIds = JSON.parse(localStorage.getItem('selectedIds') || '[]');
                    if (selectedIds.length === 0) return;

                    facultyName.textContent = `${selectedIds.length} fakultas yang dipilih`;
                    form.action = "{{ route('daftar-fakultas.destroy-multiple') }}";
                    form.dataset.type = 'bulk';
                });

                form.addEventListener('submit', function(e) {
                    if (form.dataset.type === 'bulk') {
                        const selectedIds = JSON.parse(localStorage.getItem('selectedIds') || '[]');
                        selectedIds.forEach(id => {
                            const hidden = document.createElement('input');
                            hidden.type = 'hidden';
                            hidden.name = 'ids[]';
                            hidden.value = id;
                            form.appendChild(hidden);
                        });
                        localStorage.removeItem('selectedIds');
                    }
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
        </script>
    @endif







@endsection
