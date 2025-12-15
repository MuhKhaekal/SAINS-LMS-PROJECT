@extends('dashboard.admin.admin-base')

@section('page-title', 'Profil Pengguna')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-14 md:mt-0">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
            <div class="flex flex-col md:flex-row items-start gap-6">

                <div class="shrink-0 relative">
                    <div
                        class="w-16 h-16 rounded-2xl bg-gradient-to-br bg-primary text-white flex items-center justify-center text-3xl font-bold shadow-md">
                        {{ substr($user->nama, 0, 1) }}
                    </div>
                </div>

                <div class="flex-1 w-full">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                        <div>
                            <div class="flex items-center gap-3">
                                <h1 class="text-2xl font-bold text-gray-900">{{ $user->nama }}</h1>
                                <span
                                    class="px-2.5 py-0.5 rounded-md text-xs font-bold uppercase tracking-wide border
                                    {{ $user->role == 'praktikan' ? 'bg-green-50 text-green-700 border-green-200' : '' }}
                                    {{ $user->role == 'asisten' ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}
                                    {{ $user->role == 'admin' ? 'bg-red-50 text-red-700 border-red-200' : '' }}">
                                    {{ $user->role }}
                                </span>
                            </div>

                            <div class="flex flex-wrap items-center gap-y-2 gap-x-4 mt-2 text-sm text-gray-500">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2">
                                        </path>
                                    </svg>
                                    <span class="font-mono text-gray-700">{{ $user->nim }}</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span>{{ $user->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span>Join: {{ $user->created_at->format('M Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('daftar-pengguna.index') }}"
                            class="text-sm text-gray-500 hover:text-indigo-600 font-medium flex items-center gap-1 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-100 flex gap-2">
                        <button onclick="switchTab('profil')" id="tab-btn-profil"
                            class="tab-btn px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 bg-gray-100 text-gray-600 hover:bg-gray-200">
                            Informasi Profil
                        </button>

                        @if ($user->role == 'praktikan')
                            <button onclick="switchTab('akademik')" id="tab-btn-akademik"
                                class="tab-btn px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 text-gray-500 hover:bg-gray-50 hover:text-gray-700">
                                Riwayat Akademik
                            </button>
                        @elseif($user->role == 'asisten')
                            <button onclick="switchTab('mengajar')" id="tab-btn-mengajar"
                                class="tab-btn px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 text-gray-500 hover:bg-gray-50 hover:text-gray-700">
                                Daftar Halaqah Binaan
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <script>
            function switchTab(tabName) {
                document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
                document.getElementById('tab-content-' + tabName).classList.remove('hidden');

                document.querySelectorAll('.tab-btn').forEach(el => {
                    el.className =
                        'tab-btn px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 text-gray-500 hover:bg-gray-50 hover:text-gray-700';
                });

                const activeBtn = document.getElementById('tab-btn-' + tabName);
                activeBtn.className =
                    'tab-btn px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 bg-indigo-50 text-indigo-700 ring-1 ring-indigo-200';
            }

            document.addEventListener('DOMContentLoaded', () => {
                switchTab('profil');
            });
        </script>


        <div id="tab-content-profil" class="tab-content grid grid-cols-1 md:grid-cols-2 gap-6 animate-fade-in">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4 border-b pb-2">Detail Akun</h3>
                <div class="space-y-4">
                    <div><label class="text-xs text-gray-500">Nama Lengkap</label>
                        <p class="font-medium text-gray-900">{{ $user->nama }}</p>
                    </div>
                    <div><label class="text-xs text-gray-500">NIM/NIP</label>
                        <p class="font-medium text-gray-900 font-mono">{{ $user->nim }}</p>
                    </div>
                    <div><label class="text-xs text-gray-500">Jenis Kelamin</label>
                        <p class="font-medium text-gray-900">{{ $user->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4 border-b pb-2">Sistem</h3>
                <div class="space-y-4">
                    <div><label class="text-xs text-gray-500">Role</label>
                        <p class="font-medium text-gray-900 capitalize">{{ $user->role }}</p>
                    </div>
                    <div><label class="text-xs text-gray-500">Bergabung</label>
                        <p class="font-medium text-gray-900">{{ $user->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if ($user->role == 'praktikan')
            <div id="tab-content-akademik" class="tab-content hidden space-y-8 animate-fade-in">
                @forelse($academicData as $data)
                    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden relative">
                        <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-indigo-500"></div>

                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 ml-1">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                <div>
                                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                            </path>
                                        </svg>
                                        {{ $data->halaqah->halaqah_name }}
                                    </h2>
                                    <div class="text-xs text-gray-500 mt-1 ml-7 flex flex-wrap gap-2">
                                        <span class="bg-white border border-gray-200 px-2 py-0.5 rounded">Kode:
                                            {{ $data->halaqah->halaqah_code }}</span>
                                        <span class="bg-blue-50 text-blue-700 border border-blue-100 px-2 py-0.5 rounded">
                                            {{ $data->halaqah->prodi->prodi_name ?? 'Prodi -' }}
                                        </span>
                                        <span
                                            class="bg-indigo-50 text-indigo-700 border border-indigo-100 px-2 py-0.5 rounded">
                                            {{ $data->halaqah->prodi->faculty->faculty_name ?? 'Fakultas -' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="flex gap-2">
                                    <div
                                        class="px-3 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-bold text-center border border-green-200">
                                        <span class="block text-lg">{{ $data->summary_presence['hadir'] }}</span>Hadir
                                    </div>
                                    <div
                                        class="px-3 py-1 bg-yellow-100 text-green-700 rounded-lg text-xs font-bold text-center border border-green-200">
                                        <span class="block text-lg">{{ $data->summary_presence['sakit'] }}</span>Sakit
                                    </div>
                                    <div
                                        class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-bold text-center border border-blue-200">
                                        <span class="block text-lg">{{ $data->summary_presence['izin'] }}</span>Izin
                                    </div>
                                    <div
                                        class="px-3 py-1 bg-red-100 text-red-700 rounded-lg text-xs font-bold text-center border border-red-200">
                                        <span class="block text-lg">{{ $data->summary_presence['alfa'] }}</span>Alfa
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 ml-1 grid grid-cols-1 xl:grid-cols-2 gap-8">
                            <div>
                                <h3 class="text-sm font-bold text-gray-700 uppercase mb-4 flex items-center gap-2"><span
                                        class="w-2 h-2 bg-indigo-500 rounded-full"></span> Rekapitulasi Nilai</h3>
                                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                                    <table class="w-full text-sm text-left">
                                        <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-semibold">
                                            <tr>
                                                <th class="px-4 py-3 text-center w-1/4">Komponen</th>
                                                <th class="px-4 py-3 text-center">KBQ</th>
                                                <th class="px-4 py-3 text-center">HB</th>
                                                <th class="px-4 py-3 text-center">MH</th>
                                                <th class="px-4 py-3 text-center bg-gray-100">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100">
                                            <tr>
                                                <td class="px-4 py-3 font-medium text-gray-700 border-r border-gray-100">
                                                    Pre-Test</td>
                                                <td class="px-4 py-3 text-center">{{ $data->pretest->kbq ?? '-' }}</td>
                                                <td class="px-4 py-3 text-center">{{ $data->pretest->hb ?? '-' }}</td>
                                                <td class="px-4 py-3 text-center">{{ $data->pretest->mh ?? '-' }}</td>
                                                <td class="px-4 py-3 text-center font-bold text-blue-600 bg-blue-50">
                                                    {{ $data->pretest->total ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-3 font-medium text-gray-700 border-r border-gray-100">
                                                    Post-Test</td>
                                                <td class="px-4 py-3 text-center">{{ $data->posttest->kbq ?? '-' }}</td>
                                                <td class="px-4 py-3 text-center">{{ $data->posttest->hb ?? '-' }}</td>
                                                <td class="px-4 py-3 text-center">{{ $data->posttest->mh ?? '-' }}</td>
                                                <td class="px-4 py-3 text-center font-bold text-indigo-600 bg-indigo-50">
                                                    {{ $data->posttest->total ?? '-' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div class="sm:col-span-2 bg-gray-50 rounded-xl p-4 border border-gray-200">
                                        <span class="text-xs font-bold text-gray-400 uppercase block mb-2">Pekanan</span>
                                        <div class="grid grid-cols-6 gap-2 text-center">
                                            @for ($i = 1; $i <= 6; $i++)
                                                <div class="bg-white rounded p-1 shadow-sm border border-gray-100"><span
                                                        class="block text-[9px] text-gray-400">P{{ $i }}</span><span
                                                        class="font-bold text-gray-700 text-sm">{{ $data->weekly->{'score' . $i} ?? '-' }}</span>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                    <div
                                        class="bg-green-50 rounded-xl p-4 border border-green-200 flex flex-col items-center justify-center">
                                        <span class="text-xs font-bold text-green-600 uppercase">Final</span><span
                                            class="text-2xl font-bold text-green-700 mt-1">{{ $data->final->score ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-sm font-bold text-gray-700 uppercase mb-4 flex items-center gap-2"><span
                                        class="w-2 h-2 bg-green-500 rounded-full"></span> Detail Kehadiran</h3>
                                <div
                                    class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col h-[260px]">
                                    <div class="overflow-y-auto flex-1 custom-scrollbar">
                                        <table class="w-full text-sm text-left">
                                            <thead
                                                class="bg-gray-50 text-gray-500 text-xs uppercase font-semibold sticky top-0 z-10">
                                                <tr>
                                                    <th class="px-4 py-2 border-b w-10 text-center">#</th>
                                                    <th class="px-4 py-2 border-b">Meeting</th>
                                                    <th class="px-4 py-2 border-b text-center">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-100">
                                                @forelse($data->presences as $idx => $presence)
                                                    <tr>
                                                        <td class="px-4 py-2 text-center text-xs text-gray-400">
                                                            {{ $idx + 1 }}</td>
                                                        <td class="px-4 py-2">
                                                            <div class="text-xs font-medium text-gray-800">
                                                                {{ $presence->meeting->meeting_name ?? '#' . $presence->meeting_id }}
                                                            </div>
                                                        </td>
                                                        <td class="px-4 py-2 text-center"><span
                                                                class="px-2 py-0.5 rounded text-[10px] font-bold uppercase border {{ match ($presence->status) {'hadir' => 'bg-green-50 text-green-700 border-green-200','izin' => 'bg-blue-50 text-blue-700 border-blue-200','sakit' => 'bg-yellow-50 text-yellow-700 border-yellow-200','alfa' => 'bg-red-50 text-red-700 border-red-200',default => 'bg-gray-50 text-gray-500'} }}">{{ $presence->status }}</span>
                                                        </td>
                                                    </tr>
                                                @empty <tr>
                                                        <td colspan="3"
                                                            class="px-6 py-10 text-center text-xs text-gray-400 italic">
                                                            Belum ada data.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 bg-white rounded-xl border border-dashed border-gray-300">
                        <p class="text-gray-500">Praktikan ini belum memiliki data nilai/kehadiran.</p>
                    </div>
                @endforelse
            </div>
        @endif

        @if ($user->role == 'asisten')
            <div id="tab-content-mengajar" class="tab-content hidden animate-fade-in">
                @if ($user->halaqahs->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($user->halaqahs as $halaqah)
                            <div
                                class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition duration-300 overflow-hidden group">
                                <div class="h-2 bg-indigo-500 w-full group-hover:bg-indigo-600 transition"></div>
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                </path>
                                            </svg>
                                        </div>
                                        <span
                                            class="px-2 py-1 text-[10px] font-bold uppercase tracking-wide bg-gray-100 text-gray-600 rounded border border-gray-200">
                                            {{ $halaqah->halaqah_type }}
                                        </span>
                                    </div>

                                    <h3 class="text-lg font-bold text-gray-900 mb-1 line-clamp-1"
                                        title="{{ $halaqah->halaqah_name }}">
                                        {{ $halaqah->halaqah_name }}
                                    </h3>
                                    <p class="text-sm text-gray-500 font-mono mb-4">{{ $halaqah->halaqah_code }}</p>

                                    <div class="space-y-2 border-t border-gray-100 pt-4">
                                        <div class="flex items-start gap-2">
                                            <svg class="w-4 h-4 text-gray-400 mt-0.5 shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                </path>
                                            </svg>
                                            <div>
                                                <p class="text-[10px] uppercase text-gray-400 font-bold">Fakultas</p>
                                                <p class="text-sm font-medium text-gray-700 line-clamp-1"
                                                    title="{{ $halaqah->prodi->faculty->faculty_name ?? '-' }}">
                                                    {{ $halaqah->prodi->faculty->faculty_name ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-2">
                                            <svg class="w-4 h-4 text-gray-400 mt-0.5 shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                                </path>
                                            </svg>
                                            <div>
                                                <p class="text-[10px] uppercase text-gray-400 font-bold">Program Studi</p>
                                                <p class="text-sm font-medium text-gray-700 line-clamp-1"
                                                    title="{{ $halaqah->prodi->prodi_name ?? '-' }}">
                                                    {{ $halaqah->prodi->prodi_name ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 bg-white rounded-xl border border-dashed border-gray-300">
                        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum Ada Halaqah</h3>
                        <p class="mt-1 text-sm text-gray-500">Asisten ini belum ditugaskan ke halaqah manapun.</p>
                    </div>
                @endif
            </div>
        @endif

    </div>

    <script>
        function switchTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.getElementById('tab-content-' + tabName).classList.remove('hidden');

            document.querySelectorAll('.tab-btn').forEach(el => {
                el.className =
                    'tab-btn px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 text-gray-500 hover:bg-gray-50 hover:text-gray-700';
            });

            const activeBtn = document.getElementById('tab-btn-' + tabName);
            activeBtn.className =
                'tab-btn px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 bg-indigo-50 text-indigo-700 ring-1 ring-indigo-200';
        }

        document.addEventListener('DOMContentLoaded', () => {
            switchTab('profil');
        });
    </script>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>
@endsection
