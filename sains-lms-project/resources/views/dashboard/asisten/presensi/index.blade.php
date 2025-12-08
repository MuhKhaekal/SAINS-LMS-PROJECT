@extends('dashboard.asisten.asisten-base')

@section('page-title', 'SAINS | Presensi')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:mt-24">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Presensi Mahasiswa</h1>
                <div class="flex items-center gap-2 mt-1 text-sm text-gray-500">
                    <span>{{ $selectedHalaqah->halaqah_name }}</span>
                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="font-medium text-gray-700">{{ $selectedMeeting->meeting_name }}</span>
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

        <form action="{{ route('presensi-asisten.store') }}" method="POST">
            @csrf
            <input type="hidden" name="halaqah_id" value="{{ $selectedHalaqah->id }}">
            <input type="hidden" name="meeting_id" value="{{ $selectedMeeting->id }}">

            <div
                class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6 flex flex-col md:flex-row items-center justify-between gap-4 sticky top-4 z-10">
                <div
                    class="flex items-center gap-3 text-gray-700 bg-gray-50 px-4 py-2 rounded-lg border border-gray-200 w-full md:w-auto justify-center md:justify-start">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span class="font-medium text-sm">{{ $todayDate }}</span>
                </div>

                <x-primary-button type="submit" class="w-full md:w-auto justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Kehadiran
                </x-primary-button>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-4 w-12 text-center">No</th>
                                <th scope="col" class="px-6 py-4 w-32 font-semibold">NIM</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Nama Mahasiswa</th>
                                <th scope="col" class="px-6 py-4 text-center font-semibold">Status Kehadiran</th>
                                <th scope="col" class="px-6 py-4 w-64 font-semibold">Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($praktikans as $index => $praktikan)
                                @php
                                    $presence = $presences[$praktikan->id] ?? null;
                                    $status = $presence->status ?? null;
                                @endphp

                                <tr class="bg-white hover:bg-gray-50 transition-colors group">
                                    <input type="hidden" name="presence[{{ $praktikan->id }}][user_id]"
                                        value="{{ $praktikan->id }}">

                                    <td class="px-6 py-4 text-center text-gray-500">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 font-mono text-gray-600">
                                        {{ $praktikan->nim }}
                                    </td>
                                    <td
                                        class="px-6 py-4 font-medium text-gray-900 group-hover:text-indigo-600 transition-colors">
                                        {{ $praktikan->nama }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-6 justify-center items-center">
                                            <label class="flex items-center gap-2 cursor-pointer group/radio">
                                                <input type="radio" name="presence[{{ $praktikan->id }}][status]"
                                                    value="Hadir" {{ $status == 'Hadir' ? 'checked' : '' }}
                                                    class="w-4 h-4 text-emerald-600 bg-gray-100 border-gray-300 focus:ring-emerald-500 focus:ring-2 cursor-pointer transition">
                                                <span
                                                    class="text-sm text-gray-700 group-hover/radio:text-emerald-700 font-medium">Hadir</span>
                                            </label>

                                            <label class="flex items-center gap-2 cursor-pointer group/radio">
                                                <input type="radio" name="presence[{{ $praktikan->id }}][status]"
                                                    value="Sakit" {{ $status == 'Sakit' ? 'checked' : '' }}
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2 cursor-pointer transition">
                                                <span
                                                    class="text-sm text-gray-700 group-hover/radio:text-blue-700 font-medium">Sakit</span>
                                            </label>

                                            <label class="flex items-center gap-2 cursor-pointer group/radio">
                                                <input type="radio" name="presence[{{ $praktikan->id }}][status]"
                                                    value="Izin" {{ $status == 'Izin' ? 'checked' : '' }}
                                                    class="w-4 h-4 text-yellow-400 bg-gray-100 border-gray-300 focus:ring-yellow-500 focus:ring-2 cursor-pointer transition">
                                                <span
                                                    class="text-sm text-gray-700 group-hover/radio:text-yellow-700 font-medium">Izin</span>
                                            </label>

                                            <label class="flex items-center gap-2 cursor-pointer group/radio">
                                                <input type="radio" name="presence[{{ $praktikan->id }}][status]"
                                                    value="Alfa" {{ $status == 'Alfa' ? 'checked' : '' }}
                                                    class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 focus:ring-red-500 focus:ring-2 cursor-pointer transition">
                                                <span
                                                    class="text-sm text-gray-700 group-hover/radio:text-red-700 font-medium">Alfa</span>
                                            </label>

                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <textarea rows="1" name="presence[{{ $praktikan->id }}][description]"
                                            class="block w-full text-sm rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 placeholder-gray-400 transition resize-none"
                                            placeholder="Keterangan...">{{ $presence->description ?? '' }}</textarea>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </form>

        @if (session('success'))
            <div id="alert-success"
                class="fixed bottom-4 right-4 z-50 flex items-center p-4 mb-4 text-green-800 border-l-4 border-green-500 bg-green-50 rounded shadow-lg transform transition-all duration-500 translate-y-0 opacity-100"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <div class="ms-3 text-sm font-medium">{{ session('success') }}</div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
                    data-dismiss-target="#alert-success" aria-label="Close" onclick="this.parentElement.remove()">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            <script>
                setTimeout(() => {
                    const alert = document.getElementById('alert-success');
                    if (alert) {
                        alert.classList.add('opacity-0', 'translate-y-10');
                        setTimeout(() => alert.remove(), 500);
                    }
                }, 3000);
            </script>
        @endif

    </div>

    @if (session('success'))
        <div id="alert-success"
            class="fixed top-4 right-4 z-50 flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 rounded-lg shadow-lg opacity-0 translate-x-10 transition-all duration-500 ease-out"
            role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <div class="ms-3 text-sm font-medium">{{ session('success') }}</div>
        </div>
        <script>
            const alert = document.getElementById('alert-success');
            setTimeout(() => alert.classList.remove('opacity-0', 'translate-x-10'), 100);
            setTimeout(() => {
                alert.classList.add('opacity-0', 'translate-x-10');
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        </script>
    @endif

    @if (session('error'))
        <div id="alert-error"
            class="fixed top-4 right-4 z-50 flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 rounded-lg shadow-lg opacity-0 translate-x-10 transition-all duration-500 ease-out"
            role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <div class="ms-3 text-sm font-medium">{{ session('error') }}</div>
        </div>
        <script>
            const alertError = document.getElementById('alert-error');
            setTimeout(() => alertError.classList.remove('opacity-0', 'translate-x-10'), 100);
            setTimeout(() => {
                alertError.classList.add('opacity-0', 'translate-x-10');
                setTimeout(() => alertError.remove(), 500);
            }, 5000);

            window.addEventListener("pageshow", function(event) {
                if (event.persisted) {
                    const alertSuccess = document.getElementById("alert-success");
                    const alertError = document.getElementById("alert-error");
                    if (alertSuccess) alertSuccess.remove();
                    if (alertError) alertError.remove();
                }
            });
        </script>
    @endif
@endsection
