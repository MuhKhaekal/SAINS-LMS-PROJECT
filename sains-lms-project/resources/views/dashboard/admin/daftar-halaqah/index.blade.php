@extends('dashboard.admin.admin-base')

@section('page-title', 'SAINS - Daftar Halaqah')

@section('content')
<h1 class="text-primary font-extrabold text-2xl mt-20 md:mt-6 md:mx-12">Daftar Halaqah</h1>

<section class="md:mx-12">
    <form method="GET" action="{{ route('daftar-halaqah.index') }}" 
      class="flex flex-wrap md:flex-nowrap gap-2 items-center mt-6 w-full border border-dashed rounded-md p-4">

    <input 
        type="text" 
        name="search" 
        placeholder="Cari ..."
        value="{{ request('search') }}"
        class="border border-gray-300 focus:border-gray-500 text-sm focus:ring-blue-500 rounded-md px-3 py-2 flex-grow md:basis-5/12 focus:outline-none"
    >

    
    <select 
        name="halaqah_type" 
        class="border text-sm border-gray-300 rounded-md px-3 py-2 md:basis-1/6 w-full">
        <option value="">Semua Jenis Halaqah</option>
        <option value="Halaqah Akhwat" {{ request('halaqah_type') == 'Halaqah Akhwat' ? 'selected' : '' }}>Halaqah Akhwat</option>
        <option value="Halaqah Ikhwan" {{ request('halaqah_type') == 'Halaqah Ikhwan' ? 'selected' : '' }}>Halaqah Ikhwan</option>
    </select>

    <select 
        name="prodi" 
        class="border text-sm border-gray-300 rounded-md px-3 py-2 md:basis-1/6 w-full">
        <option value="">Semua Program Studi</option>
        @foreach ($prodis as $prodi)
            <option 
                value="{{ $prodi->id }}" 
                {{ request('prodi') == $prodi->id ? 'selected' : '' }}>
                {{ $prodi->prodi_name }}
            </option>   
        @endforeach

    </select>

    <button type="submit" 
        class="bg-primary text-white px-4 py-2 rounded-md hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-1500 md:basis-2/12 w-full flex items-center justify-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35m2.1-5.4A7.75 7.75 0 1 1 4 8.75a7.75 7.75 0 0 1 14.75 2.5Z" />
        </svg>
        Cari
    </button>

    <a href="{{ route('daftar-halaqah.index') }}" 
       class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md  hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 md:basis-2/12 w-full text-center flex items-center justify-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        Hapus Filter
    </a>
</form>
</section>

