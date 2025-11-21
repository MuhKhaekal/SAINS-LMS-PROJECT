@extends('dashboard.asisten.asisten-base')

@section('page-title', 'SAINS | Pengumuman')

@section('content')

    <section class="mx-4 md:mx-24 md:mt-20 md:flex md:gap-24">
        <section class="md:flex-1">
            <label for="message" class="block mb-2 text-sm font-bold text-gray-900 md:text-xl">Pengumuman</label>
            <textarea id="message" rows="4"
                class="shadow-md block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500 "
                placeholder="Isi pengumuman disini ... "></textarea>

            <label class="block mb-2 text-sm mt-4 font-bold text-gray-900 md:text-xl" for="file_input">Upload file</label>
            <input
                class=" p-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none"
                id="file_input" type="file" name="file"
                accept=".pdf,
                   .doc, .docx,
                   .xls, .xlsx,
                   .mp3, .wav, .m4a,
                   .jpg, .jpeg, .png">

            <div class="flex justify-end mt-5">
                <x-primary-button class="text-center">
                    {{ __('Unggah') }}
                </x-primary-button>
            </div>
        </section>

        <section class="md:flex-1">
            <div class="flex mt-4 mb-10">
                <div class="me-2">
                    <svg class="w-6 h-6 text-primary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 20a7.966 7.966 0 0 1-5.002-1.756l.002.001v-.683c0-1.794 1.492-3.25 3.333-3.25h3.334c1.84 0 3.333 1.456 3.333 3.25v.683A7.966 7.966 0 0 1 12 20ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10c0 5.5-4.44 9.963-9.932 10h-.138C6.438 21.962 2 17.5 2 12Zm10-5c-1.84 0-3.333 1.455-3.333 3.25S10.159 13.5 12 13.5c1.84 0 3.333-1.455 3.333-3.25S13.841 7 12 7Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class=" bg-primary w-full rounded-e-3xl rounded-bl-3xl p-4">
                    <h1 class="text-white text-sm font bold">Muh. Ilham Maulana Ramlan</h1>
                    <div class="bg-gray-600 p-2 mt-2 rounded-lg">
                        <p class="text-xs font-thin text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Alias molestiae, quae sapiente inventore consequuntur excepturi illum pariatur ipsum quo
                            dolorem.</p>
                        <a class="flex items-center mt-2">
                            <svg class="w-4 h-4 me-3 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M3 6a2 2 0 0 1 2-2h5.532a2 2 0 0 1 1.536.72l1.9 2.28H3V6Zm0 3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9H3Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="text-white text-xs hover:text-blue-500 hover:underline">File Lampiran</p>
                        </a>
                        <div class="flex space-x-4 text-xs text-gray-500 mt-2">
                            <p>* PDF</p>
                            <p>* 2025-07-03</p>
                            <p>* 03:57:01</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

@endsection
