@extends('dashboard.admin.admin-base')

@section('page-title', 'Detail Fakultas')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-14 md:mt-0">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail Fakultas</h1>
            <p class="text-sm text-gray-500 mt-1">
                Informasi statistik untuk <span class="font-semibold text-indigo-600">{{ $faculty->faculty_name }}</span>.
            </p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('daftar-fakultas.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-50 transition">
                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-indigo-100">
            <p class="text-xs font-bold text-indigo-500 uppercase tracking-wider">Program Studi</p>
            <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalProdi }}</h3>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-green-100">
            <p class="text-xs font-bold text-green-600 uppercase tracking-wider">Total Halaqah</p>
            <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalHalaqah }}</h3>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-blue-100">
            <p class="text-xs font-bold text-blue-600 uppercase tracking-wider">Total Asisten</p>
            <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalAsisten }}</h3>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-purple-100">
            <p class="text-xs font-bold text-purple-600 uppercase tracking-wider">Total Praktikan</p>
            <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalPraktikan }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden min-h-[500px]">        
        <div class="flex border-b border-gray-200 overflow-x-auto">
            <button onclick="switchTab('prodi')" id="tab-btn-prodi" class="tab-btn px-6 py-4 text-sm font-bold text-indigo-600 border-b-2 border-indigo-600 hover:bg-gray-50 transition whitespace-nowrap">
                Daftar Prodi
            </button>
            <button onclick="switchTab('halaqah')" id="tab-btn-halaqah" class="tab-btn px-6 py-4 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:bg-gray-50 transition whitespace-nowrap">
                Daftar Halaqah
            </button>
            <button onclick="switchTab('asisten')" id="tab-btn-asisten" class="tab-btn px-6 py-4 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:bg-gray-50 transition whitespace-nowrap">
                Daftar Asisten
            </button>
            <button onclick="switchTab('praktikan')" id="tab-btn-praktikan" class="tab-btn px-6 py-4 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:bg-gray-50 transition whitespace-nowrap">
                Daftar Praktikan
            </button>
        </div>

        <div id="tab-content-prodi" class="tab-content animate-fade-in">
            <div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-semibold">
                            <tr>
                                <th class="px-6 py-3 w-10 text-center">No</th>
                                <th class="px-6 py-3 w-32">Kode</th>
                                <th class="px-6 py-3">Nama Prodi</th>
                                <th class="px-6 py-3 text-center">Jml Halaqah</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($faculty->prodies as $index => $prodi)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-center text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 font-mono text-gray-600">{{ $prodi->prodi_code }}</td>
                                    <td class="px-6 py-4 font-bold text-gray-800">{{ $prodi->prodi_name }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                            {{ $prodi->halaqahs_count }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-6 py-8 text-center text-gray-500 italic">Belum ada Prodi.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="lg:col-span-1">
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                        <h4 class="text-xs font-bold text-gray-500 uppercase text-center mb-4">Top 5 Prodi Teraktif</h4>
                        <div class="relative h-48"><canvas id="chartHalaqah"></canvas></div>
                    </div>
                </div>
            </div>
        </div>

        <div id="tab-content-halaqah" class="tab-content hidden animate-fade-in">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-semibold">
                        <tr>
                            <th class="px-6 py-3 text-center w-10">No</th>
                            <th class="px-6 py-3">Nama Halaqah</th>
                            <th class="px-6 py-3">Kode</th>
                            <th class="px-6 py-3 text-center">Tipe</th>
                            <th class="px-6 py-3">Program Studi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($listHalaqah as $index => $hal)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-center text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $hal->halaqah_name }}</td>
                                <td class="px-6 py-4 font-mono text-xs text-gray-500">{{ $hal->halaqah_code }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-2 py-1 bg-indigo-50 text-indigo-700 rounded text-[10px] font-bold border border-indigo-100">{{ $hal->halaqah_type }}</span>
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $hal->prodi->prodi_name ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-6 py-8 text-center text-gray-500 italic">Belum ada Halaqah.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div id="tab-content-asisten" class="tab-content hidden animate-fade-in">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-semibold">
                        <tr>
                            <th class="px-6 py-3 text-center w-10">No</th>
                            <th class="px-6 py-3">Nama Asisten</th>
                            <th class="px-6 py-3">NIM</th>
                            <th class="px-6 py-3">Mengajar di Halaqah</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($listAsisten as $index => $asisten)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-center text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold">{{ substr($asisten->nama, 0, 1) }}</div>
                                        <span class="font-medium text-gray-900">{{ $asisten->nama }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-mono text-xs text-gray-500">{{ $asisten->nim }}</td>
                                <td class="px-6 py-4 text-xs text-gray-600">
                                    {{ $asisten->halaqahs->pluck('halaqah_name')->join(', ') ?: 'Belum ada' }}
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-6 py-8 text-center text-gray-500 italic">Belum ada Asisten.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div id="tab-content-praktikan" class="tab-content hidden animate-fade-in">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-semibold">
                        <tr>
                            <th class="px-6 py-3 text-center w-10">No</th>
                            <th class="px-6 py-3">Nama Praktikan</th>
                            <th class="px-6 py-3">NIM</th>
                            <th class="px-6 py-3">Halaqah</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($listPraktikan as $index => $praktikan)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-center text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $praktikan->nama }}</td>
                                <td class="px-6 py-4 font-mono text-xs text-gray-500">{{ $praktikan->nim }}</td>
                                <td class="px-6 py-4 text-xs text-gray-600">
                                    {{ $praktikan->halaqahs->first()->halaqah_name ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-6 py-8 text-center text-gray-500 italic">Belum ada Praktikan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($listPraktikan->count() >= 500)
                <div class="p-4 text-center text-xs text-gray-400 bg-gray-50 border-t border-gray-200">
                    Menampilkan 500 data pertama. Gunakan pencarian untuk hasil spesifik.
                </div>
            @endif
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    document.addEventListener('DOMContentLoaded', function() {
        switchTab('prodi');

        const ctx = document.getElementById('chartHalaqah');
        if(ctx) {
            new Chart(ctx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        data: @json($chartData),
                        backgroundColor: ['#6366f1', '#10b981', '#3b82f6', '#f59e0b', '#ef4444'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'right', labels: { boxWidth: 10, font: { size: 9 } } } }
                }
            });
        }
    });
</script>

<style>
    @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fadeIn 0.2s ease-out forwards; }
</style>
@endsection