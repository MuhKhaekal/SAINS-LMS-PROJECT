@extends('dashboard.admin.admin-base')

@section('page-title', 'SAINS - Daftar Pengguna')

@section('content')
    <h1 class="text-primary font-extrabold text-2xl mt-20 md:mt-6 md:mx-12">Daftar Pengguna</h1>

    <section class="md:mx-12">
        <form method="GET" action="{{ route('daftar-pengguna.index') }}"
            class="flex flex-wrap md:flex-nowrap gap-2 items-center mt-6 w-full bg-white shadow-sm border-2 rounded-md p-4">

            <input type="text" name="search" placeholder="Cari ..." value="{{ request('search') }}"
                class="border border-gray-300 focus:border-gray-500 text-sm focus:ring-blue-500 rounded-md px-3 py-2 flex-grow md:basis-5/12 focus:outline-none">


            <select name="role" class="border text-sm border-gray-300 rounded-md px-3 py-2 md:basis-1/6 w-full">
                <option value="">Semua Role</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="asisten" {{ request('role') == 'asisten' ? 'selected' : '' }}>Asisten</option>
                <option value="praktikan" {{ request('role') == 'praktikan' ? 'selected' : '' }}>Praktikan</option>
            </select>

            <select name="gender" class="border text-sm border-gray-300 rounded-md px-3 py-2 md:basis-1/6 w-full">
                <option value="">Semua Gender</option>
                <option value="L" {{ request('gender') == 'L' ? 'selected' : '' }}>Ikhwan</option>
                <option value="P" {{ request('gender') == 'P' ? 'selected' : '' }}>Akhwat</option>
            </select>

            <button type="submit"
                class="bg-primary text-white px-4 py-2 rounded-md hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-1500 md:basis-2/12 w-full flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m21 21-4.35-4.35m2.1-5.4A7.75 7.75 0 1 1 4 8.75a7.75 7.75 0 0 1 14.75 2.5Z" />
                </svg>
                Cari
            </button>

            <a href="{{ route('daftar-pengguna.index') }}"
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
        <form id="bulkDeleteForm" action="{{ route('daftar-pengguna.destroy-multiple') }}" method="POST">
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
                            <th scope="col" class="px-6 py-3 w-4/12">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3 w-2/12">
                                NIM
                            </th>
                            <th scope="col" class="px-6 py-3 w-2/12">
                                Role
                            </th>
                            <th scope="col" class="px-6 py-3 w-2/12">
                                Jenis Kelamin
                            </th>
                            <th scope="col" class="px-6 py-3 w-1/12">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr class="bg-white hover:bg-gray-100 text-primary border-b">
                                <td class="px-6 py-4">
                                    @if ($user->role !== 'admin')
                                        <input type="checkbox" name="ids[]" value="{{ $user->id }}" class="checkItem"
                                            data-id="{{ $user->id }}">
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{ $user->nama }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $user->nim }}
                                </td>
                                <td class="px-6 py-4 capitalize">
                                    {{ $user->role }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $user->gender }}
                                </td>
                                <td class="px-6 py-4 flex gap-2">
                                    <button type="button" data-tooltip-target="tooltip-edit-{{ $index }}"
                                        data-modal-target="default-modal-update" data-modal-toggle="default-modal-update"
                                        data-id="{{ $user->id }}" data-nama="{{ $user->nama }}"
                                        data-nim="{{ $user->nim }}" data-gender="{{ $user->gender }}"
                                        data-role="{{ $user->role }}"
                                        data-halaqah="{{ optional($user->halaqahs->first())->id }}"
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
                                        data-id="{{ $user->id }}" data-nama="{{ $user->nama }}">
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
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </form>


        <div class="mt-4">
            {{ $users->appends(request()->query())->links() }}
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
            {{ __('+ Tambah Akun') }}
        </x-primary-button>

        <x-primary-button class="text-center" data-modal-target="default-modal-excel"
            data-modal-toggle="default-modal-excel">
            {{ __('+ Impor Excel') }}
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

                // 🔥 FIX: gunakan #role_update (bukan #role)
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

                        // Isi input field
                        namaInput.value = nama;
                        nimInput.value = nim;
                        genderSelect.value = gender;
                        roleSelect.value = role;
                        halaqahSelect.value = halaqah;

                        // 🔥 WAJIB — jalankan toggle setelah value ter-set & modal render
                        setTimeout(() => {
                            if (window.toggleHalaqahUpdate) {
                                window.toggleHalaqahUpdate();
                            }
                        }, 10);

                        // Set form action
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
