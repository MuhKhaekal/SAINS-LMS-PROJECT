@extends('dashboard.admin.admin-base')

@section('page-title', 'Detail Halaqah')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-14 md:mt-0">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Detail Halaqah</h1>
                <p class="text-sm text-gray-500 mt-1">Monitoring kegiatan belajar mengajar.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('daftar-halaqah.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-50 transition">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>

            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-indigo-100 p-6 mb-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-indigo-50 rounded-full blur-3xl opacity-50"></div>

            <div class="flex flex-col md:flex-row gap-8 relative z-10">
                <div class="shrink-0 flex flex-col items-center">
                    <div
                        class="w-20 h-20 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white flex items-center justify-center shadow-lg mb-3">
                        <span class="text-2xl font-bold">{{ substr($halaqah->halaqah_name, 0, 2) }}</span>
                    </div>
                    <span
                        class="px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-bold uppercase tracking-wide rounded-full border border-indigo-100">
                        {{ $halaqah->halaqah_type }}
                    </span>
                </div>

                <div class="flex-1 space-y-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">{{ $halaqah->halaqah_name }}</h2>
                        <div class="flex items-center gap-2 mt-1">

                            @foreach ($halaqah->classPais as $classPai)
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                    <span class="font-bold me-1">KELAS PAI: </span> {{ $classPai->class_name }}
                                </span>
                            @endforeach

                            @if ($halaqah->classPais->isEmpty())
                                <span class="text-xs text-gray-400 italic">(Belum masuk kelas)</span>
                            @endif
                        </div>
                        <p class="text-sm text-gray-500 font-mono mt-1">Kode: {{ $halaqah->halaqah_code }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-start gap-3">
                            <div
                                class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold">Asisten Pengajar</p>
                                @if ($asisten)
                                    <p class="font-medium text-gray-900">{{ $asisten->nama }}</p>
                                    <p class="text-xs text-gray-400">{{ $asisten->nim }}</p>
                                @else
                                    <p class="text-sm text-red-500 italic">Belum ada asisten</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div
                                class="w-8 h-8 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold">Program Studi </p>
                                <p class="font-medium text-gray-900">{{ $halaqah->prodi->prodi_name ?? '-' }}</p>
                                <p class="text-xs text-gray-400">{{ $halaqah->prodi->faculty->faculty_name ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="w-full md:w-auto border-t md:border-t-0 md:border-l border-gray-100 pt-4 md:pt-0 md:pl-8 flex flex-row md:flex-col justify-around md:justify-center gap-6">
                    <div class="text-center md:text-right">
                        <span class="block text-2xl font-bold text-gray-800">{{ $totalPraktikan }}</span>
                        <span class="text-xs text-gray-500 font-bold uppercase">Praktikan</span>
                    </div>
                    <div class="text-center md:text-right">
                        <span class="block text-2xl font-bold text-gray-800">{{ $totalPertemuan }}</span>
                        <span class="text-xs text-gray-500 font-bold uppercase">Pertemuan</span>
                    </div>
                    <div class="text-center md:text-right">
                        <span
                            class="block text-2xl font-bold {{ $avgKehadiran > 80 ? 'text-green-600' : 'text-yellow-600' }}">
                            {{ number_format($avgKehadiran, 0) }}%
                        </span>
                        <span class="text-xs text-gray-500 font-bold uppercase">Kehadiran</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden min-h-[500px]">
            <div class="flex border-b border-gray-200 overflow-x-auto">
                <button onclick="switchTab('praktikan')" id="tab-btn-praktikan"
                    class="tab-btn px-6 py-4 text-sm font-bold text-indigo-600 border-b-2 border-indigo-600 hover:bg-gray-50 transition">
                    Daftar Peserta
                </button>
                <button onclick="switchTab('meeting')" id="tab-btn-meeting"
                    class="tab-btn px-6 py-4 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:bg-gray-50 transition">
                    Riwayat Pertemuan
                </button>
            </div>

            <div id="tab-content-praktikan" class="tab-content animate-fade-in">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-semibold">
                            <tr>
                                <th class="px-6 py-3 w-10 text-center">No</th>
                                <th class="px-6 py-3">Nama Lengkap</th>
                                <th class="px-6 py-3">NIM</th>
                                <th class="px-6 py-3 text-center">Kehadiran</th>
                                <th class="px-6 py-3 w-32 text-center">Persentase</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($praktikans as $index => $p)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-center text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $p->nama }}</td>
                                    <td class="px-6 py-4 font-mono text-gray-500">{{ $p->nim }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="font-bold text-gray-700">{{ $p->jumlah_hadir }}</span>
                                        <span class="text-gray-400 text-xs">/ {{ $totalPertemuan }}</span>
                                    </td>
                                    <td class="px-6 py-4 align-middle">
                                        <div class="flex items-center gap-2">
                                            <div class="w-full bg-gray-200 rounded-full h-1.5">
                                                <div class="h-1.5 rounded-full {{ $p->persentase >= 80 ? 'bg-green-500' : ($p->persentase >= 50 ? 'bg-yellow-400' : 'bg-red-500') }}"
                                                    style="width: {{ $p->persentase }}%"></div>
                                            </div>
                                            <span
                                                class="text-xs font-bold text-gray-600 w-8">{{ number_format($p->persentase, 0) }}%</span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 italic">Belum ada
                                        praktikan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="tab-content-meeting" class="tab-content hidden animate-fade-in">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-semibold">
                            <tr>
                                <th class="px-6 py-3 w-10 text-center">No</th>
                                <th class="px-6 py-3">Topik / Judul</th>
                                <th class="px-6 py-3 text-center">Tipe</th>
                                <th class="px-6 py-3">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($meetings as $index => $meet)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-center text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4">
                                        <span class="block font-medium text-gray-900">{{ $meet->meeting_name }}</span>
                                        <span
                                            class="text-xs text-gray-400 truncate max-w-xs block">{{ $meet->description }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="px-2 py-1 rounded text-[10px] font-bold uppercase border {{ $meet->type == 'skk' ? 'bg-blue-50 text-blue-700 border-blue-200' : 'bg-gray-50 text-gray-600 border-gray-200' }}">
                                            {{ $meet->type }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 text-xs">
                                        {{ \Carbon\Carbon::parse($meet->date)->format('d M Y, H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 italic">Belum ada
                                        riwayat pertemuan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>


        </div>

    </div>

    <script>
        function switchTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.getElementById('tab-content-' + tabName).classList.remove('hidden');

            document.querySelectorAll('.tab-btn').forEach(el => {
                el.classList.remove('text-indigo-600', 'border-indigo-600', 'font-bold');
                el.classList.add('text-gray-500', 'border-transparent', 'font-medium');
            });

            const btn = document.getElementById('tab-btn-' + tabName);
            btn.classList.remove('text-gray-500', 'border-transparent', 'font-medium');
            btn.classList.add('text-indigo-600', 'border-indigo-600', 'font-bold');
        }
        document.addEventListener('DOMContentLoaded', () => {
            switchTab('praktikan');
        });
    </script>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.2s ease-out forwards;
        }
    </style>
@endsection
