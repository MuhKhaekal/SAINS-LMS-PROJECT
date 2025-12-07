@extends('dashboard.praktikan.praktikan-base')

@section('page-title', 'SAINS | Pretest')


@section('content')
    <section class="m-4 md:mx-24 md:mt-20">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold">Pretest: {{ $test->title }}</h2>
                <p class="text-sm text-gray-600 mt-1">{{ $test->description }}</p>
            </div>

            <div class="text-sm bg-blue-50 text-blue-700 px-4 py-2 rounded-lg border">
                Durasi: <span class="font-bold">{{ $test->duration }} menit</span>
            </div>
        </div>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="bg-white p-6 rounded shadow">
            @if($existingSubmission)
                <div class="p-4 bg-green-50 border border-green-300 text-green-700 rounded mb-4">
                    Anda sudah mengerjakan pretest ini. Nilai Anda telah tersimpan.
                </div>
                <button class="px-4 py-2 bg-gray-300 text-gray-600 rounded cursor-not-allowed">
                    Pretest sudah dikerjakan
                </button>
            @elseif(!$session || !$session->is_open)
                <button class="px-4 py-2 bg-gray-300 text-gray-600 rounded cursor-not-allowed">
                    Pretest belum dibuka
                </button>
            @else
                <form action="{{ route('pretest-praktikan.start', $test->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded">
                        Mulai Pretest
                    </button>
                </form>
            @endif
        
        </div>
        
    </section>
@endsection

