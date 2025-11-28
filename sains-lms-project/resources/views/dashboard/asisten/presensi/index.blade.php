@extends('dashboard.asisten.asisten-base')

@section('page-title', 'SAINS | Presensi')

@section('content')
    <section class="m-4 md:mx-24 md:mt-24 bg-white shadow-md p-8 rounded-md border-2">
        <h1 class="text-center font-bold text-xl mb-4">Kehadiran Mahasiswa: {{ $selectedMeeting->meeting_name }}</h1>
        <section class="flex flex-col md:flex-row md:justify-between items-center">
            <div class="">
                <h1 class="text-xs mb-2 ms-11">Tanggal</h1>
                <div class="flex gap-2">
                    <p class="text-center text-gray-500 text-xl">{{ $todayDate }}</p>
                    <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>

            </div>
            <form action="{{ route('presensi-asisten.store') }}" method="POST">
                @csrf
                <input type="hidden" name="halaqah_id" value="{{ $selectedHalaqah->id }}">
                <input type="hidden" name="meeting_id" value="{{ $selectedMeeting->id }}">
                <div class="mt-2 md:mb-0">
                    <x-secondary-button>
                        Simpan Kehadiran
                    </x-secondary-button>
                </div>
        </section>

        <section class="mt-5">
            <table class="w-full text-sm text-left rtl:text-right">
                <thead class="text-xs uppercase bg-gray-100 text-gray-500">
                    <tr>

                        <th scope="col" class="px-6 py-3 w-1/12 text-center">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 w-1/12">
                            NIM
                        </th>
                        <th scope="col" class="px-6 py-3 w-3/12">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3 w-4/12">
                            Status Kehadiran
                        </th>
                        <th scope="col" class="px-6 py-3 w-3/12">
                            Catatan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($praktikans as $index => $praktikan)
                        @php
                            $presence = $presences[$praktikan->id] ?? null;
                            $status = $presence->status ?? null;
                        @endphp
                         
                        <tr class="bg-white hover:bg-gray-100 text-primary border-b">
                            <input type="hidden" name="presence[{{ $praktikan->id }}][user_id]"
                                value="{{ $praktikan->id }}">
                            <td class="px-6 py-4 text-center">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $praktikan->nim }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $praktikan->nama }}
                            </td>
                            <td class="px-6 py-4">
                                <fieldset class="flex gap-4">
                                    <legend class="sr-only">Countries</legend>

                                    <div class="flex items-center mb-4">
                                        <input type="radio" name="presence[{{ $praktikan->id }}][status]" value="Hadir" {{ $status == 'Hadir' ? 'checked' : '' }}
                                            class="w-4 h-4 text-neutral-primary border-default-medium bg-neutral-secondary-medium rounded-full checked:border-brand focus:ring-2 focus:outline-none focus:ring-brand-subtle border border-default appearance-none">
                                        <label for="country-option-1"
                                            class="select-none ms-2 text-sm font-medium text-heading">
                                            Hadir
                                        </label>    
                                    </div>

                                    <div class="flex items-center mb-4">
                                        <input type="radio" name="presence[{{ $praktikan->id }}][status]" value="Sakit" {{ $status == 'Sakit' ? 'checked' : '' }}
                                            class="w-4 h-4 text-neutral-primary border-default-medium bg-neutral-secondary-medium rounded-full checked:border-brand focus:ring-2 focus:outline-none focus:ring-brand-subtle border border-default appearance-none">
                                        <label for="country-option-2"
                                            class="select-none ms-2 text-sm font-medium text-heading">
                                            Sakit
                                        </label>
                                    </div>

                                    <div class="flex items-center mb-4">
                                        <input type="radio" name="presence[{{ $praktikan->id }}][status]" value="Izin" {{ $status == 'Izin' ? 'checked' : '' }}
                                            class="w-4 h-4 text-neutral-primary border-default-medium bg-neutral-secondary-medium rounded-full checked:border-brand focus:ring-2 focus:outline-none focus:ring-brand-subtle border border-default appearance-none">
                                        <label for="country-option-3"
                                            class="select-none ms-2 text-sm font-medium text-heading">
                                            Izin
                                        </label>
                                    </div>

                                    <div class="flex items-center mb-4">
                                        <input type="radio" name="presence[{{ $praktikan->id }}][status]" value="Alfa" {{ $status == 'Alfa' ? 'checked' : '' }}
                                            class="w-4 h-4 text-neutral-primary border-default-medium bg-neutral-secondary-medium rounded-full checked:border-brand focus:ring-2 focus:outline-none focus:ring-brand-subtle border border-default appearance-none">
                                        <label for="country-option-4"
                                            class="select-none ms-2 text-sm font-medium text-heading">
                                            Alfa
                                        </label>
                                    </div>
                                </fieldset>
                            </td>

                            <td class="px-6 py-4">
                                <textarea id="message" rows="2" name="presence[{{ $praktikan->id }}][description]"
                                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-xs rounded-base focus:ring-brand focus:border-brand block w-full p-3.5 shadow-xs placeholder:text-body"
                                    placeholder="Isi keterangan ...">{{ $presence->description ?? '' }}</textarea>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        </form>
    </section>

    <div class="md:mx-24 mx-4 mt-8 mb-8 md:mb-0">
        <a href="{{ url()->previous() }}"
            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md  hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 md:basis-2/12 text-center flex items-center justify-center gap-2 w-fit text-sm">
            Kembali
        </a>
    </div>

    @if (session('success'))
        <div id="alert-success"
            class="fixed top-4 right-4 z-50 flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 rounded-lg shadow-lg 
          opacity-0 translate-x-10 transition-all duration-500 ease-out"
            role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3
                                                               1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1
                                                               1 1v4h1a1 1 0 0 1 0 2Z" />
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
            class="fixed top-4 right-4 z-50 flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 rounded-lg shadow-lg 
          opacity-0 translate-x-10 transition-all duration-500 ease-out"
            role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3
                                                               1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1
                                                               1 1v4h1a1 1 0 0 1 0 2Z" />
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
