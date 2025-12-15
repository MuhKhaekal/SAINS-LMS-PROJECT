@extends('dashboard.admin.admin-base')

@section('page-title', 'SAINS - Daftar Pengguna')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-14 md:mt-0">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Daftar Pengguna</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola data pengguna, asisten, dan praktikan.</p>
            </div>
            <div class="flex gap-3">
                <x-primary-button data-modal-target="default-modal-excel" data-modal-toggle="default-modal-excel"
                    class="bg-emerald-600 hover:bg-emerald-700 focus:ring-emerald-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Impor Excel
                </x-primary-button>
                <x-primary-button data-modal-target="default-modal-add" data-modal-toggle="default-modal-add">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Akun
                </x-primary-button>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-6">
            <form method="GET" action="{{ route('daftar-pengguna.index') }}"
                class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">

                <div class="md:col-span-4">
                    <label for="search" class="block text-xs font-medium text-gray-700 mb-1">Pencarian</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="search" placeholder="Nama, NIM, atau Email..."
                            value="{{ request('search') }}"
                            class="pl-10 block w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                    </div>
                </div>

                <div class="md:col-span-3">
                    <label for="role" class="block text-xs font-medium text-gray-700 mb-1">Role</label>
                    <select name="role" id="role"
                        class="block w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                        <option value="">Semua Role</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="asisten" {{ request('role') == 'asisten' ? 'selected' : '' }}>Asisten</option>
                        <option value="praktikan" {{ request('role') == 'praktikan' ? 'selected' : '' }}>Praktikan</option>
                    </select>
                </div>

                <div class="md:col-span-3">
                    <label for="gender" class="block text-xs font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                    <select name="gender" id="gender"
                        class="block w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                        <option value="">Semua Gender</option>
                        <option value="L" {{ request('gender') == 'L' ? 'selected' : '' }}>Laki-laki (Ikhwan)</option>
                        <option value="P" {{ request('gender') == 'P' ? 'selected' : '' }}>Perempuan (Akhwat)</option>
                    </select>
                </div>

                <div class="md:col-span-2 flex gap-2">
                    <button type="submit"
                        class="w-full bg-gray-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-700 transition">
                        Cari
                    </button>
                    <a href="{{ route('daftar-pengguna.index') }}"
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

        <form id="bulkDeleteForm" action="{{ route('daftar-pengguna.destroy-multiple') }}" method="POST">
            @csrf
            @method('DELETE')

            <div id="selectionBar"
                class="hidden mb-4 bg-blue-50 border border-blue-200 rounded-lg p-4 flex items-center justify-between transition-all duration-300">
                <div class="flex items-center gap-2 text-blue-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium text-sm"><span id="selectedCount">0</span> pengguna dipilih</span>
                    <span class="text-xs text-blue-500">(Termasuk halaman lain)</span>
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
                                <th scope="col" class="px-6 py-3 font-semibold">Nama Pengguna</th>
                                <th scope="col" class="px-6 py-3 font-semibold">NIM</th>
                                <th scope="col" class="px-6 py-3 font-semibold">Role</th>
                                <th scope="col" class="px-6 py-3 font-semibold">Gender</th>
                                <th scope="col" class="px-6 py-3 font-semibold text-center w-24">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($users as $index => $user)
                                <tr class="bg-white hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4">
                                        @if ($user->role !== 'admin')
                                            <input type="checkbox" name="ids[]" value="{{ $user->id }}"
                                                class="checkItem w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 cursor-pointer"
                                                data-id="{{ $user->id }}">
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('daftar-pengguna.show', $user->id) }}"
                                            class="font-medium text-gray-900 hover:text-indigo-600 hover:underline transition-colors cursor-pointer">{{ $user->nama }}</a>
                                        <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 font-mono text-gray-600">
                                        {{ $user->nim ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $roleClasses = match ($user->role) {
                                                'admin' => 'bg-purple-100 text-purple-800 border-purple-200',
                                                'asisten' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                'praktikan' => 'bg-green-100 text-green-800 border-green-200',
                                                default => 'bg-gray-100 text-gray-800 border-gray-200',
                                            };
                                        @endphp
                                        <span
                                            class="px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $roleClasses }} capitalize">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($user->gender == 'L')
                                            <span
                                                class="inline-flex items-center gap-1 text-xs font-medium text-blue-700 bg-blue-50 px-2 py-1 rounded border border-blue-100">
                                                Laki-laki
                                            </span>
                                        @elseif($user->gender == 'P')
                                            <span
                                                class="inline-flex items-center gap-1 text-xs font-medium text-pink-700 bg-pink-50 px-2 py-1 rounded border border-pink-100">
                                                Perempuan
                                            </span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button type="button" data-modal-target="default-modal-update"
                                                data-modal-toggle="default-modal-update" data-id="{{ $user->id }}"
                                                data-nama="{{ $user->nama }}" data-nim="{{ $user->nim }}"
                                                data-gender="{{ $user->gender }}" data-role="{{ $user->role }}"
                                                data-halaqah="{{ optional($user->halaqahs->first())->id }}"
                                                class="text-gray-500 hover:text-yellow-600 transition-colors p-1 rounded hover:bg-yellow-50"
                                                title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </button>

                                            <button type="button" data-modal-target="default-modal-delete"
                                                data-modal-toggle="default-modal-delete" data-id="{{ $user->id }}"
                                                data-nama="{{ $user->nama }}"
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
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                </path>
                                            </svg>
                                            <p class="text-base font-medium">Tidak ada pengguna ditemukan</p>
                                            <p class="text-sm">Coba ubah filter atau kata kunci pencarian Anda.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($users->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                        {{ $users->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkAll = document.getElementById('checkAll');
            const checkItems = document.querySelectorAll('.checkItem');
            const bulkDeleteForm = document.getElementById('bulkDeleteForm');


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
                            Tambah Akun
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

                    <form action="{{ route('daftar-pengguna.store') }}" method="POST">
                        @csrf
                        <div class="p-4 md:p-5 space-y-4 mb-4">
                            <div class="">
                                <p class="text-secondary">Nama</p>
                                <x-text-input-secondary id="nama" class="block w-full mt-1" type="text"
                                    name="nama" :value="old('nama')" required autofocus autocomplete="username"
                                    placeholder="Nama" />
                                <x-input-error :messages="$errors->get('nama')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">NIM</p>
                                <x-text-input-secondary id="nim" class="block w-full mt-1" type="text"
                                    name="nim" :value="old('nim')" required autofocus autocomplete="username"
                                    placeholder="NIM" />
                                <x-input-error :messages="$errors->get('nim')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Password</p>
                                <x-text-input-secondary id="password" class="block w-full mt-1" type="password"
                                    name="password" :value="old('password')" required autofocus autocomplete="username"
                                    placeholder="Password" />
                                <x-input-error :messages="$errors->get('password')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Konfimasi Password</p>
                                <x-text-input-secondary id="password_confirmation" class="block w-full mt-1"
                                    type="password" name="password_confirmation" :value="old('password_confirmation')" required autofocus
                                    autocomplete="username" placeholder="Konfirmasi Password" />
                                <x-input-error :messages="$errors->get('password')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Jenis Kelamin</p>
                                <select id="gender" name="gender"
                                    class="bg-secondary border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="">
                                <p class="text-secondary">Role</p>
                                <select id="role" name="role"
                                    class="bg-secondary border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="admin">Admin</option>
                                    <option value="asisten">Asisten</option>
                                    <option value="praktikan">Praktikan</option>
                                </select>
                            </div>
                            <div id="halaqahWrapper" class="">
                                <p class="text-secondary">Halaqah</p>
                                <select id="halaqah_id" name="halaqah_id"
                                    class="bg-secondary border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="">Belum ada</option>
                                    @foreach ($halaqahs as $halaqah)
                                        <option value="{{ $halaqah->id }}">{{ $halaqah->halaqah_name }}</option>
                                    @endforeach
                                </select>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {

                                        const roleSelect = document.getElementById("role");
                                        const halaqahWrapper = document.getElementById("halaqahWrapper");

                                        function toggleHalaqah() {
                                            if (roleSelect.value === "praktikan") {
                                                halaqahWrapper.classList.remove("hidden");
                                            } else {
                                                halaqahWrapper.classList.add("hidden");
                                            }
                                        }

                                        toggleHalaqah();

                                        roleSelect.addEventListener("change", toggleHalaqah);
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


    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const roleUpdate = document.getElementById("role_update");
            const halaqahWrapperUpdate = document.getElementById("halaqahWrapper_update");

            function toggleHalaqahUpdate() {
                if (roleUpdate.value === "praktikan") {
                    halaqahWrapperUpdate.classList.remove("hidden");
                } else {
                    halaqahWrapperUpdate.classList.add("hidden");
                }
            }

            roleUpdate.addEventListener("change", toggleHalaqahUpdate);


            window.toggleHalaqahUpdate = toggleHalaqahUpdate;
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

        <div id="default-modal-update" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full] max-h-full backdrop-blur-sm
         ">

            <div class="relative p-4 w-full max-w-2xl max-h-full mt-28 md:mt-0">
                <div class="relative bg-primary rounded-lg shadow-sm px-4">
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                        <h3 class="text-xl font-semibold text-white">
                            Edit Akun
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
                                <p class="text-secondary">Nama</p>
                                <x-text-input-secondary id="nama" class="block w-full mt-1" type="text"
                                    name="nama" :value="old('nama')" required autofocus autocomplete="username"
                                    placeholder="Nama" />
                                <x-input-error :messages="$errors->get('nama')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">NIM</p>
                                <x-text-input-secondary id="nim" class="block w-full mt-1" type="text"
                                    name="nim" :value="old('nim')" required autofocus autocomplete="username"
                                    placeholder="NIM" />
                                <x-input-error :messages="$errors->get('nim')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Password</p>
                                <x-text-input-secondary id="password" class="block w-full mt-1" type="password"
                                    name="password" :value="old('password')" autofocus autocomplete="username"
                                    placeholder="Password" />
                                <x-input-error :messages="$errors->get('password')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Konfimasi Password</p>
                                <x-text-input-secondary id="password_confirmation" class="block w-full mt-1"
                                    type="password" name="password_confirmation" :value="old('password_confirmation')" autofocus
                                    autocomplete="username" placeholder="Konfirmasi Password" />
                                <x-input-error :messages="$errors->get('password')" />
                            </div>
                            <div class="">
                                <p class="text-secondary">Jenis Kelamin</p>
                                <select id="gender" name="gender"
                                    class="bg-secondary border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="">
                                <p class="text-secondary">Role</p>
                                <select id="role_update" name="role"
                                    class="bg-secondary border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="admin">Admin</option>
                                    <option value="asisten">Asisten</option>
                                    <option value="praktikan">Praktikan</option>
                                </select>
                            </div>
                            <div id="halaqahWrapper_update" class="hidden">
                                <p class="text-secondary">Halaqah</p>
                                <select id="halaqah_id" name="halaqah_id"
                                    class="bg-secondary border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="">Belum ada</option>
                                    @foreach ($halaqahs as $halaqah)
                                        <option value="{{ $halaqah->id }}">{{ $halaqah->halaqah_name }}</option>
                                    @endforeach
                                </select>
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

                const namaInput = modal.querySelector('#nama');
                const nimInput = modal.querySelector('#nim');
                const genderSelect = modal.querySelector('#gender');

                const roleSelect = modal.querySelector('#role_update');

                const halaqahSelect = modal.querySelector('#halaqah_id');
                const form = modal.querySelector('form');



                document.querySelectorAll('[data-modal-target="default-modal-update"]').forEach(button => {
                    button.addEventListener('click', () => {

                        const id = button.getAttribute('data-id');
                        const nama = button.getAttribute('data-nama');
                        const nim = button.getAttribute('data-nim');
                        const gender = button.getAttribute('data-gender');
                        const role = button.getAttribute('data-role');
                        const halaqah = button.getAttribute('data-halaqah');

                        namaInput.value = nama;
                        nimInput.value = nim;
                        genderSelect.value = gender;
                        roleSelect.value = role;
                        halaqahSelect.value = halaqah;

                        setTimeout(() => {
                            if (window.toggleHalaqahUpdate) {
                                window.toggleHalaqahUpdate();
                            }
                        }, 10);

                        form.action = `/daftar-pengguna/${id}`;
                    });
                });

            });
        </script>


    </section>

    <section>
        <style>
            body>div.bg-gray-900\/50,
            body>div.dark\:bg-gray-900\/80,
            body>div[data-modal-backdrop] {
                background-color: rgba(12, 11, 11, 0.2) !important;
                backdrop-filter: blur(6px) !important;
            }

            #upload-progress {
                width: 100%;
                height: 12px;
                border-radius: 9999px;
                overflow: hidden;
                background-color: rgba(255, 255, 255, 0.2);
            }

            #upload-progress-bar {
                height: 100%;
                width: 0%;
                background-color: #16a34a;
                transition: width 0.3s ease;
            }
        </style>

        <div id="default-modal-excel" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full max-h-full backdrop-blur-sm">

            <div class="relative p-4 w-full max-w-2xl max-h-full mt-36 md:mt-0">
                <div class="relative bg-primary rounded-lg shadow-sm px-4">
                    <form id="excel-upload-form" action="{{ route('daftar-pengguna.importExcel') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                            <h3 class="text-xl font-semibold text-white">Impor Excel</h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                                data-modal-hide="default-modal-excel">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <div class="p-4 md:p-5 space-y-4">
                            <div class="flex flex-col items-center justify-center w-full">
                                <label for="file-upload"
                                    class="flex flex-col items-center justify-center w-full max-w-md p-6 bg-green-600 text-white rounded-2xl shadow-md cursor-pointer hover:bg-green-700 transition-all duration-200">

                                    <svg class="w-12 h-12 mb-3 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2 2 2 0 0 0 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Zm1.018 8.828a2.34 2.34 0 0 0-2.373 2.13v.008a2.32 2.32 0 0 0 2.06 2.497l.535.059a.993.993 0 0 0 .136.006.272.272 0 0 1 .263.367l-.008.02a.377.377 0 0 1-.018.044.49.49 0 0 1-.078.02 1.689 1.689 0 0 1-.297.021h-1.13a1 1 0 1 0 0 2h1.13c.417 0 .892-.05 1.324-.279.47-.248.78-.648.953-1.134a2.272 2.272 0 0 0-2.115-3.06l-.478-.052a.32.32 0 0 1-.285-.341.34.34 0 0 1 .344-.306l.94.02a1 1 0 1 0 .043-2l-.943-.02h-.003Zm7.933 1.482a1 1 0 1 0-1.902-.62l-.57 1.747-.522-1.726a1 1 0 0 0-1.914.578l1.443 4.773a1 1 0 0 0 1.908.021l1.557-4.773Zm-13.762.88a.647.647 0 0 1 .458-.19h1.018a1 1 0 1 0 0-2H6.647A2.647 2.647 0 0 0 4 13.647v1.706A2.647 2.647 0 0 0 6.647 18h1.018a1 1 0 1 0 0-2H6.647A.647.647 0 0 1 6 15.353v-1.706c0-.172.068-.336.19-.457Z"
                                            clip-rule="evenodd" />
                                    </svg>

                                    <p class="mb-1 text-lg font-semibold">Pilih File</p>
                                    <p class="text-sm text-green-100">.XLSX, .CSV</p>

                                    <input id="file-upload" type="file" name="file" accept=".xlsx, .csv"
                                        class="hidden" />
                                </label>

                                <div id="file-preview" class="mt-4 hidden text-center">
                                    <p class="text-gray-300 font-medium mb-2">File terpilih:</p>
                                    <p id="file-name" class="text-secondary font-semibold"></p>
                                </div>

                                <div id="progress-container" class="w-full max-w-md mt-4 hidden">
                                    <div id="upload-progress">
                                        <div id="upload-progress-bar"></div>
                                    </div>
                                    <p id="progress-text" class="text-center text-white mt-2 text-sm"></p>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-center gap-5 p-4 md:p-5 border-t border-gray-200 rounded-b">
                            <x-delete-button class="text-center" data-modal-hide="default-modal-excel">
                                {{ __('Batal') }}
                            </x-delete-button>
                            <x-secondary-button id="submit-btn" class="text-center opacity-50 cursor-not-allowed"
                                disabled>
                                {{ __('Simpan') }}
                            </x-secondary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const fileInput = document.getElementById('file-upload');
                const filePreview = document.getElementById('file-preview');
                const fileName = document.getElementById('file-name');
                const submitBtn = document.getElementById('submit-btn');
                const form = document.getElementById('excel-upload-form');
                const progressContainer = document.getElementById('progress-container');
                const progressBar = document.getElementById('upload-progress-bar');
                const progressText = document.getElementById('progress-text');

                let isUploading = false;

                fileInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        fileName.textContent = file.name;
                        filePreview.classList.remove('hidden');
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    } else {
                        filePreview.classList.add('hidden');
                        submitBtn.disabled = true;
                        submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                    }
                });

                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    if (isUploading) return;

                    const file = fileInput.files[0];
                    if (!file) return;

                    isUploading = true;
                    progressBar.style.width = '0%';
                    progressBar.style.backgroundColor = '#16a34a';
                    progressText.textContent = '';
                    progressContainer.classList.remove('hidden');
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-50', 'cursor-not-allowed');

                    const xhr = new XMLHttpRequest();
                    const formData = new FormData(form);

                    xhr.open('POST', form.action);
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    xhr.setRequestHeader('Accept', 'application/json');

                    xhr.upload.addEventListener('progress', (e) => {
                        if (e.lengthComputable) {
                            const percent = Math.round((e.loaded / e.total) * 100);
                            progressBar.style.width = percent + '%';
                            progressText.textContent = `Mengunggah ${percent}%`;
                        }
                    });

                    xhr.addEventListener('load', () => {
                        let response = {};
                        try {
                            response = JSON.parse(xhr.responseText);
                        } catch (err) {
                            response = {
                                message: 'Terjadi kesalahan tak terduga.'
                            };
                        }

                        if (xhr.status >= 200 && xhr.status < 300 && response.success) {
                            progressBar.style.width = '100%';
                            progressText.textContent = response.message ||
                                'Upload dan import berhasil! Memuat ulang...';
                            setTimeout(() => window.location.reload(), 2000);
                        } else {
                            progressText.textContent = response.message || 'Upload gagal. Coba lagi.';
                            progressBar.style.backgroundColor = '#dc2626';
                            isUploading = false;
                            submitBtn.disabled = false;
                            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                        }
                    });


                    xhr.addEventListener('error', () => {
                        progressText.textContent = 'Upload gagal. Periksa koneksi Anda.';
                        progressBar.style.backgroundColor = '#dc2626';
                        isUploading = false;
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    });

                    xhr.send(formData);
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
                            <p class="text-secondary text-center mt-5">Apakah anda yakin untuk menghapus akun "<span
                                    id="nama"></span>"?</p>
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
                const namaInput = modal.querySelector('#nama');
                const form = document.getElementById('deleteForm');
                const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
                const bulkForm = document.getElementById('bulkDeleteForm');


                document.querySelectorAll('[data-modal-target="default-modal-delete"]').forEach(button => {
                    if (button !== bulkDeleteBtn) {
                        button.addEventListener('click', () => {
                            const id = button.getAttribute('data-id');
                            const nama = button.getAttribute('data-nama');

                            namaInput.textContent = nama;
                            form.action = `/daftar-pengguna/${id}`;
                            form.dataset.type = 'single';
                        });
                    }
                });


                bulkDeleteBtn.addEventListener('click', () => {
                    const selectedIds = JSON.parse(localStorage.getItem('selectedIds') || '[]');
                    if (selectedIds.length === 0) return;

                    namaInput.textContent = `${selectedIds.length} akun yang dipilih`;
                    form.action = "{{ route('daftar-pengguna.destroy-multiple') }}";
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
            class="fixed top-4 right-4 z-50 flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 rounded-lg shadow-lg 
              opacity-0 translate-x-10 transition-all duration-500 ease-out"
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
