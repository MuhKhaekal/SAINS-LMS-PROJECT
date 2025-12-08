@extends('dashboard.asisten.asisten-base')

@section('page-title', 'SAINS | Nilai Pekanan')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:mt-24">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Input Nilai Pekanan</h1>
                <div class="flex items-center gap-2 mt-1 text-sm text-gray-500">
                    <span>Halaqah</span>
                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="font-medium text-gray-700">{{ $selectedHalaqah->halaqah_name }}</span>
                </div>
            </div>
            <div>
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <div
            class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6 flex flex-col md:flex-row items-center justify-between gap-4 top-4 z-20">
            <div class="text-sm text-gray-500 flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Pastikan nilai antara 0 - 100.
            </div>

            <div class="flex items-center gap-3 w-full md:w-auto">
                <x-primary-button onclick="document.getElementById('nilaiForm').submit()"
                    class="w-full md:w-auto justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                        </path>
                    </svg>
                    Simpan Perubahan
                </x-primary-button>
            </div>
        </div>

        <form id="nilaiForm" action="{{ route('nilai-perpekan.store') }}" method="POST">
            @csrf
            <input type="hidden" name="halaqah_id" value="{{ $selectedHalaqah->id }}">

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th scope="col" class="px-4 py-4 w-10 text-center left-0 bg-gray-50 z-10">No</th>
                                <th scope="col"
                                    class="px-4 py-4 min-w-[120px] font-semibold  left-10 bg-gray-50 z-10 shadow-sm">
                                    Nama & NIM</th>

                                @for ($i = 1; $i <= 6; $i++)
                                    <th scope="col" class="px-2 py-4 text-center min-w-[80px]">
                                        <div class="flex flex-col">
                                            <span>Pekan</span>
                                            <span class="text-lg font-bold text-gray-700">{{ $i }}</span>
                                        </div>
                                    </th>
                                @endfor

                                <th scope="col" class="px-4 py-4 min-w-[200px] font-semibold">Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($praktikans as $index => $praktikan)
                                @php
                                    $score = $weeklyScores[$praktikan->id] ?? null;
                                @endphp

                                <tr class="bg-white hover:bg-gray-50 transition-colors group">
                                    <input type="hidden" name="weeklyScore[{{ $praktikan->id }}][user_id]"
                                        value="{{ $praktikan->id }}">
                                    <td
                                        class="px-4 py-4 text-center text-gray-500 left-0 bg-white group-hover:bg-gray-50 z-10">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-4 py-4 left-10 bg-white group-hover:bg-gray-50 z-10 shadow-sm">
                                        <div class="font-medium text-gray-900">{{ $praktikan->nama }}</div>
                                        <div class="text-xs text-gray-500 font-mono">{{ $praktikan->nim }}</div>
                                    </td>

                                    @for ($i = 1; $i <= 6; $i++)
                                        <td class="px-2 py-4 text-center">
                                            <input type="number"
                                                name="weeklyScore[{{ $praktikan->id }}][score{{ $i }}]"
                                                value="{{ $score->{'score' . $i} ?? '' }}" min="0" max="100"
                                                oninput="if(Number(this.value) > 100) this.value = 100; if(Number(this.value) < 0) this.value = 0;"
                                                class="no-spinner w-16 text-center text-sm font-medium rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 placeholder-gray-300"
                                                placeholder="-">
                                        </td>
                                    @endfor

                                    <td class="px-4 py-4">
                                        <textarea rows="1" name="weeklyScore[{{ $praktikan->id }}][description]"
                                            class="block w-full text-xs rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 placeholder-gray-400 transition resize-none"
                                            placeholder="Tambahkan catatan...">{{ $score->description ?? '' }}</textarea>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </form>


    </div>

    <style>
        input.no-spinner::-webkit-outer-spin-button,
        input.no-spinner::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input.no-spinner {
            -moz-appearance: textfield;
        }
    </style>

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
