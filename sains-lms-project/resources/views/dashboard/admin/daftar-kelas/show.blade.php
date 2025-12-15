@extends('dashboard.admin.admin-base')
@section('page-title', 'Rekapitulasi Nilai Gabungan')

@section('content')
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-12 md:mt-0">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Rekapitulasi Nilai</h1>
                <div class="flex items-center gap-2 mt-1 text-sm text-gray-500">
                    <span class="font-medium text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded border border-indigo-100">
                        {{ $classPai->class_name }}
                    </span>
                    <span class="text-gray-400">|</span>
                    <span>Data Gabungan Seluruh Halaqah</span>
                </div>
            </div>
            <div>
                <a href="{{ route('daftar-kelas.export', $classPai->id) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm hover:bg-green-700 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Download Excel
                </a>
                
                <a href="{{ route('daftar-kelas.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        {{-- INFO CARDS --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
            <div class="flex items-center gap-2 mb-4 pb-4 border-b border-gray-100">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wide">Informasi Kelas</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-12">
                {{-- Baris 1: Kelas & Dosen --}}
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Nama Kelas</label>
                    <p class="text-lg font-bold text-gray-900">{{ $classPai->class_name }}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Dosen Pengampu</label>
                    <p class="text-lg font-bold text-gray-900">{{ $classPai->lecturer }}</p>
                </div>

                {{-- Baris 2: Fakultas & Prodi (Full Width jika panjang) --}}
                <div class="md:col-span-2 border-t border-gray-50 pt-4 grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-12">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Fakultas</label>
                        <p class="text-sm font-medium text-gray-700 leading-relaxed">{{ $facultyList }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Program Studi</label>
                        <p class="text-sm font-medium text-gray-700 leading-relaxed">{{ $prodiList }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- TABEL 1: RINCIAN NILAI MENTAH --}}
        <div class="mb-12">
            <div class="flex items-center gap-2 mb-4">
                <span class="w-1 h-6 bg-indigo-600 rounded-full"></span>
                <h2 class="text-lg font-bold text-gray-800">1. Rincian Nilai Mentah Gabungan</h2>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-xs text-left whitespace-nowrap">
                        <thead
                            class="bg-gray-50 text-gray-600 uppercase font-semibold text-center border-b border-gray-200">
                            <tr>
                                <th rowspan="2"
                                    class="px-3 py-3 border-r border-gray-200 sticky left-0 bg-gray-50 w-10 z-20">No</th>
                                <th rowspan="2"
                                    class="px-3 py-3 border-r border-gray-200 sticky left-10 bg-gray-50 text-left w-24 z-20 shadow-[2px_0_5px_-2px_rgba(0,0,0,0.05)]">
                                    NIM</th>
                                <th rowspan="2"
                                    class="px-3 py-3 border-r border-gray-200 bg-gray-50 text-left min-w-[150px] shadow-[2px_0_5px_-2px_rgba(0,0,0,0.05)]">
                                    Nama</th>
                                <th rowspan="2"
                                    class="px-3 py-3 border-r border-gray-200 bg-gray-50 text-left min-w-[120px] shadow-[4px_0_10px_-2px_rgba(0,0,0,0.1)]">
                                    Asal Halaqah</th>

                                <th colspan="5"
                                    class="px-2 py-2 border-r border-gray-200 border-t-2 border-sky-300 bg-sky-50 text-sky-700">
                                    Pre-Test</th>
                                <th colspan="6"
                                    class="px-2 py-2 border-r border-gray-200 border-t-2 border-emerald-300 bg-emerald-50 text-emerald-700">
                                    Pekanan</th>
                                <th colspan="5"
                                    class="px-2 py-2 border-r border-gray-200 border-t-2 border-indigo-300 bg-indigo-50 text-indigo-700">
                                    Post-Test</th>

                                <th rowspan="2"
                                    class="px-3 py-3 bg-slate-100 text-slate-700 border-t-2 border-slate-300">Final</th>
                            </tr>
                            <tr>
                                {{-- Sub Pretest --}}
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-sky-50/50 text-sky-700 font-medium">K
                                </th>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-sky-50/50 text-sky-700 font-medium">HB
                                </th>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-sky-50/50 text-sky-700 font-medium">MH
                                </th>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-sky-100 text-sky-800 font-bold">Hasil
                                </th>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-sky-50/50 text-sky-700 font-medium">Ket
                                </th>

                                {{-- Sub Pekanan --}}
                                @for ($i = 1; $i <= 6; $i++)
                                    <th
                                        class="px-2 py-1.5 border-r border-gray-200 bg-emerald-50/50 text-emerald-700 w-10 font-medium">
                                        {{ $i }}</th>
                                @endfor

                                {{-- Sub Posttest --}}
                                <th
                                    class="px-2 py-1.5 border-r border-gray-200 bg-indigo-50/50 text-indigo-700 font-medium">
                                    K</th>
                                <th
                                    class="px-2 py-1.5 border-r border-gray-200 bg-indigo-50/50 text-indigo-700 font-medium">
                                    HB</th>
                                <th
                                    class="px-2 py-1.5 border-r border-gray-200 bg-indigo-50/50 text-indigo-700 font-medium">
                                    MH</th>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-indigo-100 text-indigo-800 font-bold">
                                    Hasil
                                </th>
                                <th
                                    class="px-2 py-1.5 border-r border-gray-200 bg-indigo-50/50 text-indigo-700 font-medium">
                                    Ket</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 text-gray-700 text-center bg-white">
                            @forelse ($praktikans as $index => $p)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    {{-- Sticky Columns --}}
                                    <td
                                        class="px-3 py-2 border-r border-gray-100 sticky left-0 bg-white hover:bg-gray-50 z-10">
                                        {{ $index + 1 }}</td>
                                    <td
                                        class="px-3 py-2 border-r border-gray-100 font-mono text-xs sticky left-10 bg-white hover:bg-gray-50 z-10 text-left shadow-[2px_0_5px_-2px_rgba(0,0,0,0.05)]">
                                        {{ $p->nim }}</td>
                                    <td class="px-3 py-2 border-r border-gray-100 text-left font-medium  bg-white hover:bg-gray-50  shadow-[2px_0_5px_-2px_rgba(0,0,0,0.05)] truncate max-w-[150px]"
                                        title="{{ $p->nama }}">{{ $p->nama }}</td>
                                    <td class="px-3 py-2 border-r border-gray-100 text-left text-[10px] text-gray-500  bg-white hover:bg-gray-50  shadow-[4px_0_10px_-2px_rgba(0,0,0,0.1)] truncate max-w-[120px]"
                                        title="{{ $p->halaqahs->first()->halaqah_name ?? '-' }}">
                                        {{ $p->halaqahs->first()->halaqah_name ?? '-' }}
                                    </td>

                                    {{-- Pretest --}}
                                    <td class="px-2 py-2 border-r border-gray-100 bg-sky-50/10">{{ $p->pre_kbq }}</td>
                                    <td class="px-2 py-2 border-r border-gray-100 bg-sky-50/10">{{ $p->pre_hb }}</td>
                                    <td class="px-2 py-2 border-r border-gray-100 bg-sky-50/10">{{ $p->pre_mh }}</td>
                                    <td class="px-2 py-2 border-r border-gray-100 bg-sky-50/20 font-bold text-sky-700">
                                        {{ $p->pre_hasil }}</td>
                                    <td class="px-2 py-2 border-r border-gray-100 bg-sky-50/10 text-[10px]">
                                        {{ $p->pre_ket }}</td>

                                    {{-- Weekly --}}
                                    @for ($i = 1; $i <= 6; $i++)
                                        <td class="px-2 py-2 border-r border-gray-100">{{ $p->{'score' . $i} }}</td>
                                    @endfor

                                    {{-- Posttest --}}
                                    <td class="px-2 py-2 border-r border-gray-100 bg-indigo-50/10">{{ $p->post_kbq }}
                                    </td>
                                    <td class="px-2 py-2 border-r border-gray-100 bg-indigo-50/10">{{ $p->post_hb }}
                                    </td>
                                    <td class="px-2 py-2 border-r border-gray-100 bg-indigo-50/10">{{ $p->post_mh }}
                                    </td>
                                    <td
                                        class="px-2 py-2 border-r border-gray-100 bg-indigo-50/20 font-bold text-indigo-700">
                                        {{ $p->post_hasil }}</td>
                                    <td class="px-2 py-2 border-r border-gray-100 bg-indigo-50/10 text-[10px]">
                                        {{ $p->post_ket }}</td>

                                    {{-- Final --}}
                                    <td class="px-3 py-2 font-bold bg-slate-50 text-slate-800">{{ $p->final_score }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="25" class="px-6 py-8 text-center text-gray-500 italic">Belum ada data
                                        praktikan di kelas ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- TABEL 2: LAPORAN KELULUSAN --}}
        <div>
            <div class="flex items-center gap-2 mb-4">
                <span class="w-1 h-6 bg-green-600 rounded-full"></span>
                <h2 class="text-lg font-bold text-gray-800">2. Laporan Kelulusan Akhir Gabungan</h2>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-xs text-left whitespace-nowrap">
                        <thead
                            class="bg-gray-50 text-gray-600 uppercase font-semibold text-center border-b border-gray-200">
                            <tr>
                                <th rowspan="2"
                                    class="px-3 py-3 border-r border-gray-200 sticky left-0 bg-gray-50 w-10 z-20">No</th>
                                <th rowspan="2"
                                    class="px-3 py-3 border-r border-gray-200 sticky left-10 bg-gray-50 text-left w-24 z-20 shadow-[2px_0_5px_-2px_rgba(0,0,0,0.05)]">
                                    NIM</th>
                                <th rowspan="2"
                                    class="px-3 py-3 border-r border-gray-200 bg-gray-50 text-left min-w-[150px] shadow-[2px_0_5px_-2px_rgba(0,0,0,0.05)]">
                                    Nama</th>
                                <th rowspan="2"
                                    class="px-3 py-3 border-r border-gray-200 bg-gray-50 text-left min-w-[120px] shadow-[4px_0_10px_-2px_rgba(0,0,0,0.1)]">
                                    Asal Halaqah</th>

                                <th colspan="3"
                                    class="px-2 py-2 border-r border-gray-200 border-t-2 border-slate-300 bg-slate-50 text-slate-700">
                                    Persentase</th>

                                <th rowspan="2"
                                    class="px-3 py-2 border-r border-gray-200 bg-indigo-50 border-t-2 border-indigo-300 text-indigo-700 w-20">
                                    Nilai<br>Akhir</th>

                                <th colspan="2"
                                    class="px-2 py-2 border-r border-gray-200 border-t-2 border-sky-300 bg-sky-50 text-sky-700">
                                    Perkembangan KBQ</th>
                                <th rowspan="2"
                                    class="px-3 py-2 border-r border-gray-200 bg-emerald-50 border-t-2 border-emerald-300 text-emerald-700 w-24">
                                    Kehadiran</th>
                                <th rowspan="2"
                                    class="px-3 py-2 border-t-2 border-rose-300 bg-rose-50 text-rose-700 w-24">Status</th>
                            </tr>
                            <tr>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-slate-50 text-slate-600 w-16">KBQ (30%)
                                </th>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-slate-50 text-slate-600 w-16">Hdr (50%)
                                </th>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-slate-50 text-slate-600 w-16">Final
                                    (20%)</th>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-sky-50/50 text-sky-700 w-20">PRETEST
                                </th>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-sky-50/50 text-sky-700 w-20">POSTTEST
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 text-gray-700 text-center bg-white">
                            @forelse ($praktikans as $index => $p)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    {{-- Sticky Columns --}}
                                    <td
                                        class="px-3 py-2 border-r border-gray-100 sticky left-0 bg-white hover:bg-gray-50 z-10">
                                        {{ $index + 1 }}</td>
                                    <td
                                        class="px-3 py-2 border-r border-gray-100 font-mono sticky left-10 bg-white hover:bg-gray-50 z-10 text-left shadow-[2px_0_5px_-2px_rgba(0,0,0,0.05)]">
                                        {{ $p->nim }}</td>
                                    <td class="px-3 py-2 border-r border-gray-100 text-left font-medium bg-white hover:bg-gray-50 shadow-[2px_0_5px_-2px_rgba(0,0,0,0.05)] truncate max-w-[150px]"
                                        title="{{ $p->nama }}">{{ $p->nama }}</td>
                                    <td class="px-3 py-2 border-r border-gray-100 text-left text-[10px] text-gray-500 bg-white hover:bg-gray-50 shadow-[4px_0_10px_-2px_rgba(0,0,0,0.1)] truncate max-w-[120px]"
                                        title="{{ $p->halaqahs->first()->halaqah_name ?? '-' }}">
                                        {{ $p->halaqahs->first()->halaqah_name ?? '-' }}</td>

                                    {{-- Persentase --}}
                                    <td class="px-2 py-2 border-r border-gray-100">{{ number_format($p->val_kbq_30, 2) }}
                                    </td>
                                    <td class="px-2 py-2 border-r border-gray-100">
                                        {{ number_format($p->val_absen_50, 2) }}</td>
                                    <td class="px-2 py-2 border-r border-gray-100">
                                        {{ number_format($p->val_final_20, 2) }}</td>

                                    {{-- Nilai Akhir --}}
                                    <td
                                        class="px-3 py-2 border-r border-gray-100 font-bold text-indigo-700 bg-indigo-50/30">
                                        {{ number_format($p->val_total, 2) }}
                                    </td>

                                    {{-- Ket KBQ --}}
                                    <td class="px-2 py-2 border-r border-gray-100 text-[10px] font-medium bg-sky-50/10">
                                        {{ $p->pre_ket }}</td>
                                    <td class="px-2 py-2 border-r border-gray-100 text-[10px] font-medium bg-sky-50/10">
                                        {{ $p->post_ket }}</td>

                                    {{-- Kehadiran --}}
                                    <td class="px-3 py-2 border-r border-gray-100">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold 
                                            {{ $p->ket_absen == 'AKTIF' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                            {{ $p->ket_absen }}
                                        </span>
                                    </td>

                                    {{-- Status --}}
                                    <td class="px-3 py-2">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold 
                                            {{ $p->ket_lulus == 'LULUS' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $p->ket_lulus }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="15" class="px-6 py-8 text-center text-gray-500 italic">Belum ada data
                                        praktikan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="mt-8 mb-12">
            <h2 class="text-lg font-bold text-gray-800 border-l-4 border-indigo-600 pl-3 mb-4">3. Statistik Perkembangan
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

                {{-- BAR CHART (POST TEST) --}}
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4 lg:col-span-2">
                    <h3 class="text-sm font-bold text-gray-600 uppercase mb-4 text-center">Distribusi Nilai Post-Test</h3>
                    <div class="relative h-64 w-full">
                        <canvas id="barChartPost"></canvas>
                    </div>
                </div>

                {{-- PIE CHART (KELULUSAN) --}}
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4">
                    <h3 class="text-sm font-bold text-gray-600 uppercase mb-4 text-center">Persentase Kelulusan</h3>
                    <div class="relative h-64 w-full flex justify-center">
                        <canvas id="pieChartLulus"></canvas>
                    </div>
                </div>
            </div>

            {{-- TABEL PERBANDINGAN --}}
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="p-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-sm font-bold text-gray-700 uppercase">Tabel Perbandingan Pre-Test vs Post-Test</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-100 text-gray-700 uppercase font-bold text-center text-xs">
                            <tr>
                                <th class="px-6 py-3 border-b">Kategori</th>
                                <th class="px-6 py-3 border-b text-blue-700">Jumlah Pre-Test</th>
                                <th class="px-6 py-3 border-b text-indigo-700">Jumlah Post-Test</th>
                                <th class="px-6 py-3 border-b">Perubahan (Delta)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-center">
                            @foreach ($categories as $cat)
                                @php
                                    $preCount = $statsPre[$cat];
                                    $postCount = $statsPost[$cat];
                                    $delta = $postCount - $preCount;
                                    $deltaClass =
                                        $delta > 0 ? 'text-green-600' : ($delta < 0 ? 'text-red-600' : 'text-gray-400');
                                    $deltaSign = $delta > 0 ? '+' : '';
                                @endphp
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-3 font-semibold text-gray-600 text-left">{{ $cat }}</td>
                                    <td class="px-6 py-3 font-mono text-blue-600 bg-blue-50">{{ $preCount }}</td>
                                    <td class="px-6 py-3 font-mono text-indigo-600 bg-indigo-50">{{ $postCount }}</td>
                                    <td class="px-6 py-3 font-bold {{ $deltaClass }}">
                                        {{ $deltaSign }}{{ $delta }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // --- DATA DARI CONTROLLER ---
            const categories = @json($categories);
            const dataPost = @json(array_values($statsPost));
            const dataLulus = @json(array_values($statsLulus)); // [Jumlah Lulus, Jumlah Tidak Lulus]

            // --- 1. BAR CHART (Horizontal) ---
            const ctxBar = document.getElementById('barChartPost').getContext('2d');
            new Chart(ctxBar, {
                type: 'bar', // Gunakan 'bar' dengan indexAxis 'y' untuk horizontal
                data: {
                    labels: categories,
                    datasets: [{
                        label: 'Jumlah Praktikan',
                        data: dataPost,
                        backgroundColor: [
                            'rgba(34, 197, 94, 0.7)', // Sangat Baik (Green)
                            'rgba(59, 130, 246, 0.7)', // Baik (Blue)
                            'rgba(234, 179, 8, 0.7)', // Cukup (Yellow)
                            'rgba(249, 115, 22, 0.7)', // Kurang (Orange)
                            'rgba(239, 68, 68, 0.7)', // Sangat Kurang (Red)
                            'rgba(156, 163, 175, 0.5)' // Tidak Ada Nilai (Gray)
                        ],
                        borderColor: [
                            'rgb(34, 197, 94)',
                            'rgb(59, 130, 246)',
                            'rgb(234, 179, 8)',
                            'rgb(249, 115, 22)',
                            'rgb(239, 68, 68)',
                            'rgb(156, 163, 175)'
                        ],
                        borderWidth: 1,
                        barPercentage: 0.6
                    }]
                },
                options: {
                    indexAxis: 'y', // MENJADIKAN SUMBU X ANGKA, SUMBU Y KATEGORI
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            },
                            title: {
                                display: true,
                                text: 'Jumlah Praktikan'
                            }
                        }
                    }
                }
            });

            // --- 2. PIE CHART ---
            const ctxPie = document.getElementById('pieChartLulus').getContext('2d');
            new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: ['LULUS', 'TIDAK LULUS'],
                    datasets: [{
                        data: dataLulus,
                        backgroundColor: [
                            'rgba(34, 197, 94, 0.8)', // Lulus (Green)
                            'rgba(239, 68, 68, 0.8)' // Tidak Lulus (Red)
                        ],
                        borderColor: ['#fff', '#fff'],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
