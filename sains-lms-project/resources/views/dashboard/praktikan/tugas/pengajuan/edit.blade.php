@extends('dashboard.praktikan.praktikan-base')

@section('page-title', 'SAINS | Edit Pengajuan Tugas')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:mt-24">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Edit Jawaban</h1>
                <p class="text-sm text-gray-500 mt-1">Perbarui file atau catatan tugas Anda.</p>
            </div>
            <a href="{{ url()->previous() }}"
                class="text-sm font-medium text-gray-500 hover:text-indigo-600 flex items-center gap-1 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Batal & Kembali
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gray-50 p-6 border-b border-gray-200">
                <div class="flex items-center gap-2 mb-2">
                    <span
                        class="bg-indigo-100 text-indigo-700 text-xs font-bold px-2.5 py-0.5 rounded border border-indigo-200 uppercase tracking-wide">
                        {{ $selectedMeeting->meeting_name }}
                    </span>
                </div>
                <h2 class="text-lg font-bold text-gray-900">{{ $selectedAssignment->assignment_name }}</h2>
            </div>

            <form action="{{ route('pengajuan-tugas.update', $submission->id) }}" method="POST"
                enctype="multipart/form-data" class="p-6 md:p-8">
                @csrf
                @method('PUT')

                @if ($submission->file_location)
                    <div class="mb-8">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">File Dikumpulkan Saat Ini</label>

                        @php
                            $extension = pathinfo($submission->file_location, PATHINFO_EXTENSION);
                            $fileName = basename($submission->file_location);
                        @endphp

                        <div class="flex items-center gap-4 p-4 bg-blue-50 border border-blue-100 rounded-xl">
                            <div class="p-3 bg-white rounded-lg border border-blue-100 text-blue-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate" title="{{ $fileName }}">
                                    {{ $fileName }}
                                </p>
                                <a href="{{ asset('storage/' . $submission->file_location) }}" target="_blank"
                                    class="text-xs text-blue-600 hover:underline">
                                    Lihat / Download File Lama
                                </a>
                            </div>
                            <div class="text-xs text-gray-500 bg-white px-2 py-1 rounded border border-blue-100 uppercase">
                                {{ $extension }}
                            </div>
                        </div>
                    </div>
                @endif

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Ganti File <span class="font-normal text-gray-500 text-xs ml-1">(Biarkan kosong jika tidak ingin
                            mengubah file)</span>
                    </label>

                    <div class="relative group">
                        <label for="file_input"
                            class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-white hover:bg-indigo-50 hover:border-indigo-400 transition-all duration-300 group-hover:shadow-sm">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 text-gray-400 group-hover:text-indigo-500 mb-3 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                    </path>
                                </svg>
                                <p class="mb-1 text-sm text-gray-500 group-hover:text-indigo-600"><span
                                        class="font-semibold">Klik untuk ganti file</span></p>
                                <p class="text-xs text-gray-400">PDF, Word, Excel, PPT, Gambar (Max 10MB)</p>
                            </div>
                            <input id="file_input" name="file_location" type="file" class="hidden"
                                accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.mp3,.wav,.m4a,.jpg,.jpeg,.png" />
                        </label>
                    </div>

                    <div id="file_info"
                        class="mt-3 hidden items-center gap-2 text-sm text-gray-700 bg-green-50 p-2 rounded-lg border border-green-100">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-semibold text-green-700">File Baru Dipilih:</span>
                        <span id="file_name" class="truncate"></span>
                    </div>
                    <x-input-error :messages="$errors->get('file_location')" class="mt-2" />
                </div>

                <div class="mb-8">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Catatan Tambahan</label>
                    <textarea name="description" id="description" rows="3"
                        class="block w-full p-3 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-400 shadow-sm transition"
                        placeholder="Tambahkan pesan untuk asisten jika perlu..." required>{{ old('description', $submission->description) }}</textarea>
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-100">
                    <x-primary-button class="w-full sm:w-auto justify-center px-6 py-3 text-base">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        Simpan Perubahan
                    </x-primary-button>
                </div>

            </form>
        </div>
    </div>

    <script>
        document.getElementById('file_input').addEventListener('change', function() {
            const fileInfo = document.getElementById('file_info');
            const fileName = document.getElementById('file_name');

            if (this.files.length > 0) {
                fileName.textContent = this.files[0].name;
                fileInfo.classList.remove('hidden');
                fileInfo.classList.add('flex');
            } else {
                fileInfo.classList.add('hidden');
                fileInfo.classList.remove('flex');
            }
        });
    </script>
@endsection
