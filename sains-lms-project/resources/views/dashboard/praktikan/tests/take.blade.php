@extends('dashboard.praktikan.praktikan-base')

@section('page-title', 'SAINS | Pretest')

@section('content')
    <section class="m-4 md:m-24">

        <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Mengerjakan: {{ $test->title }}</h2>
                <p class="text-sm text-gray-600 mt-1">Kerjakan soal berikut dengan teliti sebelum waktu habis.</p>
            </div>
            
            <div id="timer" class="flex items-center gap-2 text-sm bg-yellow-50 text-yellow-800 px-4 py-3 rounded-lg border border-yellow-200 shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">Sisa Waktu:</span>
                <span id="time-left" class="font-bold text-lg">Loading...</span>
            </div>
        </div>

        <form id="test-form" action="{{ route('ujian-praktikan.submit', ['testId' => $test->id]) }}" method="POST">
            @csrf

            @foreach ($test->questions as $index => $q)
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 mb-6 overflow-hidden">
                    
                    <div class="bg-gray-50 px-5 py-3 border-b border-gray-200 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="bg-primary text-white text-sm font-bold px-3 py-1 rounded-full">
                                {{ $index + 1 }}
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $q->type === 'mcq' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800' }}">
                                {{ $q->type === 'mcq' ? 'Pilihan Ganda' : 'Essay' }}
                            </span>
                        </div>
                    </div>

                    <div class="px-5 py-5">
                        <div class="mb-5">
                            <p class="text-gray-800 leading-relaxed text-base font-medium">
                                {!! nl2br(e($q->question)) !!}
                            </p>
                        </div>

                        @if ($q->type === 'mcq')
                            <div class="space-y-3">
                                <p class="text-sm font-semibold text-gray-500 mb-2">Pilih satu jawaban:</p>
                                @foreach ($q->options as $optIndex => $opt)
                                    <label class="relative flex items-start gap-3 p-3 rounded-lg border border-gray-200 cursor-pointer hover:bg-blue-50 hover:border-blue-200 transition-all duration-200 group">
                                        <div class="flex items-center h-6">
                                            <input type="radio" 
                                                   name="answers[{{ $q->id }}][option]" 
                                                   value="{{ $opt->id }}" 
                                                   required
                                                   class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-primary focus:ring-2">
                                        </div>
                                        
                                        <div class="flex-1">
                                            <span class="font-bold text-gray-500 mr-2 group-hover:text-primary">{{ chr(65 + $optIndex) }}.</span>
                                            <span class="text-gray-700 leading-snug group-hover:text-gray-900">{!! nl2br(e($opt->option_text)) !!}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        @else
                            <div class="mt-2">
                                <p class="text-sm font-semibold text-gray-500 mb-2">Tulis jawaban Anda:</p>
                                <textarea name="answers[{{ $q->id }}][essay]" 
                                          rows="6" 
                                          class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block p-3"
                                          placeholder="Ketik jawaban essay di sini..." 
                                          required></textarea>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach

            <div class="flex items-center justify-end gap-3 mb-24 mt-8">
                <a href="{{ route('ujian-praktikan.index') }}" 
                   class="px-5 py-2.5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                    Batal
                </a>
                <button type="submit" 
                        id="submit-btn"
                        class="text-white bg-primary hover:bg-gray-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none transition-colors duration-200">
                    Kumpulkan Jawaban
                </button>
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
            const timerDiv = document.getElementById('timer');
            let isSubmitted = false;

            function formatTime(seconds) {
                const m = Math.floor(seconds / 60);
                const s = Math.floor(seconds % 60);
                return `${m.toString().padStart(2,'0')}:${s.toString().padStart(2,'0')}`;
            }

            function updateTimer() {
                if (timeLeft <= 0) {
                    display.textContent = "00:00";
                    
                    // Visual changes when time is up
                    timerDiv.classList.remove('bg-yellow-50', 'text-yellow-800', 'border-yellow-200');
                    timerDiv.classList.add('bg-red-100', 'text-red-800', 'border-red-200');

                    clearInterval(timerInterval);

                    if (!isSubmitted) {
                        isSubmitted = true;
                        submitBtn.disabled = true;
                        submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
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
                    
                    if(timeLeft < 60) {
                        timerDiv.classList.remove('bg-yellow-50', 'text-yellow-800');
                        timerDiv.classList.add('bg-orange-100', 'text-orange-800');
                    }
                    
                    timeLeft--;
                }
            }

            updateTimer();

            const timerInterval = setInterval(updateTimer, 1000);
        })();
    </script>
@endsection