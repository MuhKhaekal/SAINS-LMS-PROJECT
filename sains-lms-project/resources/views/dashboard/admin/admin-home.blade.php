@extends('dashboard.admin.admin-base')

@section('page-title', 'Dashboard Utama')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-14 md:mt-0">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Selamat Datang, {{ auth()->user()->nama }}! 👋</h1>
        <p class="text-gray-500 mt-2">Berikut adalah ringkasan aktivitas sistem Halaqah hari ini.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Total Asisten</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['asisten'] }}</p>
            </div>
            <div class="p-3 bg-blue-50 rounded-full text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Total Praktikan</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['praktikan'] }}</p>
            </div>
            <div class="p-3 bg-green-50 rounded-full text-green-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-indigo-500 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Halaqah Aktif</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['halaqah'] }}</p>
            </div>
            <div class="p-3 bg-indigo-50 rounded-full text-indigo-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Kelas PAI</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['kelas'] }}</p>
            </div>
            <div class="p-3 bg-purple-50 rounded-full text-purple-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 lg:col-span-1">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Komposisi Kehadiran</h3>
            <div class="relative h-64">
                <canvas id="chartPresence"></canvas>
            </div>
            <div class="mt-4 flex justify-center gap-4 text-xs text-gray-500">
                <div class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-green-500"></span> Hadir</div>
                <div class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-blue-500"></span> Izin</div>
                <div class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-red-500"></span> Alfa</div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 lg:col-span-2">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Sebaran Halaqah per Fakultas</h3>
            <div class="relative h-64">
                <canvas id="chartFaculty"></canvas>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                <h3 class="font-bold text-gray-800">Presensi Terbaru</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentPresences as $presence)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-3">
                                    <p class="font-medium text-gray-900">{{ $presence->user->nama ?? 'User Hapus' }}</p>
                                    <p class="text-xs text-gray-500">{{ $presence->user->nim ?? '-' }}</p>
                                </td>
                                <td class="px-6 py-3">
                                    <p class="text-xs text-gray-500">Halaqah</p>
                                    <p class="font-medium text-gray-800 text-xs">{{ Str::limit($presence->halaqah->halaqah_name ?? '-', 20) }}</p>
                                </td>
                                <td class="px-6 py-3 text-right">
                                    <span class="px-2 py-1 rounded-full text-[10px] font-bold uppercase
                                        {{ $presence->status == 'hadir' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $presence->status == 'izin' ? 'bg-blue-100 text-blue-700' : '' }}
                                        {{ $presence->status == 'alfa' ? 'bg-red-100 text-red-700' : '' }}
                                        {{ $presence->status == 'sakit' ? 'bg-yellow-100 text-yellow-700' : '' }}">
                                        {{ $presence->status }}
                                    </span>
                                    <p class="text-[10px] text-gray-400 mt-1">{{ $presence->created_at->diffForHumans() }}</p>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="px-6 py-8 text-center text-gray-500">Belum ada data presensi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h3 class="font-bold text-gray-800">Top Asisten (Beban Ajar)</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-3">Nama Asisten</th>
                            <th class="px-6 py-3 text-center">Jml Halaqah</th>
                            <th class="px-6 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($topAsisten as $asisten)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-3 flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-bold">
                                        {{ substr($asisten->nama, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $asisten->nama }}</p>
                                        <p class="text-xs text-gray-500">{{ $asisten->nim }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-3 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-indigo-100 text-indigo-800">
                                        {{ $asisten->halaqahs_count }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-right">
                                    <a href="{{ route('daftar-pengguna.show', $asisten->id) }}" class="text-indigo-600 hover:text-indigo-900 text-xs font-bold hover:underline">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="px-6 py-8 text-center text-gray-500">Belum ada data asisten.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        const ctxPresence = document.getElementById('chartPresence').getContext('2d');
        new Chart(ctxPresence, {
            type: 'doughnut',
            data: {
                labels: ['Hadir', 'Izin', 'Sakit', 'Alfa'],
                datasets: [{
                    data: @json($chartPresence),
                    backgroundColor: ['#10b981', '#3b82f6', '#f59e0b', '#ef4444'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false } 
                }
            }
        });

        const ctxFaculty = document.getElementById('chartFaculty').getContext('2d');
        new Chart(ctxFaculty, {
            type: 'bar',
            data: {
                labels: @json($labelsFakultas),
                datasets: [{
                    label: 'Jumlah Halaqah',
                    data: @json($dataFakultas),
                    backgroundColor: '#6366f1',
                    borderRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, grid: { display: false } },
                    x: { grid: { display: false } }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    });
</script>
@endsection