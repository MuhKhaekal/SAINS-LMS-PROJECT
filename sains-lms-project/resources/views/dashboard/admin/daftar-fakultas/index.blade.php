@extends('dashboard.admin.admin-base')

@section('page-title', 'SAINS - Daftar Fakultas')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- HEADER: Judul & Tombol Tambah --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Daftar Fakultas</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola data fakultas, kode, dan jumlah prodi.</p>
            </div>
            <div>
                <x-primary-button data-modal-target="default-modal-add" data-modal-toggle="default-modal-add">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Fakultas
                </x-primary-button>
            </div>
        </div>

        {{-- SEARCH SECTION --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-6">
            <form method="GET" action="{{ route('daftar-fakultas.index') }}" class="flex flex-col md:flex-row gap-4">

                <div class="relative flex-grow">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" placeholder="Cari nama atau kode fakultas..."
                        value="{{ request('search') }}"
                        class="pl-10 block w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                </div>

                <div class="flex gap-2 md:w-auto">
                    <button type="submit"
                        class="bg-gray-800 text-white px-6 py-2 rounded-lg text-sm hover:bg-gray-700 transition flex items-center gap-2 justify-center w-full md:w-auto">
                        Cari
                    </button>
                    <a href="{{ route('daftar-fakultas.index') }}"
                        class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-50 transition flex items-center justify-center"
                        title="Reset Filter">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                    </a>
                </div>
            </form>
        </div>

        {{-- BULK DELETE CONTEXT BAR --}}
        {{-- Form ini terpisah dari tabel agar HTML valid, JS akan mengurus input hidden --}}
        <form id="bulkDeleteForm" action="{{ route('daftar-fakultas.destroy-multiple') }}" method="POST">
            @csrf
            @method('DELETE')

            <div id="selectionBar"
                class="hidden mb-4 bg-blue-50 border border-blue-200 rounded-lg p-4 flex items-center justify-between transition-all duration-300">
                <div class="flex items-center gap-2 text-blue-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium text-sm"><span id="selectedCount">0</span> fakultas dipilih</span>
                </div>
                <div class="flex gap-3">
                    <button type="button" id="clearSelectionBtn"
                        class="text-sm text-gray-600 hover:text-gray-800 font-medium underline">
                        Batalkan
                    </button>
                    <button type="button" id="bulkDeleteBtn" data-modal-target="default-modal-delete"
                        data-modal-toggle="default-modal-delete"
                        class="bg-red-600 text-white text-xs px-4 py-2 rounded-md hover:bg-red-700 transition shadow-sm flex items-center gap-2">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        Hapus Terpilih
                    </button>
                </div>
            </div>

            {{-- TABLE SECTION --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-4 w-10">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="checkAll"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 font-semibold">Kode</th>
                                <th scope="col" class="px-6 py-3 font-semibold w-1/3">Nama Fakultas</th>
                                <th scope="col" class="px-6 py-3 font-semibold text-center">Jml Prodi</th>
                                <th scope="col" class="px-6 py-3 font-semibold text-center">Jml Halaqah</th>
                                <th scope="col" class="px-6 py-3 font-semibold text-center w-24">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($faculties as $index => $faculty)
                                <tr class="bg-white hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4">
                                        <input type="checkbox" name="ids[]" value="{{ $faculty->id }}"
                                            class="checkItem w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 cursor-pointer"
                                            data-id="{{ $faculty->id }}">
                                    </td>
                                    <td class="px-6 py-4 font-mono font-medium text-gray-600">
                                        {{ $faculty->faculty_code }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $faculty->faculty_name }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded border border-gray-200">
                                            {{ $faculty->prodies_count }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded border border-gray-200">
                                            {{ $faculty->halaqahs_count }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            {{-- Edit Button --}}
                                            <button type="button" data-modal-target="default-modal-update"
                                                data-modal-toggle="default-modal-update" data-id="{{ $faculty->id }}"
                                                data-faculty-code="{{ $faculty->faculty_code }}"
                                                data-faculty-name="{{ $faculty->faculty_name }}"
                                                class="text-gray-500 hover:text-yellow-600 transition-colors p-1 rounded hover:bg-yellow-50"
                                                title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </button>

                                            {{-- Delete Button --}}
                                            <button type="button" data-modal-target="default-modal-delete"
                                                data-modal-toggle="default-modal-delete" data-id="{{ $faculty->id }}"
                                                data-faculty-name="{{ $faculty->faculty_name }}"
                                                class="text-gray-500 hover:text-red-600 transition-colors p-1 rounded hover:bg-red-50"
                                                title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                </path>
                                            </svg>
                                            <p class="text-base font-medium">Tidak ada fakultas ditemukan</p>
                                            <p class="text-sm">Silakan tambah data baru atau ubah pencarian.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($faculties->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                        {{ $faculties->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </form>
    </div>

    {{-- SCRIPT SAMA DENGAN SEBELUMNYA --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkAll = document.getElementById('checkAll');
            const checkItems = document.querySelectorAll('.checkItem');
            const bulkDeleteForm = document.getElementById('bulkDeleteForm');

            // UI Elements
            const selectionBar = document.getElementById('selectionBar');
            const selectedCountSpan = document.getElementById('selectedCount');
            const clearBtn = document.getElementById('clearSelectionBtn');

            let selectedIds = JSON.parse(localStorage.getItem('selectedIds') || '[]');

            function syncCheckboxes() {
                checkItems.forEach(item => {
                    if (selectedIds.includes(item.value)) {
                        item.checked = true;
                    }
                });
                updateSelectionUI();
            }

            function updateSelectionUI() {
                const count = selectedIds.length;
                selectedCountSpan.innerText = count;

                if (count > 0) {
                    selectionBar.classList.remove('hidden');
                    const allOnPageChecked = Array.from(checkItems).every(item => item.checked);
                    if (checkItems.length > 0) checkAll.checked = allOnPageChecked;
                } else {
                    selectionBar.classList.add('hidden');
                    checkAll.checked = false;
                }
            }

            syncCheckboxes();

            checkItems.forEach(item => {
                item.addEventListener('change', () => {
                    if (item.checked) {
                        if (!selectedIds.includes(item.value)) selectedIds.push(item.value);
                    } else {
                        selectedIds = selectedIds.filter(id => id !== item.value);
                    }
                    localStorage.setItem('selectedIds', JSON.stringify(selectedIds));
                    updateSelectionUI();
                });
            });

            if (checkAll) {
                checkAll.addEventListener('change', function() {
                    const isChecked = checkAll.checked;
                    checkItems.forEach(item => {
                        item.checked = isChecked;
                        if (isChecked) {
                            if (!selectedIds.includes(item.value)) selectedIds.push(item.value);
                        } else {
                            selectedIds = selectedIds.filter(id => id !== item.value);
                        }
                    });
                    localStorage.setItem('selectedIds', JSON.stringify(selectedIds));
                    updateSelectionUI();
                });
            }

            bulkDeleteForm.addEventListener('submit', function() {
                const existingInputs = bulkDeleteForm.querySelectorAll(
                'input[name="ids[]"][type="hidden"]');
                existingInputs.forEach(el => el.remove());

                selectedIds.forEach(id => {
                    const hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = 'ids[]';
                    hidden.value = id;
                    bulkDeleteForm.appendChild(hidden);
                });

                localStorage.removeItem('selectedIds');
            });

            clearBtn.addEventListener('click', function() {
                selectedIds = [];
                checkItems.forEach(item => item.checked = false);
                checkAll.checked = false;
                localStorage.removeItem('selectedIds');
                updateSelectionUI();
            });
        });
    </script>


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
