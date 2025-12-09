@extends('dashboard.praktikan.praktikan-base')

@section('page-title', 'SAINS | Pengajuan Tugas')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:mt-24">

        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Pengumpulan Tugas</h1>
                <p class="text-sm text-gray-500 mt-1">Silakan unggah jawaban tugas Anda di sini.</p>
            </div>
            <a href="{{ url()->previous() }}"
                class="text-sm font-medium text-gray-500 hover:text-indigo-600 flex items-center gap-1 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali
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
                <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $selectedAssignment->assignment_name }}</h2>
                <p class="text-sm text-gray-600 leading-relaxed">
                    {{ $selectedAssignment->description ?: 'Tidak ada deskripsi tambahan untuk tugas ini.' }}
                </p>
            </div>

            <div class="p-6 md:p-8">
                <form action="{{ route('pengajuan-tugas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="assignment_id" value="{{ $selectedAssignment->id }}">
                    <input type="hidden" name="meeting_id" value="{{ $selectedMeeting->id }}">
                    <input type="hidden" name="halaqah_id" value="{{ $selectedHalaqah->id }}">

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">File Jawaban</label>

                        <div class="relative group">
                            <label for="file_input"
                                class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-indigo-50 hover:border-indigo-400 transition-all duration-300 group-hover:shadow-sm">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 text-gray-400 group-hover:text-indigo-500 mb-3 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                        </path>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 group-hover:text-indigo-600"><span
                                            class="font-semibold">Klik untuk unggah</span> atau seret file ke sini</p>
                                    <p class="text-xs text-gray-400">PDF, Word, Excel, PPT, Gambar (Max 10MB)</p>
                                </div>
                                <input id="file_input" name="file_location" type="file" class="hidden"
                                    accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.mp3,.wav,.m4a,.jpg,.jpeg,.png" />
                            </label>
                        </div>

                        <div id="file_info"
                            class="mt-3 hidden items-center gap-2 text-sm text-gray-700 bg-indigo-50 p-2 rounded-lg border border-indigo-100">
                            <svg class="w-5 h-5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span id="file_name" class="font-medium truncate"></span>
                        </div>
                        <x-input-error :messages="$errors->get('file_location')" class="mt-2" />
                    </div>

                    <div class="mb-8">
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Catatan Tambahan
                            (Opsional)</label>
                        <textarea name="description" id="description" rows="3"
                            class="block w-full p-3 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-400 shadow-sm transition"
                            placeholder="Tambahkan pesan untuk asisten jika perlu..."></textarea>
                    </div>

                    <div class="flex justify-end pt-4 border-t border-gray-100">
                        <x-primary-button class="w-full sm:w-auto justify-center px-6 py-3 text-base">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            Kirim Jawaban
                        </x-primary-button>
                    </div>
                </form>
            </div>
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
