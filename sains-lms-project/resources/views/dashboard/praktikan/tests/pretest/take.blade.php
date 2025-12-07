@extends('dashboard.praktikan.praktikan-base')

@section('page-title', 'SAINS | Pretest')

@section('content')
    <section class="m-4 md:mx-12 mt-20 md:mt-24">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold">Mengerjakan: {{ $test->title }}</h2>
            </div>

            <div id="timer" class="text-sm bg-yellow-100 text-yellow-800 px-4 py-2 rounded-lg font-bold">
                Waktu tersisa: <span id="time-left"></span>
            </div>
        </div>

        <form id="test-form" action="{{ route('pretest-praktikan.submit', ['testId' => $test->id]) }}" method="POST">
            @csrf

            @foreach ($test->questions as $index => $q)
                <div class="bg-white border rounded p-4 mb-4">
                    <div class="flex items-start justify-between">
                        <h3 class="font-semibold">{{ $index + 1 }}. {!! nl2br(e($q->question)) !!}</h3>
                        <span class="text-sm text-gray-500">{{ strtoupper($q->type) }}</span>
                    </div>

                    @if ($q->type === 'mcq')
                        <div class="mt-3 space-y-2">
                            @foreach ($q->options as $optIndex => $opt)
                                <label class="flex items-center gap-3 p-2 border rounded cursor-pointer">
                                    <input type="radio" name="answers[{{ $q->id }}][option]"
                                        value="{{ $opt->id }}" required>
                                    <span class="font-medium">{{ chr(65 + $optIndex) }}.</span>
                                    <span>{!! nl2br(e($opt->option_text)) !!}</span>
                                </label>
                            @endforeach
                        </div>
                    @else
                        <div class="mt-3">
                            <textarea name="answers[{{ $q->id }}][essay]" rows="4" class="w-full border rounded p-2"
                                placeholder="Tulis jawaban essay..."></textarea>
                        </div>
                    @endif
                </div>
            @endforeach

            <div class="flex gap-3">
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded" id="submit-btn">Kumpulkan</button>
                <a href="{{ route('pretest-praktikan.index') }}"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded">Batal</a>
            </div>
        </form>
    </section>

    <script>
        (function() {
            let timeLeft = {{ $remainingSeconds ?? 0 }};

            console.log("Sisa Waktu:", timeLeft);

            const display = document.getElementById('time-left');
            const form = document.getElementById('test-form');
            const submitBtn = document.getElementById('submit-btn');
            let isSubmitted = false;

            function formatTime(seconds) {
                const m = Math.floor(seconds / 60);
                const s = Math.floor(seconds % 60);
                return `${m.toString().padStart(2,'0')}:${s.toString().padStart(2,'0')}`;
            }

            function updateTimer() {
                if (timeLeft <= 0) {
                    display.textContent = "00:00";

                    clearInterval(timerInterval);

                    if (!isSubmitted) {
                        isSubmitted = true;
                        submitBtn.disabled = true;
                        submitBtn.innerText = "Waktu Habis...";

                        const hidden = document.createElement('input');
                        hidden.type = 'hidden';
                        hidden.name = 'auto_submitted';
                        hidden.value = '1';
                        form.appendChild(hidden);
                        form.submit();
                    }
                } else {
                    display.textContent = formatTime(timeLeft);
                    timeLeft--;
                }
            }

            updateTimer();

            const timerInterval = setInterval(updateTimer, 1000);
        })();
    </script>
@endsection
