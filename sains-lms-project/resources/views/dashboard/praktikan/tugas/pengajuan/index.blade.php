@extends('dashboard.praktikan.praktikan-base')

@section('page-title', 'SAINS | Pengajuan Tugas')

@section('content')
    <section class="m-4 md:mx-24 md:mt-24">
        <div class="bg-white p-4 md:p-12 shadow-md border rounded-md">
            <h1 class="font-bold text-xl border-b border-gray-400">Tugas: {{ $selectedAssignment->assignment_name }}</h1>

            <div class="my-6">
                <p class="bg-secondary w-fit px-2 py-1 rounded-md font-bold">{{ $selectedMeeting->meeting_name }}</p>
                <p class="text-sm mt-1">{{ $selectedMeeting->description }}</p>
            </div>

            <div class="my-6">
                <p class="font-bold">Deskripsi Tugas: </p>
                <p class="text-sm mt-1">{{ $selectedAssignment->description }}</p>
            </div>

            <form action="{{ route('pengajuan-tugas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="assignment_id" value="{{ $selectedAssignment->id }}">
                <input type="hidden" name="meeting_id" value="{{ $selectedMeeting->id }}">
                <input type="hidden" name="halaqah_id" value="{{ $selectedHalaqah->id }}">
                <div class="my-6">
                    <p class="font-bold">File Tugas: </p>
                    <div class="">
                        <label for="file_input"
                            class="p-4 mt-1 flex flex-col items-center justify-center w-full border border-gray-500 border-dashed rounded-lg cursor-pointer bg-gray-100 hover:bg-gray-200 transition duration-150">

                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-10 h-10 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 10V4a1 1 0 0 0-1-1H9.914a1 1 0 0 0-.707.293L5.293 7.207A1 1 0 0 0 5 7.914V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2M10 3v4a1 1 0 0 1-1 1H5m5 6h9m0 0-2-2m2 2-2 2" />
                                </svg>

                                <p class="text-xs text-gray-400 mt-2">
                                    <span class="font-semibold">Klik untuk unggah</span> atau seret & letakkan
                                </p>
                                <p class="text-xs text-gray-400 mt-1">PDF, PPT, DOCX, JPG, PNG (max 10MB)</p>
                            </div>

                            <input class="hidden" id="file_input" type="file" name="file_location"
                                accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.mp3,.wav,.m4a,.jpg,.jpeg,.png">
                        </label>

                        <p id="file_name" class="text-xs text-gray-400 mt-2"></p>
                        <x-input-error :messages="$errors->get('file')" />
                    </div>
                    <script>
                        document.getElementById('file_input').addEventListener('change', function() {
                            const fileNameText = document.getElementById('file_name');
                            fileNameText.textContent = this.files.length ? "File dipilih: " + this.files[0].name : "";
                        });
                    </script>
                </div>
                <div class="my-6">
                    <p class="font-bold">Catatan: </p>
                    <textarea name="description" class="w-full rounded-md mt-1 text-xs" id="" rows="3"
                        placeholder="Isi catatan jika ada ... " required></textarea>
                </div>
                <div class="flex justify-end">
                    <x-primary-button>
                        Submit
                    </x-primary-button>
                </div>
            </form>

        </div>
    </section>
@endsection
