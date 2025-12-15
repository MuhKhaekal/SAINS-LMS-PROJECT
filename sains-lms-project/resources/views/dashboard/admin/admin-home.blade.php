@extends('dashboard.admin.admin-base')
@section('page-title', 'Executive Dashboard')

@section('content')
<div class="max-w-[98%] mx-auto px-4 py-8">

    {{-- 1. HEADER & DATE FILTER --}}
    <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Eksekutif</h1>
            <p class="text-gray-500 mt-1">Ringkasan statistik akademik dan aktivitas pengguna SAINS.</p>
        </div>
        <div class="flex items-center gap-2 bg-white p-1 rounded-lg border border-gray-200 shadow-sm">
            <span class="px-3 text-xs font-semibold text-gray-500">Tahun Ajaran:</span>
            <select class="text-sm border-none focus:ring-0 text-gray-700 font-bold bg-transparent cursor-pointer">
                <option>2023/2024 Ganjil</option>
                <option>2023/2024 Genap</option>
            </select>
        </div>
    </div>

    {{-- 2. KPI CARDS (Statistik Utama) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Card: Total User --}}
        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between h-32 relative overflow-hidden group">
            <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                <svg class="w-16 h-16 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase">Total Pengguna</p>
                <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalUsers ?? 0 }}</h3>
            </div>
            <div class="flex items-center gap-2 text-xs font-medium text-gray-500">
                <span class="bg-blue-100 text-blue-700 px-1.5 py-0.5 rounded">{{ $newUsersThisMonth ?? 0 }} Baru</span> bulan ini
            </div>
        </div>

        {{-- Card: Total Halaqah --}}
        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between h-32 relative overflow-hidden group">
            <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                <svg class="w-16 h-16 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase">Total Halaqah</p>
                <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalHalaqah ?? 0 }}</h3>
            </div>
            <div class="flex items-center gap-2 text-xs font-medium text-gray-500">
                <span class="text-emerald-600 font-bold">{{ $activeHalaqah ?? 0 }}</span> Kelompok Aktif
            </div>
        </div>

        {{-- Card: Rata-rata Nilai --}}
        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between h-32 relative overflow-hidden group">
            <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                <svg class="w-16 h-16 text-purple-600" fill="currentColor" viewBox="0 0 20 20"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase">Rata-rata Nilai Akhir</p>
                <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ number_format($globalAvgScore ?? 0, 1) }}</h3>
            </div>
            <div class="flex items-center gap-2 text-xs font-medium text-gray-500">
                @if(($scoreImprovement ?? 0) > 0)
                    <span class="text-green-600 flex items-center">
                        <svg class="w-3 h-3 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                        +{{ $scoreImprovement }}%
                    </span> 
                @else
                    <span class="text-gray-400">-</span>
                @endif
                dari semester lalu
            </div>
        </div>

        {{-- Card: Kehadiran --}}
        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between h-32 relative overflow-hidden group">
            <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                <svg class="w-16 h-16 text-orange-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase">Tingkat Kehadiran</p>
                <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{ $globalAttendanceRate ?? 0 }}%</h3>
            </div>
            <div class="w-full bg-gray-100 rounded-full h-1.5 mt-2">
                <div class="bg-orange-500 h-1.5 rounded-full" style="width: {{ $globalAttendanceRate ?? 0 }}%"></div>
            </div>
        </div>
    </div>

    {{-- 3. CHARTS ROW 1 (Demografi & Sebaran) --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        
        {{-- Chart: Sebaran Praktikan per Fakultas/Prodi --}}
        <div class="lg:col-span-2 bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-gray-800">Distribusi Praktikan per Fakultas</h3>
                <button class="text-xs text-indigo-600 font-bold hover:underline">Lihat Detail</button>
            </div>
            {{-- Tempat Chart --}}
            <div id="chart-faculty-dist" class="h-80 w-full"></div>
        </div>

        {{-- Chart: Komposisi Gender (Donut) --}}
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
            <h3 class="font-bold text-gray-800 mb-4">Komposisi Gender</h3>
            {{-- Tempat Chart --}}
            <div id="chart-gender" class="h-64 flex justify-center"></div>
            
            <div class="mt-4 grid grid-cols-2 gap-4 text-center">
                <div class="p-2 bg-blue-50 rounded-lg">
                    <span class="block text-xs text-gray-500">Laki-laki</span>
                    <span class="font-bold text-blue-700 text-lg">{{ $maleCount ?? 0 }}</span>
                </div>
                <div class="p-2 bg-pink-50 rounded-lg">
                    <span class="block text-xs text-gray-500">Perempuan</span>
                    <span class="font-bold text-pink-700 text-lg">{{ $femaleCount ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- 4. CHARTS ROW 2 (Performa Akademik) --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        
        {{-- Chart: Perbandingan Pre-Test vs Post-Test (Bar/Area) --}}
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
            <h3 class="font-bold text-gray-800 mb-2">Efektivitas Pembelajaran (Pre vs Post Test)</h3>
            <p class="text-xs text-gray-500 mb-4">Rata-rata nilai berdasarkan Fakultas</p>
            <div id="chart-performance" class="h-80 w-full"></div>
        </div>

        {{-- Chart: Tren Aktivitas Mingguan (Line) --}}
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
            <h3 class="font-bold text-gray-800 mb-2">Tren Pengumpulan Tugas & Absensi</h3>
            <p class="text-xs text-gray-500 mb-4">Aktivitas dalam 6 pekan terakhir</p>
            <div id="chart-activity" class="h-80 w-full"></div>
        </div>
    </div>

    {{-- 5. RECENT ACTIVITY TABLE --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="font-bold text-gray-800">Halaqah Baru Ditambahkan</h3>
            <a href="#" class="text-sm text-indigo-600 font-medium hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-500 font-semibold text-xs uppercase">
                    <tr>
                        <th class="px-6 py-3">Nama Halaqah</th>
                        <th class="px-6 py-3">Prodi</th>
                        <th class="px-6 py-3">Pembina (Asisten)</th>
                        <th class="px-6 py-3 text-center">Jumlah Praktikan</th>
                        <th class="px-6 py-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recentHalaqahs ?? [] as $h)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $h->halaqah_name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $h->prodi->prodi_name ?? '-' }}</td>
                            <td class="px-6 py-4 text-gray-600">
                                {{-- Mengambil user pertama dari pivot (asumsi role asisten) atau logic lain --}}
                                {{ $h->users->where('role', 'asisten')->first()->nama ?? 'Belum ada' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="bg-gray-100 text-gray-700 py-1 px-2 rounded-lg text-xs font-bold">
                                    {{ $h->users_count ?? 0 }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-green-600 text-xs font-bold bg-green-50 px-2 py-1 rounded-full">Aktif</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-400 italic">Tidak ada data terbaru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- SCRIPT UNTUK CHARTS (APEXCHARTS) --}}
{{-- Pastikan Anda sudah include CDN ApexCharts di layout utama (admin-base) --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}

{{-- SCRIPT UNTUK CHARTS (APEXCHARTS) --}}
{{-- Pastikan CDN ApexCharts sudah ada di layout utama --}}
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        
        // --- 1. PERSIAPAN DATA (Agar Blade tidak error parsing array) ---
        // Kita gunakan tag PHP untuk menangani default value array
        
        // Data Fakultas
        var dataFacultyNames = {!! json_encode($facultyNames ?? ['Fatek', 'Fekon', 'Fisip', 'Hukum', 'Kedokteran']) !!};
        var dataFacultyCounts = {!! json_encode($facultyCounts ?? [120, 90, 80, 70, 150]) !!};

        // Data Gender
        var countMale = {{ $maleCount ?? 450 }};
        var countFemale = {{ $femaleCount ?? 550 }};

        // Data Performance
        var dataPreTest = {!! json_encode($preTestAvg ?? [60, 65, 55, 70, 62]) !!};
        var dataPostTest = {!! json_encode($postTestAvg ?? [85, 88, 80, 90, 85]) !!};

        // --- 2. RENDER CHART ---

        // A. CHART: Distribusi Fakultas (Bar Chart)
        var optionsFaculty = {
            series: [{
                name: 'Jumlah Praktikan',
                data: dataFacultyCounts
            }],
            chart: {
                type: 'bar',
                height: 320,
                toolbar: { show: false },
                fontFamily: 'inherit'
            },
            colors: ['#4F46E5'], // Indigo
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: false,
                    columnWidth: '55%',
                }
            },
            dataLabels: { enabled: false },
            xaxis: {
                categories: dataFacultyNames,
                labels: { style: { fontSize: '12px' } }
            },
            grid: { strokeDashArray: 4 }
        };
        new ApexCharts(document.querySelector("#chart-faculty-dist"), optionsFaculty).render();


        // B. CHART: Gender (Donut)
        var optionsGender = {
            series: [countMale, countFemale],
            chart: {
                type: 'donut',
                height: 280,
                fontFamily: 'inherit'
            },
            labels: ['Laki-laki', 'Perempuan'],
            colors: ['#3B82F6', '#EC4899'], // Blue, Pink
            legend: { position: 'bottom' },
            dataLabels: { enabled: false },
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total',
                                formatter: function (w) {
                                    return w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                }
                            }
                        }
                    }
                }
            }
        };
        new ApexCharts(document.querySelector("#chart-gender"), optionsGender).render();


        // C. CHART: Performance (Area)
        var optionsPerf = {
            series: [{
                name: 'Rata-rata Pre-Test',
                data: dataPreTest
            }, {
                name: 'Rata-rata Post-Test',
                data: dataPostTest
            }],
            chart: {
                height: 320,
                type: 'area',
                toolbar: { show: false },
                fontFamily: 'inherit'
            },
            colors: ['#9CA3AF', '#10B981'], // Gray, Emerald
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 2 },
            xaxis: {
                categories: dataFacultyNames
            },
            fill: {
                type: 'gradient',
                gradient: { opacityFrom: 0.6, opacityTo: 0.1 }
            },
            grid: { strokeDashArray: 4 }
        };
        new ApexCharts(document.querySelector("#chart-performance"), optionsPerf).render();


        // D. CHART: Weekly Activity (Line) - Data Dummy Statis
        var optionsActivity = {
            series: [{
                name: 'Pengumpulan Tugas',
                type: 'column',
                data: [440, 505, 414, 671, 227, 413]
            }, {
                name: 'Kehadiran (%)',
                type: 'line',
                data: [85, 88, 90, 82, 95, 88]
            }],
            chart: {
                height: 320,
                type: 'line',
                toolbar: { show: false }
            },
            stroke: { width: [0, 3] },
            colors: ['#F59E0B', '#6366F1'], // Orange, Indigo
            dataLabels: { enabled: true, enabledOnSeries: [1] },
            labels: ['Pekan 1', 'Pekan 2', 'Pekan 3', 'Pekan 4', 'Pekan 5', 'Pekan 6'],
            yaxis: [{
                title: { text: 'Jumlah Tugas' },
            }, {
                opposite: true,
                title: { text: 'Kehadiran %' },
                max: 100
            }],
            grid: { strokeDashArray: 4 }
        };
        new ApexCharts(document.querySelector("#chart-activity"), optionsActivity).render();

    });
</script>
@endsection