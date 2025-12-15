@extends('dashboard.admin.admin-base')

@section('page-title', 'Upload Template Sertifikat')

@section('content')

    @php
        $isTerbaik = str_contains($type, 'terbaik');

        $themeColor = $isTerbaik ? 'yellow' : 'indigo';
        $hoverColor = $isTerbaik ? 'hover:bg-yellow-50' : 'hover:bg-indigo-50';
        $btnColor = $isTerbaik ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-indigo-600 hover:bg-indigo-700';
        $ringColor = $isTerbaik ? 'focus:ring-yellow-500' : 'focus:ring-indigo-500';

        $judulSertifikat = ucwords(str_replace('-', ' ', $type));
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-14 md:mt-0">
        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <a href="{{ route('sertifikat.index') }}" class="text-gray-400 hover:text-gray-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-800">Upload Template</h1>
                </div>
                <p class="text-sm text-gray-500 ml-7">
                    Kelola file untuk <span class="font-semibold text-{{ $themeColor }}-600">{{ $judulSertifikat }}</span>
                </p>
            </div>

            <div>
                @if ($certificate)
                    <span
                        class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium bg-green-50 text-green-700 border border-green-200 shadow-sm">
                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Template Terpasang
                    </span>
                @else
                    <span
                        class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium bg-gray-50 text-gray-600 border border-gray-200 shadow-sm">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                        Belum Ada File
                    </span>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-{{ $themeColor }}-100 rounded-full opacity-50 blur-xl">
                    </div>

                    <h3 class="font-bold text-gray-900 mb-4 relative z-10">Formulir Upload</h3>

                    <form action="{{ route('sertifikat.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" value="{{ $type }}" accept=".jpg,.jpeg,.png">

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">File Template</label>

                            <div class="flex items-center justify-center w-full group">
                                <label for="dropzone-file"
                                    class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 {{ $hoverColor }} transition-all duration-300">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <div
                                            class="p-3 bg-white rounded-full shadow-sm mb-3 group-hover:scale-110 transition-transform">
                                            <svg class="w-6 h-6 text-{{ $themeColor }}-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                </path>
                                            </svg>
                                        </div>
                                        <p class="text-sm text-gray-500 mb-1"><span class="font-semibold text-gray-700">Klik
                                                untuk upload</span></p>
                                        <p class="text-xs text-gray-400">JPG, JPEG, PNG (Max 2MB)</p>
                                    </div>
                                    <input id="dropzone-file" type="file" name="file_location" class="hidden"
                                        onchange="previewFilename(this)" />
                                </label>
                            </div>

                            <div id="filename-display"
                                class="hidden mt-2 text-sm text-gray-600 bg-gray-50 px-3 py-1 rounded border border-gray-200 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <span class="truncate" id="filename-text"></span>
                            </div>

                            @error('file_location')
                                <p class="text-red-500 text-xs mt-2 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <x-primary-button-full type="submit" class="">
                            {{ $certificate ? 'Perbarui Template' : 'Simpan Template' }}
                        </x-primary-button-full>

                    </form>

                    @if ($certificate)
                        <div class="mt-3 text-center">
                            <button type="button" data-modal-target="default-modal-delete"
                                data-modal-toggle="default-modal-delete" data-id="{{ $certificate->id }}"
                                class="w-full py-2.5 px-4 border border-red-300 rounded-lg text-sm font-medium text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                Hapus Template
                            </button>
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
                            <div id="default-modal-delete" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full] max-h-full backdrop-blur-sm
                             ">

                                <div class="relative p-4 w-full max-w-2xl max-h-full mt-36 md:mt-0">
                                    <div class="relative bg-primary rounded-lg shadow-sm px-4">
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                                            <h3 class="text-xl font-semibold text-white">
                                                Konfirmasi
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                                                data-modal-hide="default-modal-delete">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>

                                        <div class="p-4 md:p-5 space-y-4">
                                            <div class="flex flex-col items-center justify-center w-full">
                                                <svg class="w-10 h-10 md:w-20 md:h-20 text-secondary" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <p class="text-secondary text-center mt-5">Apakah anda yakin menghapus
                                                    template sertifikat ini?</p>
                                            </div>
                                        </div>

                                        <div
                                            class="flex justify-center gap-5 p-4 md:p-5 border-t border-gray-200 rounded-b">
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

                                            deleteForm.action = `/sertifikat/${id}`;
                                        });
                                    });
                                });
                            </script>


                        </section>
                    @endif
                </div>

                <div class="mt-6 bg-blue-50 rounded-xl p-4 border border-blue-100">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-800">Catatan</h3>
                            <div class="mt-2 text-sm text-blue-700">
                                <p>Pastikan template sertifikat memiliki area kosong yang cukup untuk nama dan keterangan.
                                    Format PNG lebih disarankan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm h-full flex flex-col">
                    <div class="p-4 border-b border-gray-100 flex justify-between items-center bg-gray-50 rounded-t-xl">
                        <h3 class="font-bold text-gray-700">Preview Template</h3>
                        @if ($certificate)
                            <a href="{{ asset('storage/' . $certificate->file_location) }}" target="_blank"
                                class="text-xs text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
                                Buka Tab Baru
                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                    </path>
                                </svg>
                            </a>
                        @endif
                    </div>

                    <div class="flex-grow p-4 bg-gray-100 rounded-b-xl flex items-center justify-center min-h-[500px]">
                        @if ($certificate)
                            <iframe src="{{ asset('storage/' . $certificate->file_location) }}"
                                class="w-full h-full min-h-[600px] rounded border border-gray-300 shadow-sm bg-white"
                                frameborder="0">
                            </iframe>
                        @else
                            <div class="text-center p-8">
                                <div
                                    class="mx-auto w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada preview</h3>
                                <p class="mt-1 text-sm text-gray-500">Silakan unggah file template terlebih dahulu.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>


        @if ($certificate)
            <div class="mt-8 bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-bold text-gray-800">Distribusi Sertifikat</h3>
                    <p class="text-sm text-gray-500">
                        Atur penerima untuk sertifikat jenis: <span class="font-semibold">{{ $candidateLabel }}</span>
                    </p>
                </div>

                <div class="p-6">

                    @if ($type == 'sertifikat-asisten-umum')
                        <div
                            class="flex flex-col md:flex-row items-center justify-between {{ $isDistributed ? 'bg-green-50 border-green-100' : 'bg-blue-50 border-blue-100' }} p-4 rounded-lg border">

                            <div class="mb-4 md:mb-0">
                                @if ($isDistributed)
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="flex h-6 w-6 items-center justify-center rounded-full bg-green-200">
                                            <svg class="h-4 w-4 text-green-700" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </span>
                                        <h4 class="font-bold text-green-800">Sudah Disahkan</h4>
                                    </div>
                                    <p class="text-sm text-green-700">
                                        Sertifikat ini telah aktif untuk seluruh <b>{{ $candidates['count'] ?? 0 }}
                                            Asisten</b>.
                                    </p>
                                @else
                                    <h4 class="font-bold text-blue-800">Pengesahan Massal</h4>
                                    <p class="text-sm text-blue-600 mt-1">
                                        Tindakan ini akan memberikan sertifikat ini kepada
                                        <span class="font-bold text-lg">{{ $candidates['count'] ?? 0 }}</span>
                                        User dengan role <b>Asisten</b>.
                                    </p>
                                @endif
                            </div>

                            <form action="{{ route('sertifikat.assign') }}" method="POST"
                                onsubmit="return confirm('{{ $isDistributed ? 'Yakin ingin MEMBATALKAN sertifikat untuk SEMUA asisten? Para asisten tidak akan bisa melihat sertifikat ini lagi.' : 'Apakah Anda yakin ingin membagikan sertifikat ke SEMUA asisten?' }}');">
                                @csrf
                                <input type="hidden" name="certificate_id" value="{{ $certificate->id }}">
                                <input type="hidden" name="type" value="{{ $type }}">

                                @if ($isDistributed)
                                    <input type="hidden" name="action" value="revoke">
                                    <button type="submit"
                                        class="whitespace-nowrap px-4 py-2 bg-white border border-red-200 text-red-600 rounded-lg hover:bg-red-50 hover:border-red-300 shadow-sm transition font-medium flex items-center gap-2 group">
                                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                        Batalkan Pengesahan
                                    </button>
                                @else
                                    <input type="hidden" name="action" value="assign">
                                    <button type="submit"
                                        class="whitespace-nowrap px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow transition font-medium flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                        Sah-kan ke Semua
                                    </button>
                                @endif
                            </form>
                        </div>
                    @else
                        <div class="max-w-xl">
                            <form action="{{ route('sertifikat.assign') }}" method="POST">
                                @csrf
                                <input type="hidden" name="certificate_id" value="{{ $certificate->id }}">
                                <input type="hidden" name="type" value="{{ $type }}">

                                <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Penerima
                                    ({{ $candidateLabel }})</label>

                                <div class="flex gap-3">
                                    <div class="relative flex-grow">
                                        <select name="user_id" required
                                            class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md border">
                                            <option value="" disabled selected>-- Pilih User --</option>
                                            @forelse($candidates as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->nama }} ({{ $user->nim ?? $user->email }})
                                                </option>
                                            @empty
                                                <option disabled>Tidak ada user yang memenuhi kriteria
                                                    ({{ $candidateLabel }})
                                                </option>
                                            @endforelse
                                        </select>
                                    </div>

                                    <x-primary-button type="submit">
                                        Pilih
                                    </x-primary-button>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">*Hanya user dengan role dan gender yang sesuai yang
                                    muncul di daftar ini.</p>
                            </form>
                        </div>

                        <div class="mt-8">
                            <h4 class="text-sm font-bold text-gray-700 mb-3 uppercase tracking-wider">Penerima Terpilih
                            </h4>
                            <div class="bg-white border rounded-lg overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Nama</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Tanggal Diberikan</th>
                                            <th
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($certificate->users as $recipient)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $recipient->nama }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $recipient->pivot->created_at->format('d M Y') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <form
                                                        action="{{ route('sertifikat.revoke', ['certId' => $certificate->id, 'userId' => $recipient->id]) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900"
                                                            onclick="return confirm('Batalkan sertifikat untuk user ini?')">Batalkan</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3"
                                                    class="px-6 py-4 text-center text-sm text-gray-500 italic">Belum ada
                                                    penerima yang dipilih.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <script>
        function previewFilename(input) {
            const file = input.files[0];
            if (file) {
                document.getElementById('filename-display').classList.remove('hidden');
                document.getElementById('filename-text').textContent = file.name;
            }
        }
    </script>

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
