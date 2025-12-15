@extends('dashboard.asisten.asisten-base')
@section('page-title', 'Akumulasi Nilai')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8 md:mt-24">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Akumulasi Nilai</h1>
                <div class="flex items-center gap-2 mt-1 text-sm text-gray-500">
                    <span>{{ $selectedHalaqah->halaqah_name }}</span>
                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <span class="font-medium text-gray-700">Rekapitulasi Akhir</span>
                </div>
            </div>
            <div>
                <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex items-start gap-4 relative group">
                <div class="p-2 bg-indigo-50 text-indigo-600 rounded-lg shrink-0 mt-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <div class="flex-1 min-w-0 pr-6">
                    <p class="text-xs text-gray-500 font-medium uppercase mb-0.5">Kelas PAI</p>
                    <p class="text-sm font-bold text-gray-800 break-words leading-tight">{{ $linkedClass->class_name }}</p>
                </div>
                
                <form action="{{ route('akumulasi-nilai.reset', $selectedHalaqah->id) }}" method="POST"
                    class="absolute right-2 top-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="halaqah_name" value="{{ $selectedHalaqah->halaqah_name }}">
                    <button type="submit" class="p-1 text-gray-400 hover:text-red-600 bg-white hover:bg-red-50 rounded border border-gray-200 transition-colors shadow-sm" title="Lepas Kelas">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </form>
            </div>

            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex items-start gap-4">
                <div class="p-2 bg-blue-50 text-blue-600 rounded-lg shrink-0 mt-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs text-gray-500 font-medium uppercase mb-0.5">Fakultas</p>
                    <p class="text-sm font-bold text-gray-800 break-words leading-tight">{{ $selectedHalaqah->prodi->faculty->faculty_name ?? '-' }}</p>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex items-start gap-4">
                <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg shrink-0 mt-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs text-gray-500 font-medium uppercase mb-0.5">Program Studi</p>
                    <p class="text-sm font-bold text-gray-800 break-words leading-tight">{{ $selectedHalaqah->prodi->prodi_name ?? '-' }}</p>
                </div>
            </div>

            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex items-start gap-4">
                <div class="p-2 bg-orange-50 text-orange-600 rounded-lg shrink-0 mt-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs text-gray-500 font-medium uppercase mb-0.5">Dosen Pengampu</p>
                    <p class="text-sm font-bold text-gray-800 break-words leading-tight">{{ $linkedClass->lecturer }}</p>
                </div>
            </div>
        </div>

        <div class="mb-12">
            <div class="flex items-center gap-2 mb-4">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <h2 class="text-lg font-bold text-gray-800">Laporan Nilai</h2>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-xs text-left whitespace-nowrap">
                        <thead class="bg-gray-50 text-gray-600 uppercase font-semibold text-center border-b border-gray-200">
                            <tr>
                                <th rowspan="2" class="px-3 py-3 border-r border-gray-200 sticky left-0 bg-gray-50 w-10">No</th>
                                <th rowspan="2" class="px-3 py-3 border-r border-gray-200 sticky left-10 bg-gray-50 text-left w-24 shadow-[2px_0_5px_-2px_rgba(0,0,0,0.05)]">NIM</th>
                                <th rowspan="2" class="px-3 py-3 border-r border-gray-200 bg-gray-50 text-left min-w-[180px] shadow-[2px_0_5px_-2px_rgba(0,0,0,0.05)]">Nama</th>

                                <th colspan="5" class="px-2 py-2 border-r border-gray-200 border-t-2 border-sky-300 bg-sky-50 text-sky-700">Pre-Test</th>
                                <th colspan="6" class="px-2 py-2 border-r border-gray-200 border-t-2 border-emerald-300 bg-emerald-50 text-emerald-700">Pertemuan Pekanan</th>
                                <th colspan="5" class="px-2 py-2 border-r border-gray-200 border-t-2 border-indigo-300 bg-indigo-50 text-indigo-700">Post-Test</th>
                                
                                <th rowspan="2" class="px-3 py-3 bg-slate-100 text-slate-700 border-t-2 border-slate-300">Final</th>
                            </tr>
                            <tr>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-sky-50/50 text-sky-700 font-medium">K</th>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-sky-50/50 text-sky-700 font-medium">HB</th>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-sky-50/50 text-sky-700 font-medium">MH</th>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-sky-100 text-sky-800 font-bold">Hasil</th>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-sky-50/50 text-sky-700 font-medium">Ket</th>

                                @for($i=1; $i<=6; $i++)
                                    <th class="px-2 py-1.5 border-r border-gray-200 bg-emerald-50/50 text-emerald-700 w-10 font-medium">{{ $i }}</th>
                                @endfor

                                <th class="px-2 py-1.5 border-r border-gray-200 bg-indigo-50/50 text-indigo-700 font-medium">K</th>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-indigo-50/50 text-indigo-700 font-medium">HB</th>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-indigo-50/50 text-indigo-700 font-medium">MH</th>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-indigo-50/50 text-indigo-800 font-bold">Hasil</th>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-indigo-50/50 text-indigo-700 font-medium">Ket</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 text-gray-700 text-center bg-white">
                            @forelse ($praktikans as $index => $p)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-3 py-2 border-r border-gray-100 sticky left-0 bg-white hover:bg-gray-50">{{ $index + 1 }}</td>
                                    <td class="px-3 py-2 border-r border-gray-100 font-mono text-xs sticky left-10 bg-white hover:bg-gray-50 text-left shadow-[2px_0_5px_-2px_rgba(0,0,0,0.05)]">{{ $p->nim }}</td>
                                    <td class="px-3 py-2 border-r border-gray-100 text-left font-medium bg-white hover:bg-gray-50 shadow-[2px_0_5px_-2px_rgba(0,0,0,0.05)] truncate max-w-[150px]" title="{{ $p->nama }}">{{ $p->nama }}</td>

                                    <td class="px-2 py-2 border-r border-gray-100 bg-sky-50/10">{{ $p->pre_kbq }}</td>
                                    <td class="px-2 py-2 border-r border-gray-100 bg-sky-50/10">{{ $p->pre_hb }}</td>
                                    <td class="px-2 py-2 border-r border-gray-100 bg-sky-50/10">{{ $p->pre_mh }}</td>
                                    <td class="px-2 py-2 border-r border-gray-100 bg-sky-50/20 font-bold text-sky-700">{{ $p->pre_hasil }}</td>
                                    <td class="px-2 py-2 border-r border-gray-100 bg-sky-50/10 text-[10px]">{{ $p->pre_ket }}</td>

                                    <td class="px-2 py-2 border-r border-gray-100">{{ $p->score1 }}</td>
                                    <td class="px-2 py-2 border-r border-gray-100">{{ $p->score2 }}</td>
                                    <td class="px-2 py-2 border-r border-gray-100">{{ $p->score3 }}</td>
                                    <td class="px-2 py-2 border-r border-gray-100">{{ $p->score4 }}</td>
                                    <td class="px-2 py-2 border-r border-gray-100">{{ $p->score5 }}</td>
                                    <td class="px-2 py-2 border-r border-gray-100">{{ $p->score6 }}</td>

                                    <td class="px-2 py-2 border-r border-gray-100 bg-indigo-50/10">{{ $p->post_kbq }}</td>
                                    <td class="px-2 py-2 border-r border-gray-100 bg-indigo-50/10">{{ $p->post_hb }}</td>
                                    <td class="px-2 py-2 border-r border-gray-100 bg-indigo-50/10">{{ $p->post_mh }}</td>
                                    <td class="px-2 py-2 border-r border-gray-100 bg-indigo-50/20 font-bold text-indigo-700">{{ $p->post_hasil }}</td>
                                    <td class="px-2 py-2 border-r border-gray-100 bg-indigo-50/10 text-[10px]">{{ $p->post_ket }}</td>

                                    <td class="px-3 py-2 font-bold bg-slate-50 text-slate-800">{{ $p->final_score }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="20" class="px-6 py-8 text-center text-gray-500 italic">Belum ada data praktikan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div>
            <div class="flex items-center gap-2 mb-4">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h2 class="text-lg font-bold text-gray-800">Laporan Kelulusan Akhir</h2>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-xs text-left whitespace-nowrap">
                        <thead class="bg-gray-50 text-gray-600 uppercase font-semibold text-center border-b border-gray-200">
                            <tr>
                                <th rowspan="2" class="px-3 py-3 border-r border-gray-200 sticky left-0 bg-gray-50 w-10 ">No</th>
                                <th rowspan="2" class="px-3 py-3 border-r border-gray-200 sticky left-10 bg-gray-50 text-left w-24 shadow-[2px_0_5px_-2px_rgba(0,0,0,0.05)]">NIM</th>
                                <th rowspan="2" class="px-3 py-3 border-r border-gray-200 bg-gray-50 text-left min-w-[150px] shadow-[2px_0_5px_-2px_rgba(0,0,0,0.05)]">Nama</th>

                                <th colspan="3" class="px-2 py-2 border-r border-gray-200 border-t-2 border-slate-300 bg-slate-50 text-slate-700">Persentase</th>
                                <th rowspan="2" class="px-3 py-2 border-r border-gray-200 bg-indigo-50 border-t-2 border-indigo-300 text-indigo-700 w-20">Nilai<br>Akhir</th>
                                <th colspan="2" class="px-2 py-2 border-r border-gray-200 border-t-2 border-sky-300 bg-sky-50 text-sky-700">Perkembangan KBQ</th>
                                <th rowspan="2" class="px-3 py-2 border-r border-gray-200 bg-emerald-50 border-t-2 border-emerald-300 text-emerald-700 w-24">Kehadiran</th>
                                <th rowspan="2" class="px-3 py-2 border-t-2 border-rose-300 bg-rose-50 text-rose-700 w-24">Status</th>
                            </tr>
                            <tr>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-slate-50 text-slate-600 w-16">KBQ (30%)</th>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-slate-50 text-slate-600 w-16">Hdr (50%)</th>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-slate-50 text-slate-600 w-16">Final (20%)</th>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-sky-50/50 text-sky-700 w-20">PRETEST</th>
                                <th class="px-2 py-1.5 border-r border-gray-200 bg-sky-50/50 text-sky-700 w-20">POSTTEST</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 text-gray-700 text-center bg-white">
                            @forelse ($praktikans as $index => $p)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-3 py-2 border-r border-gray-100 sticky left-0 bg-white hover:bg-gray-50">{{ $index + 1 }}</td>
                                    <td class="px-3 py-2 border-r border-gray-100 font-mono sticky left-10 bg-white hover:bg-gray-50 text-left shadow-[2px_0_5px_-2px_rgba(0,0,0,0.05)]">{{ $p->nim }}</td>
                                    <td class="px-3 py-2 border-r border-gray-100 text-left font-medium bg-white hover:bg-gray-50 shadow-[2px_0_5px_-2px_rgba(0,0,0,0.05)] truncate max-w-[150px]" title="{{ $p->nama }}">{{ $p->nama }}</td>

                                    <td class="px-2 py-2 border-r border-gray-100">{{ number_format($p->val_kbq_30, 2) }}</td>
                                    <td class="px-2 py-2 border-r border-gray-100">{{ number_format($p->val_absen_50, 2) }}</td>
                                    <td class="px-2 py-2 border-r border-gray-100">{{ number_format($p->val_final_20, 2) }}</td>
                                    
                                    <td class="px-3 py-2 border-r border-gray-100 font-bold text-indigo-700 bg-indigo-50/30">
                                        {{ number_format($p->val_total, 2) }}
                                    </td>

                                    <td class="px-2 py-2 border-r border-gray-100 text-[10px] font-medium bg-sky-50/10">{{ $p->pre_ket }}</td>
                                    <td class="px-2 py-2 border-r border-gray-100 text-[10px] font-medium bg-sky-50/10">{{ $p->post_ket }}</td>

                                    <td class="px-3 py-2 border-r border-gray-100">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold 
                                            {{ $p->ket_absen == 'AKTIF' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                            {{ $p->ket_absen }}
                                        </span>
                                    </td>

                                    <td class="px-3 py-2">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold 
                                            {{ $p->ket_lulus == 'LULUS' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $p->ket_lulus }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="px-6 py-8 text-center text-gray-500 italic">Belum ada data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection