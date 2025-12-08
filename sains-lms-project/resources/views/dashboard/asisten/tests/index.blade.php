@extends('dashboard.asisten.asisten-base')

@section('page-title', 'SAINS | Pretest')

@section('content')
    <section class="m-4 bg-white p-4 rounded-md shadow-md border md:mx-24 md:mt-20">
        <h1 class="font-bold text-xl border-b">Mulai {{ $test->title }}</h1>
        <p class="bg-yellow-500 text-sm px-2 w-fit text-secondary mt-2 uppercase rounded-md">{{ $test->test_type }}</p>
        <p class="mt-1 text-sm">{{ $test->description }}</p>
        <p class="mt-1 text-sm">Jumlah Soal: {{ count($questions) }} soal</p>
        <p class="mt-1 text-sm">Durasi: {{ $test->duration }} menit</p>

        <div class="flex justify-end mt-5">
            @if ($testSession && $testSession->is_open)
                <form action="{{ route('ujian-asisten.close', $test->id) }}" method="POST">
                    @csrf
                    <x-danger-button>Tutup Tes</x-danger-button>
                </form>
            @else
                <form action="{{ route('ujian-asisten.open', $test->id) }}" method="POST">
                    @csrf
                    <x-primary-button>Buka Tes</x-primary-button>
                </form>
            @endif

        </div>

    </section>
@endsection
