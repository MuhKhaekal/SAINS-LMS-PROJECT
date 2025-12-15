@extends('dashboard.admin.admin-base')

@section('page-title', 'SAINS - Pengumuman')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-14 md:mt-0">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ isset($test) ? 'Edit Soal Ujian' : 'Buat Ujian Baru' }}</h1>
                <p class="text-sm text-gray-500 mt-1">Konfigurasi detail ujian dan kelola daftar pertanyaan.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('questions.review-pretest') }}"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                    Preview
                </a>

                <x-primary-button onclick="document.getElementById('triggerSave').click()">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                        </path>
                    </svg>
                    {{ isset($test) ? 'Simpan Perubahan' : 'Simpan Ujian' }}
                </x-primary-button>
            </div>
        </div>

        <script>
            window.existingQuestions = @json($jsQuestions ?? []);
            window.existingType = @json($test->test_type ?? 'pretest');
        </script>

        <div x-data="testBuilder(window.existingQuestions, window.existingType)" class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <div class="lg:col-span-1 lg:sticky lg:top-6 space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Pengaturan Umum
                    </h2>

                    <div class="space-y-4">
                        <div>
                            <label for="visitors" class="block text-sm font-medium text-gray-700 mb-1">Judul Tes</label>
                            <input type="text" id="visitors"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                placeholder="Contoh: Ujian Akhir Semester" value="{{ old('title', $test->title ?? '') }}"
                                required />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi & Instruksi</label>
                            <textarea name="description" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Jelaskan instruksi pengerjaan..." required>{{ old('description', $test->description ?? '') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Durasi Pengerjaan</label>
                            <div class="score-wrapper flex items-center">
                                <button type="button"
                                    class="btn-minus w-10 h-10 bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-l-lg flex items-center justify-center transition">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4">
                                        </path>
                                    </svg>
                                </button>
                                <input type="number" name="duration"
                                    class="score-input h-10 w-full text-center border-y border-gray-300 text-gray-900 text-sm focus:ring-0 focus:border-gray-300"
                                    value="{{ old('duration', $test->duration ?? 60) }}" required />
                                <button type="button"
                                    class="btn-plus w-10 h-10 bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-r-lg flex items-center justify-center transition">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </button>
                            </div>
                            <p class="text-xs text-gray-500 mt-1 text-right">Satuan: Menit</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">

                <div class="grid grid-cols-2 gap-4">
                    <button @click="addMultipleChoice()" type="button"
                        class="flex flex-col items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-xl hover:border-indigo-500 hover:bg-indigo-50 transition group">
                        <div class="p-2 bg-indigo-100 rounded-full mb-2 group-hover:bg-indigo-200">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="font-semibold text-gray-700 text-sm group-hover:text-indigo-700">Pilihan Ganda</span>
                    </button>
                    <button @click="addEssay()" type="button"
                        class="flex flex-col items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-xl hover:border-pink-500 hover:bg-pink-50 transition group">
                        <div class="p-2 bg-pink-100 rounded-full mb-2 group-hover:bg-pink-200">
                            <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16m-7 6h7"></path>
                            </svg>
                        </div>
                        <span class="font-semibold text-gray-700 text-sm group-hover:text-pink-700">Uraian / Essay</span>
                    </button>
                </div>

                <div class="space-y-4">
                    <template x-for="(q, index) in questions" :key="q.id">
                        <div
                            class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden transition hover:shadow-md">

                            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                                <div class="flex items-center gap-3">
                                    <span
                                        class="flex items-center justify-center w-6 h-6 rounded-full bg-gray-200 text-xs font-bold text-gray-600"
                                        x-text="index + 1"></span>
                                    <span class="px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wider"
                                        :class="q.type === 'mcq' ? 'bg-indigo-100 text-indigo-700' :
                                            'bg-pink-100 text-pink-700'"
                                        x-text="q.type === 'mcq' ? 'Pilihan Ganda' : 'Uraian'">
                                    </span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <button @click="moveUp(index)" :disabled="index === 0"
                                        class="p-1 text-gray-400 hover:text-gray-700 disabled:opacity-30 transition"
                                        title="Naik">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 15l7-7 7 7"></path>
                                        </svg>
                                    </button>
                                    <button @click="moveDown(index)" :disabled="index === questions.length - 1"
                                        class="p-1 text-gray-400 hover:text-gray-700 disabled:opacity-30 transition"
                                        title="Turun">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <div class="w-px h-4 bg-gray-300 mx-1"></div>
                                    <button @click="removeQuestion(index)"
                                        class="p-1 text-gray-400 hover:text-red-600 transition" title="Hapus Soal">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="p-5">
                                <div class="mb-4">
                                    <textarea x-model="q.question" rows="2"
                                        class="block w-full text-sm text-gray-900 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-indigo-500 placeholder-gray-400 resize-none transition"
                                        placeholder="Tuliskan pertanyaan disini..."></textarea>
                                </div>

                                <template x-if="q.type === 'mcq'">
                                    <div class="space-y-3 bg-gray-50 p-4 rounded-lg">
                                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Opsi
                                            Jawaban (Pilih Kunci Jawaban)</p>
                                        <template x-for="(opt, optIndex) in q.options" :key="optIndex">
                                            <div class="flex items-center gap-3 group">
                                                <input type="radio" :name="'correct-' + q.id" :value="optIndex"
                                                    x-model="q.answer"
                                                    class="w-4 h-4 text-indigo-600 bg-white border-gray-300 focus:ring-indigo-500 cursor-pointer">
                                                <input type="text" x-model="q.options[optIndex]"
                                                    placeholder="Tulis pilihan jawaban..."
                                                    class="flex-1 text-sm border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 w-full">
                                                <button @click="removeOption(q, optIndex)"
                                                    class="text-gray-300 hover:text-red-500 transition opacity-0 group-hover:opacity-100">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </template>
                                        <button @click="addOption(q)"
                                            class="mt-2 text-xs font-medium text-indigo-600 hover:text-indigo-800 flex items-center gap-1 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4"></path>
                                            </svg>
                                            Tambah Opsi Lain
                                        </button>
                                    </div>
                                </template>

                                <template x-if="q.type === 'essay'">
                                    <div class="flex items-center gap-3 bg-pink-50 p-3 rounded-lg border border-pink-100">
                                        <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                        <span class="text-sm text-pink-700 font-medium">Batas Maksimal Karakter:</span>
                                        <input type="number" x-model="q.maxWords"
                                            class="w-20 text-sm border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500 text-center"
                                            placeholder="100">
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>

                    <div x-show="questions.length === 0"
                        class="text-center py-12 border-2 border-dashed border-gray-300 rounded-xl">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada pertanyaan</h3>
                        <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan tipe soal di atas.</p>
                    </div>
                </div>
            </div>

        </div>

        <form id="testForm" @submit.prevent="submitData" class="hidden">
            <button id="triggerSave" type="submit">Simpan</button>
        </form>

    </div>

    <script>
        const MIN = 0,
            MAX = 180;
        document.querySelectorAll('.score-wrapper').forEach(wrapper => {
            const input = wrapper.querySelector('.score-input');
            const btnPlus = wrapper.querySelector('.btn-plus');
            const btnMinus = wrapper.querySelector('.btn-minus');

            function updateButtons(v) {
                btnMinus.disabled = v <= MIN;
                btnPlus.disabled = v >= MAX;
                btnMinus.classList.toggle("opacity-50", btnMinus.disabled);
                btnPlus.classList.toggle("opacity-50", btnPlus.disabled);
            }
            btnPlus.addEventListener('click', () => {
                let v = parseInt(input.value) || 0;
                if (v < MAX) {
                    input.value = ++v;
                    updateButtons(v);
                }
            });
            btnMinus.addEventListener('click', () => {
                let v = parseInt(input.value) || 0;
                if (v > MIN) {
                    input.value = --v;
                    updateButtons(v);
                }
            });
            input.addEventListener('input', () => {
                let v = parseInt(input.value);
                if (isNaN(v)) v = MIN;
                if (v < MIN) v = MIN;
                if (v > MAX) v = MAX;
                input.value = v;
                updateButtons(v);
            });
            updateButtons(parseInt(input.value) || 0);
        });

        function testBuilder(dbQuestions, dbType) {
            return {
                test_type: dbType,
                questions: dbQuestions,

                addMultipleChoice() {
                    this.questions.push({
                        id: Date.now() + Math.random(),
                        type: 'mcq',
                        question: '',
                        options: ['', ''],
                        answer: null
                    });
                },
                addEssay() {
                    this.questions.push({
                        id: Date.now() + Math.random(),
                        type: 'essay',
                        question: '',
                        maxWords: 100
                    });
                },
                removeQuestion(index) {
                    this.questions.splice(index, 1);
                },
                addOption(q) {
                    q.options.push('');
                },
                removeOption(q, index) {
                    q.options.splice(index, 1);
                },
                moveUp(index) {
                    if (index === 0) return;
                    [this.questions[index - 1], this.questions[index]] = [this.questions[index], this.questions[index - 1]];
                },
                moveDown(index) {
                    if (index === this.questions.length - 1) return;
                    [this.questions[index], this.questions[index + 1]] = [this.questions[index + 1], this.questions[index]];
                },

                submitData() {
                    const form = document.createElement('form');
                    form.method = 'POST';

                    @if (isset($test))
                        form.action = '{{ route('buat-test.update', $test->id) }}';
                        const m = document.createElement('input');
                        m.type = 'hidden';
                        m.name = '_method';
                        m.value = 'PUT';
                        form.appendChild(m);
                    @else
                        form.action = '{{ route('buat-test.store') }}';
                    @endif

                    const t = document.createElement('input');
                    t.type = 'hidden';
                    t.name = '_token';
                    t.value = '{{ csrf_token() }}';
                    form.appendChild(t);

                    // Ambil data dari input manual
                    const title = document.createElement('input');
                    title.type = 'hidden';
                    title.name = 'title';
                    title.value = document.getElementById('visitors').value;
                    form.appendChild(title);

                    const typeInput = document.createElement('input');
                    typeInput.type = 'hidden';
                    typeInput.name = 'test_type';
                    typeInput.value = this.test_type;
                    form.appendChild(typeInput);

                    const desc = document.createElement('input');
                    desc.type = 'hidden';
                    desc.name = 'description';
                    desc.value = document.querySelector('textarea[name=description]').value;
                    form.appendChild(desc);

                    const dur = document.createElement('input');
                    dur.type = 'hidden';
                    dur.name = 'duration';
                    dur.value = document.querySelector('input[name=duration]').value;
                    form.appendChild(dur);

                    this.questions.forEach(q => {
                        const i = document.createElement('input');
                        i.type = 'hidden';
                        i.name = 'questions[]';
                        i.value = JSON.stringify(q);
                        form.appendChild(i);
                    });

                    document.body.appendChild(form);
                    form.submit();
                }
            };
        }
    </script>
@endsection
