@extends('dashboard.asisten.asisten-base')

@section('page-title', 'SAINS | Pengumuman')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:mt-24">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Papan Pengumuman Asisten</h1>
            <p class="text-sm text-gray-500 mt-1">Bagikan informasi terbaru kepada rekan asisten lainnya.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <section class="lg:col-span-4 lg:sticky lg:top-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                            </path>
                        </svg>
                        Buat Pengumuman Baru
                    </h2>

                    <form action="{{ route('pengumuman-asisten.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-700">Isi Pesan</label>
                            <textarea name="content" id="message" rows="5"
                                class="block w-full p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 resize-none transition"
                                placeholder="Tuliskan pengumuman disini..." required></textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-1" />
                        </div>

                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-700" for="file_input">Lampiran
                                (Opsional)</label>
                            <input
                                class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-l-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                                id="file_input" type="file" name="file_location"
                                accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.mp3,.wav,.m4a,.jpg,.jpeg,.png">
                            <p class="mt-1 text-[10px] text-gray-500">PDF, Office, Gambar, Audio (Max 10MB)</p>
                            <x-input-error :messages="$errors->get('file_location')" class="mt-1" />
                        </div>

                        <div class="flex justify-end">
                            <x-primary-button class="w-full justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                {{ __('Kirim') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </section>

            <section class="lg:col-span-8 space-y-6">
                @forelse ($announcements as $index => $announcement)
                    <div class="flex gap-4 group">
                        <div class="flex-shrink-0">
                            <div
                                class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-sm border-2 border-white shadow-sm">
                                {{ substr($announcement->user->nama, 0, 1) }}
                            </div>
                        </div>

                        <div class="flex-1 max-w-2xl">
                            <div class="flex items-baseline justify-between mb-1">
                                <span class="text-sm font-bold text-gray-900">{{ $announcement->user->nama }}</span>
                                <span
                                    class="text-xs text-gray-500">{{ $announcement->created_at->timezone('Asia/Makassar')->format('d M Y, H:i') }}
                                    WITA</span>
                            </div>

                            <div class="bg-white p-4 rounded-2xl rounded-tl-none shadow-sm border border-gray-200 relative">
                                <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line mb-3">
                                    {{ $announcement->content }}
                                </p>

                                @if ($announcement->file_location)
                                    @php
                                        $extension = pathinfo($announcement->file_location, PATHINFO_EXTENSION);
                                        $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                                    @endphp

                                    <div class="mt-2">
                                        <a href="{{ asset('storage/' . $announcement->file_location) }}" target="_blank"
                                            class="inline-flex items-center gap-3 p-2 pr-4 bg-gray-50 border border-gray-200 rounded-lg hover:bg-indigo-50 hover:border-indigo-200 transition group/file w-full sm:w-auto">

                                            <div
                                                class="p-2 bg-white rounded-md border border-gray-200 group-hover/file:border-indigo-200">
                                                @if ($isImage)
                                                    <svg class="w-5 h-5 text-purple-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                @else
                                                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                @endif
                                            </div>

                                            <div class="flex flex-col text-left">
                                                <span
                                                    class="text-xs font-semibold text-gray-700 group-hover/file:text-indigo-700">Lampiran
                                                    File</span>
                                                <span class="text-[10px] text-gray-500 uppercase">{{ $extension }}</span>
                                            </div>
                                        </a>
                                    </div>
                                @endif

                                @if ($announcement->user_id == auth()->id() && auth()->user()->role == 'asisten')
                                    <div
                                        class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button type="button" data-modal-target="default-modal-update"
                                            data-modal-toggle="default-modal-update" data-id="{{ $announcement->id }}"
                                            data-content="{{ $announcement->content }}"
                                            data-file-location="{{ $announcement->file_location }}"
                                            class="p-1 text-gray-400 hover:text-yellow-600 rounded hover:bg-gray-100 transition"
                                            title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                </path>
                                            </svg>
                                        </button>
                                        <button type="button" data-modal-target="default-modal-delete"
                                            data-modal-toggle="default-modal-delete" data-id="{{ $announcement->id }}"
                                            class="p-1 text-gray-400 hover:text-red-600 rounded hover:bg-gray-100 transition"
                                            title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="flex flex-col items-center justify-center py-16 bg-white rounded-xl border-2 border-dashed border-gray-300">
                        <div class="p-4 bg-gray-50 rounded-full mb-3">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium">Belum ada pengumuman</p>
                        <p class="text-gray-400 text-sm">Mulai diskusi dengan membuat pengumuman baru.</p>
                    </div>
                @endforelse
            </section>
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
