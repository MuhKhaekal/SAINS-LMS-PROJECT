@extends('dashboard.asisten.asisten-base')

@section('page-title', 'SAINS | Input Pretest')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:mt-24">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Input Nilai Pre-Test</h1>
                <div class="flex items-center gap-2 mt-1 text-sm text-gray-500">
                    <span>{{ $selectedHalaqah->halaqah_name }}</span>
                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="font-medium text-gray-700">Penilaian Awal</span>
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
            <div class="text-sm text-gray-600 flex items-center gap-2">
                <div class="p-1.5 bg-indigo-50 text-indigo-600 rounded-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span>
                    Input nilai per aspek: <b>0 - 10</b>. Total otomatis dikonversi ke skala <b>100</b>.
                </span>
            </div>
            <form id="nilaiForm" action="{{ route('pretest.store') }}" method="POST">
                @csrf
                <x-primary-button type="submit" class="w-full md:w-auto justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Nilai
                </x-primary-button>
        </div>


        <input type="hidden" name="halaqah_id" value="{{ $selectedHalaqah->id }}">

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-4 w-12 text-center left-0 bg-gray-50 z-10">No</th>
                            <th scope="col"
                                class="px-6 py-4 min-w-[200px] font-semibold  left-12 bg-gray-50 z-10 shadow-sm">
                                Nama & NIM</th>

                            <th scope="col" class="px-4 py-4 text-center w-32 min-w-[100px]">
                                <div class="flex flex-col">
                                    <span class="font-bold text-gray-700">Kelancaran</span>
                                    <span class="text-[10px] text-gray-400 lowercase"></span>
                                </div>
                            </th>
                            <th scope="col" class="px-4 py-4 text-center w-32 min-w-[100px]">
                                <div class="flex flex-col">
                                    <span class="font-bold text-gray-700">Tajwid</span>
                                    <span class="text-[10px] text-gray-400 lowercase"></span>
                                </div>
                            </th>
                            <th scope="col" class="px-4 py-4 text-center w-32 min-w-[100px]">
                                <div class="flex flex-col">
                                    <span class="font-bold text-gray-700">Makhraj</span>
                                    <span class="text-[10px] text-gray-400 lowercase"></span>
                                </div>
                            </th>

                            <th scope="col"
                                class="px-4 py-4 text-center w-28 bg-indigo-50/50 border-l border-indigo-100">
                                <div class="flex flex-col text-indigo-700">
                                    <span class="font-bold">Total</span>
                                    <span class="text-[10px]"></span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($praktikans as $index => $praktikan)
                            @php
                                $data = $pretests[$praktikan->id] ?? null;
                            @endphp

                            <tr class="bg-white hover:bg-gray-50 transition-colors row-user group"
                                data-id="{{ $praktikan->id }}">

                                <td
                                    class="px-6 py-4 text-center text-gray-500  left-0 bg-white group-hover:bg-gray-50 z-10">
                                    {{ $index + 1 }}
                                </td>

                                <td
                                    class="px-6 py-4 left-12 bg-white group-hover:bg-gray-50 z-10 shadow-sm border-r border-transparent group-hover:border-gray-100">
                                    <div class="font-medium text-gray-900 group-hover:text-indigo-600 transition-colors">
                                        {{ $praktikan->nama }}</div>
                                    <div class="text-xs text-gray-500 font-mono">{{ $praktikan->nim }}</div>
                                </td>

                                <td class="px-4 py-4 text-center">
                                    <input type="number" name="pretests[{{ $praktikan->id }}][kbq]"
                                        value="{{ $data->kbq ?? 0 }}" min="0" max="10"
                                        class="score-input kbq w-20 text-center text-sm font-medium text-gray-900 rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 no-spinner transition shadow-sm placeholder-gray-300"
                                        placeholder="0" oninput="calculateTotal({{ $praktikan->id }})">
                                </td>

                                <td class="px-4 py-4 text-center">
                                    <input type="number" name="pretests[{{ $praktikan->id }}][hb]"
                                        value="{{ $data->hb ?? 0 }}" min="0" max="10"
                                        class="score-input hb w-20 text-center text-sm font-medium text-gray-900 rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 no-spinner transition shadow-sm placeholder-gray-300"
                                        placeholder="0" oninput="calculateTotal({{ $praktikan->id }})">
                                </td>

                                <td class="px-4 py-4 text-center">
                                    <input type="number" name="pretests[{{ $praktikan->id }}][mh]"
                                        value="{{ $data->mh ?? 0 }}" min="0" max="10"
                                        class="score-input mh w-20 text-center text-sm font-medium text-gray-900 rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 no-spinner transition shadow-sm placeholder-gray-300"
                                        placeholder="0" oninput="calculateTotal({{ $praktikan->id }})">
                                </td>

                                <td class="px-4 py-4 text-center bg-indigo-50/30 border-l border-indigo-100">
                                    <input type="text" id="total-display-{{ $praktikan->id }}"
                                        value="{{ $data->total ?? 0 }}" readonly
                                        class="w-full text-center text-lg font-bold text-indigo-700 bg-transparent border-0 cursor-default focus:ring-0 p-0"
                                        tabindex="-1">
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

    <script>
        function calculateTotal(userId) {
            const row = document.querySelector(`.row-user[data-id="${userId}"]`);
            const maxVal = 10;

            const validateInput = (selector) => {
                let el = row.querySelector(selector);
                let val = el.value;

                if (val === '') return 0;

                val = parseFloat(val);

                if (val > maxVal) {
                    val = maxVal;
                    el.value = maxVal;
                }
                if (val < 0) {
                    val = 0;
                    el.value = 0;
                }
                return val;
            };

            let kbq = validateInput('.kbq');
            let hb = validateInput('.hb');
            let mh = validateInput('.mh');

            let sum = kbq + hb + mh;
            let total = (sum / 30) * 100;

            document.getElementById(`total-display-${userId}`).value = Math.round(total);
        }
    </script>

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