<section class="md:mx-12">
    <form id="bulkDeleteForm" action="{{ route('daftar-halaqah.destroy-multiple') }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
            <div class="flex justify-between m-4">
                <button type="button" id="bulkDeleteBtn" class="px-4 py-2 bg-red-500 border border-transparent rounded-md font-normal text-xs text-white  tracking-widest hover:bg-red-600 focus:bg-red-600 active:bg-red-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"    data-modal-target="default-modal-delete" 
                data-modal-toggle="default-modal-delete">
                    Hapus yang Dipilih
                </button>
            </div>

            <table class="w-full text-sm text-left rtl:text-right text-gray-400">
                <thead class="text-xs uppercase bg-primary text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 w-1/12">
                            <input type="checkbox" id="checkAll">
                        </th>
                        <th scope="col" class="px-6 py-3 w-1/12">
                            Kode Halaqah
                        </th>
                        <th scope="col" class="px-6 py-3 w-3/12">
                            Nama Halaqah
                        </th>
                        <th scope="col" class="px-6 py-3 w-2/12">
                            Jenis Halaqah
                        </th>
                        <th scope="col" class="px-6 py-3 w-2/12">
                            Program Studi 
                        </th>
                        <th scope="col" class="px-6 py-3 w-2/12">
                            Nama Asisten
                        </th>
                        <th scope="col" class="px-6 py-3 w-1/12">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($halaqahs as $halaqah)
                    <tr class="bg-white hover:bg-gray-100 text-primary border-b">
                        <td class="px-6 py-4">
                            <input type="checkbox" name="ids[]" value="{{ $halaqah->id }}" class="checkItem" data-id="{{ $halaqah->id }}">
                        </td>
            
                        <td class="px-6 py-4 font-medium whitespace-nowrap">
                            {{ $halaqah->halaqah_code }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $halaqah->halaqah_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $halaqah->halaqah_type }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $halaqah->prodi->prodi_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $halaqah->users->first()->nama ?? '-' }}
                        </td>
                        <td class="px-6 py-4 flex gap-2">
                            <button type="button" class="font-medium hover:underline">
                            <svg class="w-7 h-7 text-secondary bg-green-500 p-1 rounded-md" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-6 8a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1Zm1 3a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z" clip-rule="evenodd"/>
                              </svg>
                              
                            </button>
                            <button type="button" class="font-medium hover:underline">
                            <svg class="w-7 h-7 text-secondary bg-green-500 p-1 rounded-md" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 0 0-1 1H6a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-2a1 1 0 0 0-1-1H9Zm1 2h4v2h1a1 1 0 1 1 0 2H9a1 1 0 0 1 0-2h1V4Zm5.707 8.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd"/>
                              </svg>
                            </button>

                            <button type="button" 
                                data-modal-target="default-modal-update" 
                                data-modal-toggle="default-modal-update" 
                                data-id="{{ $halaqah->id }}"
                                data-halaqah-code="{{ $halaqah->halaqah_code }}"
                                data-halaqah-name="{{ $halaqah->halaqah_name }}"
                                data-halaqah-type="{{ $halaqah->halaqah_type }}"
                                data-prodi="{{ $halaqah->prodi_id }}"
                                data-user="{{ $halaqah->users->first()->id ?? '-' }}"
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
                                data-modal-target="default-modal-delete"
                                data-modal-toggle="default-modal-delete"
                                data-id="{{ $halaqah->id }}" data-halaqah-name="{{ $halaqah->halaqah_name }}">
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
        {{ $halaqahs->appends(request()->query())->links() }}
    </div>
    
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkAll = document.getElementById('checkAll');
            const checkItems = document.querySelectorAll('.checkItem');
            const deleteBtn = document.getElementById('bulkDeleteBtn');
        
            let selectedIds = JSON.parse(localStorage.getItem('selectedIds') || '[]');
        
            checkItems.forEach(item => {
                if (selectedIds.includes(item.value)) {
                    item.checked = true;
                }
            });
        
            function toggleDeleteButton() {
                const anyChecked = selectedIds.length > 0;
                deleteBtn.classList.toggle('hidden', !anyChecked);
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
        
            checkAll.addEventListener('change', function () {
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
            bulkForm.addEventListener('submit', function (e) {
                selectedIds.forEach(id => {
                    const hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = 'ids[]';
                    hidden.value = id;
                    bulkForm.appendChild(hidden);
                });
                localStorage.removeItem('selectedIds');
            });
        });
    </script>
        

</section>

<section class="md:mx-12 mt-10 flex justify-center md:justify-start md:mt-5 gap-4">
    <x-primary-button class="text-center" data-modal-target="default-modal-add" data-modal-toggle="default-modal-add">
        {{ __('+ Tambah Data Halaqah') }}
    </x-primary-button>
</section>


<section>
    <style>
        body > div.bg-gray-900\/50,
        body > div.dark\:bg-gray-900\/80,
        body > div[data-modal-backdrop] {
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
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>

              <form action="{{ route('daftar-halaqah.store') }}" method="POST">
                @csrf
              <div class="p-4 md:p-5 space-y-4 mb-4">
                <div class="">
                    <p class="text-secondary">Kode Halaqah</p>
                    <x-text-input-secondary id="halaqah_code" class="block w-full mt-1" type="text" name="halaqah_code" :value="old('halaqah_code')" required autofocus autocomplete="username" placeholder="Kode Halaqah" />
                    <x-input-error :messages="$errors->get('halaqah_code')" />
                </div>
                <div class="">
                    <p class="text-secondary">Nama Halaqah</p>
                    <x-text-input-secondary id="halaqah_name" class="block w-full mt-1" type="text" name="halaqah_name" :value="old('halaqah_name')" required autofocus autocomplete="username" placeholder="Nama Halaqah" />
                    <x-input-error :messages="$errors->get('halaqah_name')" />
                </div>
                <div class="">  
                    <p class="text-secondary">Jenis Halaqah</p>
                    <select id="halaqah_type" name="halaqah_type" class="bg-secondary border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">   
                        <option value="" disabled selected>Pilih Jenis Halaqah</option>                 
                        <option value="Halaqah Akhwat">Halaqah Akhwat</option>
                        <option value="Halaqah Ikhwan">Halaqah Ikhwan</option>
                    </select>
                    <x-input-error :messages="$errors->get('halaqah_type')" />
                </div>
                <div class="">  
                    <p class="text-secondary">Program Studi</p>
                    <select id="prodi_id" name="prodi_id" class="bg-secondary border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">    
                            <option value="" disabled selected>Pilih Program Studi</option>
                        @foreach ($prodis as $prodi)
                            <option value="{{ $prodi->id }}">{{ $prodi->prodi_name }}</option>
                        @endforeach                
                      </select>
                      <x-input-error :messages="$errors->get('prodi_id')" />
                </div>
                <div class="">  
                    <p class="text-secondary">Nama Asisten</p>
                    <select id="user_id" name="user_id" class="bg-secondary border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">                 
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
        body > div.bg-gray-900\/50,
    body > div.dark\:bg-gray-900\/80,
    body > div[data-modal-backdrop] {
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
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
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
                        <x-text-input-secondary id="halaqah_code" class="block w-full mt-1" type="text" name="halaqah_code" :value="old('halaqah_code')" required autofocus autocomplete="username" placeholder="Kode Halaqah" />
                        <x-input-error :messages="$errors->get('halaqah_code')" />
                    </div>
                    <div class="">
                        <p class="text-secondary">Nama Halaqah</p>
                        <x-text-input-secondary id="halaqah_name" class="block w-full mt-1" type="text" name="halaqah_name" :value="old('halaqah_name')" required autofocus autocomplete="username" placeholder="Nama Halaqah" />
                        <x-input-error :messages="$errors->get('halaqah_name')" />
                    </div>
                    <div class="">  
                        <p class="text-secondary">Jenis Halaqah</p>
                        <select id="halaqah_type" name="halaqah_type" class="bg-secondary border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">   
                            <option value="" disabled selected>Pilih Jenis Halaqah</option>                 
                            <option value="Halaqah Akhwat">Halaqah Akhwat</option>
                            <option value="Halaqah Ikhwan">Halaqah Ikhwan</option>
                        </select>
                        <x-input-error :messages="$errors->get('halaqah_type')" />
                    </div>
                    <div class="">  
                        <p class="text-secondary">Program Studi</p>
                        <select id="prodi_id" name="prodi_id" class="bg-secondary border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">    
                                <option value="" disabled selected>Pilih Program Studi</option>
                            @foreach ($prodis as $prodi)
                                <option value="{{ $prodi->id }}">{{ $prodi->prodi_name }}</option>
                            @endforeach                
                          </select>
                          <x-input-error :messages="$errors->get('prodi_id')" />
                    </div>
                    <div class="">  
                        <p class="text-secondary">Nama Asisten</p>
                        <select id="user_id" name="user_id" class="bg-secondary border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">                 
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
        document.addEventListener('DOMContentLoaded', function () {
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
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
    
              <div class="p-4 md:p-5 space-y-4">
                <div class="flex flex-col items-center justify-center w-full">
                    <svg class="w-10 h-10 md:w-20 md:h-20 text-secondary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                      </svg>
                    <p class="text-secondary text-center mt-5">Apakah anda yakin untuk menghapus data halaqah "<span id="halaqah-name"></span>"?</p>
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
        document.addEventListener('DOMContentLoaded', function () {
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
            form.addEventListener('submit', function (e) {
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
    <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
         fill="currentColor" viewBox="0 0 20 20">
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
    <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
         fill="currentColor" viewBox="0 0 20 20">
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