@extends('dashboard.asisten.asisten-base')

@section('page-title', 'SAINS | Sahkan Sertifikat')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py- md:mt-24">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Validasi Sertifikat</h1>
                <p class="text-sm text-gray-500 mt-1">Verifikasi dan sahkan sertifikat untuk halaqah: <span
                        class="font-bold text-indigo-600">{{ $selectedHalaqah->halaqah_name }}</span></p>
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

        @if (!$hasTemplate)
            <div class="rounded-xl border border-yellow-200 bg-yellow-50 p-8 text-center shadow-sm">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-yellow-100 mb-4">
                    <svg class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-yellow-800">Template Sertifikat Belum Tersedia</h3>
                <p class="mt-2 text-sm text-yellow-700 max-w-lg mx-auto">
                    Mohon maaf, Admin belum mengunggah template <b>Sertifikat Praktikan Umum</b>. Anda belum dapat melakukan
                    pengesahan sertifikat untuk praktikan saat ini.
                </p>
                <p class="mt-4 text-xs text-yellow-600">Silakan hubungi Admin untuk informasi lebih lanjut.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
                    <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium uppercase">Total Praktikan</p>
                        <p class="text-xl font-bold text-gray-800">{{ $stats['total'] }}</p>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
                    <div class="p-3 bg-green-50 text-green-600 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium uppercase">Memenuhi Syarat</p>
                        <p class="text-xl font-bold text-gray-800">{{ $stats['layak'] }} <span
                                class="text-xs font-normal text-gray-400">/ {{ $stats['total'] }}</span></p>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium uppercase">Sudah Disahkan</p>
                        <p class="text-xl font-bold text-gray-800">{{ $stats['validated'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-4 w-10 text-center">No</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Nama Praktikan</th>
                                <th scope="col" class="px-6 py-4 text-center font-semibold">Kehadiran (Min 4)</th>
                                <th scope="col" class="px-6 py-4 text-center font-semibold">Tugas (Min 4)</th>
                                <th scope="col" class="px-6 py-4 text-center font-semibold">Status Syarat</th>
                                <th scope="col" class="px-6 py-4 text-right font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($praktikans as $index => $praktikan)
                                <tr class="bg-white hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-center text-gray-500">{{ $index + 1 }}</td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-600">
                                                {{ substr($praktikan->nama, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">{{ $praktikan->nama }}</div>
                                                <div class="text-xs text-gray-500 font-mono">{{ $praktikan->nim }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="px-2.5 py-1 text-xs font-medium rounded-full {{ $praktikan->attendance_count >= 4 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $praktikan->attendance_count }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="px-2.5 py-1 text-xs font-medium rounded-full {{ $praktikan->task_count >= 4 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $praktikan->task_count }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        @if ($praktikan->is_eligible)
                                            <div
                                                class="inline-flex items-center gap-1.5 text-green-600 bg-green-50 px-3 py-1 rounded-full text-xs font-bold border border-green-100">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Terpenuhi
                                            </div>
                                        @else
                                            <div class="inline-flex items-center gap-1.5 text-red-600 bg-red-50 px-3 py-1 rounded-full text-xs font-bold border border-red-100"
                                                title="Syarat kehadiran atau tugas kurang">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Kurang
                                            </div>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        @if ($praktikan->is_validated)
                                            <div class="flex flex-col items-end gap-1">
                                                <span
                                                    class="text-[10px] text-green-600 font-bold uppercase tracking-wider mb-1">Tersahkan</span>
                                                <form action="{{ route('asisten.sertifikat.revoke', $praktikan->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center px-3 py-1.5 text-xs font-bold text-red-700 bg-white border border-red-200 rounded-lg shadow-sm hover:bg-red-50 hover:border-red-300 transition-all">
                                                        <svg class="w-3.5 h-3.5 mr-1.5 text-red-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                        Batalkan
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <form action="{{ route('asisten.sertifikat.store', $praktikan->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 text-xs font-bold text-white rounded-lg shadow-sm transition-all bg-indigo-600 hover:bg-indigo-700">
                                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    Sahkan
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        @endif

    </div>
@endsection
