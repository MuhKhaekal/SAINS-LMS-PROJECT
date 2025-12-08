@extends('dashboard.admin.admin-base')

@section('page-title', 'SAINS - Daftar Halaqah')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- HEADER: Judul & Tombol Tambah --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Daftar Halaqah</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola kelompok halaqah, asisten, dan prodi terkait.</p>
            </div>
            <div>
                <x-primary-button data-modal-target="default-modal-add" data-modal-toggle="default-modal-add">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Halaqah
                </x-primary-button>
            </div>
        </div>

        {{-- FILTER SECTION --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-6">
            <form method="GET" action="{{ route('daftar-halaqah.index') }}"
                class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">

                {{-- Search Input --}}
                <div class="md:col-span-4">
                    <label for="search" class="block text-xs font-medium text-gray-700 mb-1">Pencarian</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="search"
                            placeholder="Nama Halaqah, Kode, atau Asisten..." value="{{ request('search') }}"
                            class="pl-10 block w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                    </div>
                </div>

                {{-- Filter Jenis Halaqah --}}
                <div class="md:col-span-3">
                    <label for="halaqah_type" class="block text-xs font-medium text-gray-700 mb-1">Jenis Halaqah</label>
                    <select name="halaqah_type" id="halaqah_type"
                        class="block w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                        <option value="">Semua Jenis</option>
                        <option value="Halaqah Akhwat" {{ request('halaqah_type') == 'Halaqah Akhwat' ? 'selected' : '' }}>
                            Halaqah Akhwat</option>
                        <option value="Halaqah Ikhwan" {{ request('halaqah_type') == 'Halaqah Ikhwan' ? 'selected' : '' }}>
                            Halaqah Ikhwan</option>
                    </select>
                </div>

                {{-- Filter Prodi --}}
                <div class="md:col-span-3">
                    <label for="prodi" class="block text-xs font-medium text-gray-700 mb-1">Program Studi</label>
                    <select name="prodi" id="prodi"
                        class="block w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                        <option value="">Semua Prodi</option>
                        @foreach ($prodis as $prodi)
                            <option value="{{ $prodi->id }}" {{ request('prodi') == $prodi->id ? 'selected' : '' }}>
                                {{ $prodi->prodi_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Buttons --}}
                <div class="md:col-span-2 flex gap-2">
                    <button type="submit"
                        class="w-full bg-gray-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-700 transition">
                        Cari
                    </button>
                    <a href="{{ route('daftar-halaqah.index') }}"
                        class="w-full bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-50 text-center transition flex items-center justify-center"
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
        <form id="bulkDeleteForm" action="{{ route('daftar-halaqah.destroy-multiple') }}" method="POST">
            @csrf
            @method('DELETE')

            <div id="selectionBar"
                class="hidden mb-4 bg-blue-50 border border-blue-200 rounded-lg p-4 flex items-center justify-between transition-all duration-300">
                <div class="flex items-center gap-2 text-blue-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium text-sm"><span id="selectedCount">0</span> halaqah dipilih</span>
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
                                <th scope="col" class="px-6 py-3 font-semibold">Nama Halaqah</th>
                                <th scope="col" class="px-6 py-3 font-semibold">Jenis</th>
                                <th scope="col" class="px-6 py-3 font-semibold">Prodi</th>
                                <th scope="col" class="px-6 py-3 font-semibold">Asisten</th>
                                <th scope="col" class="px-6 py-3 font-semibold text-center w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($halaqahs as $index => $halaqah)
                                <tr class="bg-white hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4">
                                        <input type="checkbox" name="ids[]" value="{{ $halaqah->id }}"
                                            class="checkItem w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 cursor-pointer"
                                            data-id="{{ $halaqah->id }}">
                                    </td>
                                    <td class="px-6 py-4 font-mono font-medium text-gray-600">
                                        {{ $halaqah->halaqah_code }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $halaqah->halaqah_name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($halaqah->halaqah_type == 'Halaqah Ikhwan')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                                Ikhwan
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-50 text-pink-700 border border-pink-100">
                                                Akhwat
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $halaqah->prodi->prodi_name ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-600">
                                                {{ substr($halaqah->asisten->first()->nama ?? 'A', 0, 1) }}
                                            </div>
                                            <span class="text-sm text-gray-700 truncate max-w-[150px]"
                                                title="{{ $halaqah->asisten->first()->nama ?? '-' }}">
                                                {{ $halaqah->asisten->first()->nama ?? '-' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-1">
                                            {{-- Report Buttons Group --}}
                                            <div class="flex bg-gray-100 rounded-md p-0.5 border border-gray-200">
                                                <button type="button"
                                                    class="p-1 hover:bg-white hover:text-green-600 rounded transition-colors text-gray-400"
                                                    title="Laporan 1"
                                                    data-tooltip-target="tooltip-report1-{{ $index }}">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                                        <path fill-rule="evenodd"
                                                            d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                                <button type="button"
                                                    class="p-1 hover:bg-white hover:text-green-600 rounded transition-colors text-gray-400"
                                                    title="Laporan 2"
                                                    data-tooltip-target="tooltip-report2-{{ $index }}">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </div>

                                            {{-- Edit Button --}}
                                            <button type="button" data-modal-target="default-modal-update"
                                                data-modal-toggle="default-modal-update" data-id="{{ $halaqah->id }}"
                                                data-halaqah-code="{{ $halaqah->halaqah_code }}"
                                                data-halaqah-name="{{ $halaqah->halaqah_name }}"
                                                data-halaqah-type="{{ $halaqah->halaqah_type }}"
                                                data-prodi="{{ $halaqah->prodi_id }}"
                                                data-user="{{ $halaqah->asisten->first()->id ?? '-' }}"
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
                                                data-modal-toggle="default-modal-delete" data-id="{{ $halaqah->id }}"
                                                data-halaqah-name="{{ $halaqah->halaqah_name }}"
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

                                        {{-- Tooltips (Optional jika ingin tetap pakai Flowbite Tooltip) --}}
                                        <div id="tooltip-report1-{{ $index }}" role="tooltip"
                                            class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                            Laporan 1
                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                        </div>
                                        <div id="tooltip-report2-{{ $index }}" role="tooltip"
                                            class="absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                            Laporan 2
                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                            <p class="text-base font-medium">Tidak ada Halaqah ditemukan</p>
                                            <p class="text-sm">Silakan tambah data baru atau sesuaikan filter pencarian.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($halaqahs->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                        {{ $halaqahs->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </form>
    </div>

    {{-- SCRIPT SAMA DENGAN HALAMAN LAINNYA --}}
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
                            Tambah Data Halaqah
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

                    <form action="{{ route('daftar-halaqah.store') }}" method="POST">
                        @csrf
                        <div class="p-4 md:p-5 space-y-4 mb-4">
                            <div class="">
                                <p class="text-secondary">Kode Halaqah</p>
                                <x-text-input-secondary id="halaqah_code" class="block w-full mt-1" type="text"
                                    name="halaqah_code" :value="old('halaqah_code')" required autofocus autocomplete="username"
                                    placeholder="Kode Halaqah" />
                                <x-input-error :messages="$errors->get('halaqah_code')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Nama Halaqah</p>
                                <x-text-input-secondary id="halaqah_name" class="block w-full mt-1" type="text"
                                    name="halaqah_name" :value="old('halaqah_name')" required autofocus autocomplete="username"
                                    placeholder="Nama Halaqah" />
                                <x-input-error :messages="$errors->get('halaqah_name')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Jenis Halaqah</p>
                                <select id="halaqah_type" name="halaqah_type"
                                    class="bg-secondary border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="" disabled selected>Pilih Jenis Halaqah</option>
                                    <option value="Halaqah Akhwat">Halaqah Akhwat</option>
                                    <option value="Halaqah Ikhwan">Halaqah Ikhwan</option>
                                </select>
                                <x-input-error :messages="$errors->get('halaqah_type')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Program Studi</p>
                                <select id="prodi_id" name="prodi_id"
                                    class="bg-secondary border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="" disabled selected>Pilih Program Studi</option>
                                    @foreach ($prodis as $prodi)
                                        <option value="{{ $prodi->id }}">{{ $prodi->prodi_name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('prodi_id')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Nama Asisten</p>
                                <select id="user_id" name="user_id"
                                    class="bg-secondary border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="">Belum ada</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                    @endforeach
                                </select>
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
                            Edit Data Halaqah
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
                                <p class="text-secondary">Kode Halaqah</p>
                                <x-text-input-secondary id="halaqah_code" class="block w-full mt-1" type="text"
                                    name="halaqah_code" :value="old('halaqah_code')" required autofocus autocomplete="username"
                                    placeholder="Kode Halaqah" />
                                <x-input-error :messages="$errors->get('halaqah_code')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Nama Halaqah</p>
                                <x-text-input-secondary id="halaqah_name" class="block w-full mt-1" type="text"
                                    name="halaqah_name" :value="old('halaqah_name')" required autofocus autocomplete="username"
                                    placeholder="Nama Halaqah" />
                                <x-input-error :messages="$errors->get('halaqah_name')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Jenis Halaqah</p>
                                <select id="halaqah_type" name="halaqah_type"
                                    class="bg-secondary border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="" disabled selected>Pilih Jenis Halaqah</option>
                                    <option value="Halaqah Akhwat">Halaqah Akhwat</option>
                                    <option value="Halaqah Ikhwan">Halaqah Ikhwan</option>
                                </select>
                                <x-input-error :messages="$errors->get('halaqah_type')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Program Studi</p>
                                <select id="prodi_id" name="prodi_id"
                                    class="bg-secondary border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="" disabled selected>Pilih Program Studi</option>
                                    @foreach ($prodis as $prodi)
                                        <option value="{{ $prodi->id }}">{{ $prodi->prodi_name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('prodi_id')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Nama Asisten</p>
                                <select id="user_id" name="user_id"
                                    class="bg-secondary border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="">Belum ada</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                    @endforeach
                                </select>
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
                const halaqahCodeInput = modal.querySelector('#halaqah_code');
                const halaqahNameInput = modal.querySelector('#halaqah_name');
                const halaqahTypeSelect = modal.querySelector('#halaqah_type');
                const prodiSelect = modal.querySelector('#prodi_id');
                const userSelect = modal.querySelector('#user_id');
                const form = modal.querySelector('form');


                document.querySelectorAll('[data-modal-target="default-modal-update"]').forEach(button => {
                    button.addEventListener('click', () => {

                        const id = button.getAttribute('data-id');
                        const halaqahCode = button.getAttribute('data-halaqah-code');
                        const halaqahName = button.getAttribute('data-halaqah-name');
                        const halaqahType = button.getAttribute('data-halaqah-type');
                        const prodi = button.getAttribute('data-prodi');
                        const user = button.getAttribute('data-user');


                        halaqahCodeInput.value = halaqahCode;
                        halaqahNameInput.value = halaqahName;
                        halaqahTypeSelect.value = halaqahType;
                        prodiSelect.value = prodi;
                        if (user === '-' || user === null) {
                            userSelect.value = ''; // pilih "Belum ada"
                        } else {
                            userSelect.value = user;
                        }


                        if (form) {
                            form.action = `/daftar-halaqah/${id}`;
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
                            <p class="text-secondary text-center mt-5">Apakah anda yakin untuk menghapus data halaqah
                                "<span id="halaqah-name"></span>"?</p>
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
                const namaHalaqahInput = modal.querySelector('#halaqah-name');
                const form = document.getElementById('deleteForm');
                const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
                const bulkForm = document.getElementById('bulkDeleteForm');

                // === DELETE SATU DATA ===
                document.querySelectorAll('[data-modal-target="default-modal-delete"]').forEach(button => {
                    if (button !== bulkDeleteBtn) { // hindari bentrok dengan tombol massal
                        button.addEventListener('click', () => {
                            const id = button.getAttribute('data-id');
                            const namaHalaqah = button.getAttribute('data-halaqah-name');

                            namaHalaqahInput.textContent = namaHalaqah;
                            form.action = `/daftar-halaqah/${id}`;
                            form.dataset.type = 'single';
                        });
                    }
                });

                // === DELETE MULTIPLE ===
                bulkDeleteBtn.addEventListener('click', () => {
                    const selectedIds = JSON.parse(localStorage.getItem('selectedIds') || '[]');
                    if (selectedIds.length === 0) return;

                    namaHalaqahInput.textContent = `${selectedIds.length} data halaqah yang dipilih`;
                    form.action = "{{ route('daftar-halaqah.destroy-multiple') }}";
                    form.dataset.type = 'bulk';
                });

                // === KETIKA FORM DI-SUBMIT ===
                form.addEventListener('submit', function(e) {
                    if (form.dataset.type === 'bulk') {
                        // Tambahkan input hidden untuk setiap id terpilih
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
