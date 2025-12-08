@extends('dashboard.asisten.asisten-base')

@section('page-title', 'SAINS | Nilai Pekanan')

@section('content')
    <section class="m-4 md:mx-24 md:mt-24 bg-white shadow-md p-8 rounded-md border-2">
        <h1 class="text-center font-bold text-xl mb-4">Nilai Pekanan: {{ $selectedHalaqah->halaqah_name }}</h1>

        

        <form action="{{ route('nilai-perpekan.store') }}" method="POST">
            @csrf
            <input type="hidden" name="halaqah_id" value="{{ $selectedHalaqah->id }}">

            <section class="flex justify-end items-center mb-4">
                <div class="mt-2 md:mb-0">
                    <x-secondary-button type="submit">
                        Simpan Nilai
                    </x-secondary-button>
                </div>
            </section>

            <section class="mt-5 overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right">
                    <thead class="text-xs uppercase bg-gray-100 text-gray-500">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-center">No</th>
                            <th scope="col" class="px-4 py-3">NIM</th>
                            <th scope="col" class="px-4 py-3 min-w-[150px]">Nama</th>
                            <th scope="col" class="px-2 py-3 text-center">Pekan 1</th>
                            <th scope="col" class="px-2 py-3 text-center">Pekan 2</th>
                            <th scope="col" class="px-2 py-3 text-center">Pekan 3</th>
                            <th scope="col" class="px-2 py-3 text-center">Pekan 4</th>
                            <th scope="col" class="px-2 py-3 text-center">Pekan 5</th>
                            <th scope="col" class="px-2 py-3 text-center">Pekan 6</th>
                            <th scope="col" class="px-4 py-3 min-w-[200px]">Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($praktikans as $index => $praktikan)
                            @php
                                $score = $weeklyScores[$praktikan->id] ?? null;
                            @endphp

                            <tr class="bg-white hover:bg-gray-100 text-primary border-b">
                                <td class="px-4 py-4 text-center">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-4 py-4 font-medium">
                                    {{ $praktikan->nim }}
                                </td>
                                <td class="px-4 py-4">
                                    {{ $praktikan->nama }}
                                </td>

                                @for ($i = 1; $i <= 6; $i++)
                                    <td class="px-2 py-4 text-center">
                                        <input type="number"
                                            name="weeklyScore[{{ $praktikan->id }}][score{{ $i }}]"
                                            value="{{ $score->{'score' . $i} ?? '' }}"  min="0"
                                            max="100"
                                            oninput="if(Number(this.value) > 100) this.value = 100; if(Number(this.value) < 0) this.value = 0;"
                                            class="rounded-md text-sm w-16 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 p-2 text-center"
                                            placeholder="0">
                                    </td>
                                @endfor

                                <td class="px-4 py-4">
                                    <textarea rows="1" name="weeklyScore[{{ $praktikan->id }}][description]"
                                        class="block w-full text-xs rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-primary placeholder:text-gray-400"
                                        placeholder="Catatan...">{{ $score->description ?? '' }}</textarea>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </form>
    </section>

    <div class="md:mx-24 mx-4 mt-8 mb-8 md:mb-0">
        <a href="{{ url()->previous() }}"
            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition ease-in-out duration-150 text-sm">
            Kembali
        </a>
    </div>

    @if (session('success'))
        <div id="alert-success"
            class="fixed top-4 right-4 z-50 flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 rounded-lg shadow-lg"
            role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <div class="ms-3 text-sm font-medium">{{ session('success') }}</div>
        </div>
        <script>
            setTimeout(() => document.getElementById('alert-success').remove(), 3000);
        </script>
    @endif
@endsection
