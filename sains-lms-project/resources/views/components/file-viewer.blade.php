<div>
    @php
        $basename = basename($path);
        $extension = strtolower(pathinfo($basename, PATHINFO_EXTENSION));
        $fileUrl = asset('storage/' . $path);

        // Jika PDF, wajib gunakan route preview
        $previewUrl = route('materi.preview', ['file' => $basename]);
    @endphp

    {{-- PDF --}}
    @if ($extension === 'pdf')
        <iframe src="{{ $previewUrl }}" class="w-full h-[700px]" frameborder="0">
        </iframe>
        {{-- Debug: tampilkan URL iframe --}}
        <p class="text-xs text-gray-400 mt-2">Using preview route: {{ $previewUrl }}</p>

        {{-- IMAGE --}}
    @elseif(in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']))
        <img src="{{ $fileUrl }}" alt="{{ $basename }}" class="max-w-full rounded">

        {{-- AUDIO --}}
    @elseif(in_array($extension, ['mp3', 'wav', 'ogg', 'm4a']))
        <audio controls class="w-full">
            <source src="{{ $fileUrl }}">
        </audio>

        {{-- VIDEO --}}
    @elseif(in_array($extension, ['mp4', 'webm', 'ogg']))
        <video controls class="w-full">
            <source src="{{ $fileUrl }}">
        </video>

        {{-- OFFICE --}}
    @elseif(in_array($extension, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx']))
        @php
            $officeUrl = 'https://view.officeapps.live.com/op/embed.aspx?src=' . urlencode($fileUrl);
        @endphp

        <iframe src="{{ $officeUrl }}" class="w-full h-[700px]" frameborder="0"></iframe>

        {{-- UNKNOWN --}}
    @else
        <a href="{{ $fileUrl }}" download class="px-3 py-2 bg-gray-600 text-white rounded">
            Download File
        </a>
    @endif
</div>
