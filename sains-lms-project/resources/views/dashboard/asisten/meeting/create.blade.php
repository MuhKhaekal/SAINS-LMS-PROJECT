@extends('dashboard.asisten.asisten-base')

@section('page-title', 'SAINS | Tambah Pertemuan')

@section('content')

    <section class="mx-4">
        <section>
            <h1 class="font-bold mt-4">Unggah Topik Pertemuan</h1>
            <p class="text-sm text-gray-700 mt-1">Silahkan unggah topik pertemuan sesuai dengan minggu pertemuan sekarang ini
            </p>
        </section>
        <form action="{{ route('pertemuan.store') }}" method="POST">
            @csrf

            <section class="mt-4 font-semibold">
                <h1>Judul Pertemuan</h1>
                <x-text-input-white id="meeting_name" meeting_name="meeting_name" type="text"
                    class="mt-1 block w-full text-sm text-gray-600 font-thin" required autofocus autocomplete="meeting_name"
                    placeholder="contoh: Pertemuan 1" />
                <x-input-error class="mt-2" :messages="$errors->get('meeting_name')" />
            </section>

            <section class="mt-4 font-semibold">
                <h1>Topik Pertemuan</h1>
                <x-text-input-white id="topic" topic="topic" type="text"
                    class="mt-1 block w-full text-sm text-gray-600 font-thin" required autofocus autocomplete="topic"
                    placeholder="contoh: Makharijul Huruf" />
                <x-input-error class="mt-2" :messages="$errors->get('topic')" />

                <section class="mt-4 font-semibold">
                    <h1>Deskripsi Pertemuan</h1>
                    <textarea id="description" name="description" rows="4"
                        class="block bg-white border border-default-medium text-heading text-sm rounded-md focus:ring-primary w-full p-3.5 shadow-xs placeholder:text-body mt-1"
                        placeholder="Tambahkan deskripsi..."></textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('topic')" />
                </section>
            </section>

            <section class="mt-4 flex justify-end gap-x-4">
                <a href="{{ route('halaqah-asisten.index', ['halaqah_name' => $selectedHalaqah->halaqah_name]) }}"
                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md  hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150  text-center flex items-center justify-center gap-2 text-sm">
                    Batal
                </a>

                <x-primary-button class="text-center">
                    {{ __('Simpan') }}
                </x-primary-button>
            </section>
        </form>

    @endsection
