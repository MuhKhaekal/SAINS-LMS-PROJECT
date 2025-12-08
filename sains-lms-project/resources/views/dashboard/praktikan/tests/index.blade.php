@extends('dashboard.praktikan.praktikan-base')

@section('page-title', 'SAINS | Pretest')

@section('content')
    <section class="m-4 md:m-24">
        @if ($test)
            <div class="mb-6 flex items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold">Mulai: {{ $test->title }}</h2>
                    <p class="text-sm text-gray-600 mt-1">{{ $test->description }}</p>
                </div>

                <div class="text-sm bg-blue-50 text-blue-700 px-4 py-2 rounded-lg border w-full md:w-fit">
                    Durasi: <span class="font-bold">{{ $test->duration }} menit</span>
                </div>
            </div>
        @else
            <div class="flex flex-col items-center justify-center h-64 bg-white rounded-t-lg border-gray-300">
                <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                    </path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900">Belum ada ujian tersedia</h3>
                <p class="text-gray-500 text-xs">Silakan tunggu informasi dari asisten.</p>
            </div>
        @endif


        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="bg-white p-6 rounded shadow">
            @if ($existingSubmission)
                <div class="p-4 bg-green-50 border border-green-300 text-green-700 rounded mb-4">
                    Anda sudah mengerjakan pretest ini. Nilai Anda telah tersimpan.
                </div>
                <button class="px-4 py-2 bg-gray-300 text-gray-600 rounded cursor-not-allowed text-sm">
                    Pretest sudah dikerjakan
                </button>
            @elseif(!$session || !$session->is_open)
                <button class="px-4 py-2 bg-gray-300 text-gray-600 rounded cursor-not-allowed text-sm">
                    Pretest belum dibuka
                </button>
            @else
                <form action="{{ route('ujian-praktikan.start', $test->id) }}" method="POST">
                    @csrf
                    <x-primary-button>
                        Mulai Pretest
                    </x-primary-button>
                </form>
            @endif

        </div>

    </section>
@endsection
