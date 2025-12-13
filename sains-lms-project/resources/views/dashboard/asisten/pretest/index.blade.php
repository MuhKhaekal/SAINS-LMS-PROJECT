@extends('dashboard.asisten.asisten-base')

@section('page-title', 'SAINS | Nilai Pretest')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:mt-24">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Daftar Nilai Pretest</h1>
                <p class="text-sm text-gray-500 mt-1">Halaqah: <span
                        class="font-bold text-indigo-600">{{ $selectedHalaqah->halaqah_name }}</span></p>
            </div>
            <div class="flex gap-2">
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-50 transition">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-4 w-10 text-center">No</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Nama Praktikan</th>
                            <th scope="col" class="px-6 py-4 text-center font-semibold text-blue-600">KBQ</th>
                            <th scope="col" class="px-6 py-4 text-center font-semibold text-green-600">Hukum Bacaan</th>
                            <th scope="col" class="px-6 py-4 text-center font-semibold text-orange-600">Makharijul Huruf
                            </th>
                            <th scope="col" class="px-6 py-4 text-center font-bold text-gray-800">Total</th>
                            <th scope="col" class="px-6 py-4 text-center font-semibold text-gray-600">KET</th>
                            <th scope="col" class="px-6 py-4 text-center font-bold text-gray-800">Grade</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($praktikans as $index => $praktikan)
                            @php
                                $nilai = $praktikan->nilai_pretest;
                                $hasScore = $nilai ? true : false;
                            @endphp
                            <tr class="bg-white hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-center text-gray-500">{{ $index + 1 }}</td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-indigo-50 flex items-center justify-center text-xs font-bold text-indigo-600 border border-indigo-100">
                                            {{ substr($praktikan->nama, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $praktikan->nama }}</div>
                                            <div class="text-xs text-gray-500 font-mono">{{ $praktikan->nim }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if ($hasScore)
                                        <span class="font-mono font-medium text-blue-700">{{ $nilai->kbq }}</span>
                                    @else
                                        <span class="text-gray-300">-</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if ($hasScore)
                                        <span class="font-mono font-medium text-green-700">{{ $nilai->hb }}</span>
                                    @else
                                        <span class="text-gray-300">-</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if ($hasScore)
                                        <span class="font-mono font-medium text-orange-700">{{ $nilai->mh }}</span>
                                    @else
                                        <span class="text-gray-300">-</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if ($hasScore)
                                        <span
                                            class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-800 border border-gray-200">
                                            {{ $nilai->total }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-50 text-gray-400 border border-gray-100">
                                            Belum Dinilai
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="text-xs font-semibold 
                                        {{ $praktikan->ket == 'SANGAT BAIK' ? 'text-green-600' : '' }}
                                        {{ $praktikan->ket == 'BAIK' ? 'text-blue-600' : '' }}
                                        {{ $praktikan->ket == 'CUKUP' ? 'text-yellow-600' : '' }}
                                        {{ $praktikan->ket == 'KURANG' || $praktikan->ket == 'SANGAT KURANG' ? 'text-red-600' : '' }}
                                    ">
                                        {{ $praktikan->ket }}
                                    </span>
                                </td>

                                {{-- Kolom Grade --}}
                                <td class="px-6 py-4 text-center">
                                    @if ($praktikan->grade == 'TIDAK PRE-TEST')
                                        <span
                                            class="inline-flex items-center justify-center px-2 py-1 rounded text-[10px] font-bold bg-gray-100 text-gray-500">
                                            TIDAK PRE-TEST
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-full text-sm font-bold border 
                                            {{ $praktikan->grade == 'A' ? 'bg-green-50 text-green-700 border-green-200' : '' }}
                                            {{ $praktikan->grade == 'B' ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}
                                            {{ $praktikan->grade == 'C' ? 'bg-red-50 text-red-700 border-red-200' : '' }}
                                        ">
                                            {{ $praktikan->grade }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500 italic">
                                    Tidak ada praktikan terdaftar dalam halaqah ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
