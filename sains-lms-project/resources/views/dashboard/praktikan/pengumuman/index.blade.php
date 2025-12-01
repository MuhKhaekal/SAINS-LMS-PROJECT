@extends('dashboard.praktikan.praktikan-base')

@section('page-title', 'SAINS | Pengumuman')

@section('content')
    <section class="md:mt-24 mx-4 md:mx-48">
        @forelse ($announcements as $index => $announcement)
            <div class="flex mt-4 mb-10">

                <div class="me-2">
                    <svg class="w-6 h-6 text-primary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 20a7.966 7.966 0 0 1-5.002-1.756l.002.001v-.683c0-1.794 1.492-3.25 3.333-3.25h3.334c1.84 0 3.333 1.456 3.333 3.25v.683A7.966 7.966 0 0 1 12 20ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10c0 5.5-4.44 9.963-9.932 10h-.138C6.438 21.962 2 17.5 2 12Zm10-5c-1.84 0-3.333 1.455-3.333 3.25S10.159 13.5 12 13.5c1.84 0 3.333-1.455 3.333-3.25S13.841 7 12 7Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>

                <div class="bg-secondary w-full rounded-e-3xl rounded-bl-3xl p-4">
                    <h1 class="text-primary text-sm font-bold">{{ $announcement->user->nama }}</h1>
                    <div class="bg-emerald-50 p-2 mt-2 rounded-xl">
                        <p class="text-xs font-thin text-primary">{{ $announcement->content }}</p>
                        @if ($announcement->file_location)
                            <a class="flex items-center mt-2" href="{{ asset('storage/' . $announcement->file_location) }}">
                                <svg class="w-4 h-4 me-3 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M3 6a2 2 0 0 1 2-2h5.532a2 2 0 0 1 1.536.72l1.9 2.28H3V6Zm0 3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9H3Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="text-white text-xs hover:text-blue-500 hover:underline">File Lampiran</p>
                            </a>
                        @endif

                        <div class="flex space-x-4 text-xs text-gray-500 mt-2">
                            @if ($announcement->file_location)
                                @php
                                    $extension = pathinfo($announcement->file_location, PATHINFO_EXTENSION);
                                @endphp
                                <p>* {{ strtoupper($extension) }}</p>
                            @endif

                            <p>* {{ $announcement->created_at->timezone('Asia/Makassar')->format('d M Y, H:i') }}</p>

                        </div>
                    </div>

                </div>
            </div>
        @empty
            <p class="text-gray-400 text-center italic">Belum ada pengumuman</p>
        @endforelse
    </section>  
@endsection
