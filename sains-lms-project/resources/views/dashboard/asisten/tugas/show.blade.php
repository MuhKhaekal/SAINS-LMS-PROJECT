<!-- resources/views/dashboard/asisten/materi/show.blade.php -->
@extends('dashboard.asisten.asisten-base')

@section('page-title', $assignment->assignment_name)

@section('content')
    <section class="mt-4 md:mx-24 md:mt-24">

        <div class=" bg-white shadow-md rounded-lg p-6 border ">

            <h2 class="hidden md:block font-bold text-2xl border-b w-fit border-gray-300">{{ $assignment->assignment_name }}</h2>
            <p class="text-sm font-thin text-gray-800 my-4">
                {{ $assignment->description }}
            </p>

            @php
                $path = $assignment->file_location;
                $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                $fileUrl = asset('storage/' . $path);
            @endphp

            <div class="mt-6 w-full h-fit rounded-lg overflow-hidden border border-gray-300 md:flex justify-center">

                @if ($extension === 'pdf')
                    <iframe  download="{{ $assignment->assignment_name . '.' . $extension }}" src="{{ $fileUrl }}" class="w-full h-[400px] md:h-[600px]" frameborder="0"></iframe>

                @elseif (in_array($extension, ['jpg', 'jpeg', 'png']))
                    <img src="{{ $fileUrl }}" class="w-full h-auto md:w-96 md:flex md:p-4 object-contain rounded-md" download="{{ $assignment->assignment_name . '.' . $extension }}" />

                @elseif (in_array($extension, ['mp3', 'wav']))
                    <div class="w-full flex justify-center items-center py-10 bg-gray-100">
                        <audio controls class="w-full max-w-xl" download="{{ $assignment->assignment_name . '.' . $extension }}">
                            <source src="{{ $fileUrl }}">
                        </audio >
                    </div>

                @elseif (in_array($extension, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx']))
                    <div
                        class="w-full flex flex-col items-center justify-center py-10 px-4 text-center bg-gradient-to-br from-gray-50 to-gray-200 rounded-lg">

                        <div class="p-6 bg-white w-full max-w-md rounded-xl shadow-md border">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $assignment->assignment_name }}</h3>

                            <p class="text-gray-500 text-sm mt-2">
                                Pratinjau tidak tersedia untuk tipe file ini.
                            </p>

                            <div class="mt-5">
                                <a href="{{ $fileUrl }}" download="{{ $assignment->assignment_name . '.' . $extension }}"
                                    class="inline-flex items-center gap-2 bg-indigo-600 text-white px-5 py-2.5 rounded-lg shadow hover:bg-indigo-700 transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                                    </svg>
                                    Download File
                                </a>
                            </div>
                        </div>
                    </div>


                @else
                    <div class="h-full flex flex-col items-center justify-center text-center p-6">
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            File tidak dapat ditampilkan, silakan unduh untuk melihat.
                        </p>
                        <a href="{{ $fileUrl }}" download="{{ $assignment->assignment_name . '.' . $extension }}"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow">
                            Download File
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <div class="md:mx-24 mx-4 my-8">
        <a href="{{ url()->previous() }}"
            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md  hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 md:basis-2/12 text-center flex items-center justify-center gap-2 w-fit">
            Kembali
        </a>
    </div>
@endsection
