@extends('dashboard.admin.admin-base')

@section('page-title', 'SAINS - Pengumuman')

@section('content')
    <section class="mt-20 md:mt-6 md:mx-12 bg-white p-4 border rounded-md shadow-inner">

        <div class="flex flex-col md:flex-row justify-between items-center border-b">
            <div class="">
                <h1 class="font-extrabold text-2xl ">{{ isset($test) ? 'Edit Soal Test' : 'Buat Test Baru' }}</h1>
                <h1 class="text-sm mt-1">Buat atau edit soal ujian dengan pilihan ganda dan uraian</h1>
            </div>
            <div class="my-4 md:my-0">
                <a href="{{ route('questions.review-pretest') }}"
                    class="inline-flex uppercase items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-normal text-xs text-white tracking-widest hover:bg-green-600 transition ease-in-out duration-150">Preview</a>
            </div>
        </div>

        <script>
            window.existingQuestions = @json($jsQuestions ?? []);
            window.existingType = @json($test->test_type ?? 'pretest');
        </script>

        <div x-data="testBuilder(window.existingQuestions, window.existingType)">

            <div class="p-4 border-b">
                <h1 class="font-bold">Pengaturan Tes</h1>

                <div class="mt-2">
                    <p class="text-xs mt-2">Judul Tes</p>
                    <input type="text" id="visitors"
                        class="bg-neutral-secondary-medium border rounded-md text-heading text-xs rounded-base focus:ring-brand focus:border-brand block w-full px-2.5 py-2 shadow-xs placeholder:text-body mt-1"
                        placeholder="Pre-test" value="{{ old('title', $test->title ?? '') }}" required />
                </div>

                <div class="mt-2">
                    <p class="text-xs mt-2">Tipe Tes</p>
                    <select name="test_type" class="border rounded p-2 w-full mt-1 text-xs" x-model="test_type">
                        <option value="pretest">Pretest</option>
                        <option value="posttest">Posttest</option>
                    </select>
                </div>

                <div class="mt-2">
                    <p class="text-xs mt-2">Deskripsi</p>
                    <textarea name="description" cols="30" rows="4"
                        class="bg-neutral-secondary-medium border rounded-md text-heading rounded-base focus:ring-brand focus:border-brand block w-full px-2.5 py-2 shadow-xs placeholder:text-body mt-1 text-xs"
                        placeholder="Isi deskripsi disini ..." required>{{ old('description', $test->description ?? '') }}</textarea>
                </div>

                <div class="mt-2">
                    <p class="text-xs mt-2">Durasi Tes</p>
                    <div class="flex items-center gap-x-2 mt-1">
                        <div class="score-wrapper relative flex items-center max-w-[9rem] shadow rounded-base">
                            <button type="button"
                                class="btn-minus text-body bg-gray-200 border border-gray-300 hover:bg-gray-300 rounded-l-base h-6 px-2 text-sm">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="1" d="M5 12h14" />
                                </svg>
                            </button>

                            <input type="text" name="duration"
                                class="score-input h-6 w-full text-center text-xs border-y border-gray-300 bg-gray-100"
                                value="{{ old('duration', $test->duration ?? 0) }}" required />

                            <button type="button"
                                class="btn-plus text-body bg-gray-200 border border-gray-300 hover:bg-gray-300 rounded-r-base h-6 px-2 text-sm">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="1"
                                        d="M5 12h14m-7 7V5" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-xs">menit</p>
                    </div>
                </div>
            </div>

            <div class="p-4">
                <h1 class="font-bold text-lg">Kelola Pertanyaan</h1>
                <p class="text-xs font-light p-4 bg-blue-50 rounded-md mt-2">
                    <span class="font-bold">Tips:</span> Isi semua pertanyaan dan tentukan jawaban sebelum menyimpan test.
                </p>

                <div class="flex mt-2 gap-x-2">
                    <div @click="addMultipleChoice()"
                        class="border border-dashed border-gray-300 rounded-md p-2 flex-1 cursor-pointer hover:bg-gray-100">
                        <p class="text-xs text-center font-semibold">+ Pilihan Ganda</p>
                    </div>
                    <div @click="addEssay()"
                        class="border border-dashed border-gray-300 rounded-md p-2 flex-1 cursor-pointer hover:bg-gray-100">
                        <p class="text-xs text-center font-semibold">+ Uraian</p>
                    </div>
                </div>

                <div class="mt-4 space-y-4">
                    <template x-for="(q, index) in questions" :key="q.id">
                        <div class="border rounded-md p-4 bg-white shadow">

                            <div class="flex justify-between items-center">
                                <div class="flex items-center gap-2">
                                    <button @click="moveUp(index)" :disabled="index === 0"
                                        class="text-gray-600 disabled:opacity-30 hover:text-black text-xs font-bold">▲</button>
                                    <button @click="moveDown(index)" :disabled="index === questions.length - 1"
                                        class="text-gray-600 disabled:opacity-30 hover:text-black text-xs font-bold">▼</button>
                                    <h2 class="font-semibold text-sm"
                                        x-text="q.type === 'mcq' ? 'Pilihan Ganda' : 'Uraian'"></h2>
                                </div>
                                <button type="button" @click="removeQuestion(index)">
                                    <svg class="w-7 h-7 text-secondary bg-red-500 hover:bg-red-600 hover:text-white rounded-md p-1"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>


                            <template x-if="q.type === 'mcq'">
                                <div>
                                    <input type="text" x-model="q.question" placeholder="Masukkan pertanyaan..."
                                        class="w-full border rounded mt-3 p-2 text-sm" />
                                    <div class="mt-3 space-y-2">
                                        <template x-for="(opt, optIndex) in q.options" :key="optIndex">
                                            <div class="flex items-center gap-2">
                                                <input type="radio" :name="'correct-' + q.id" :value="optIndex"
                                                    x-model="q.answer">
                                                <input type="text" x-model="q.options[optIndex]"
                                                    placeholder="Pilihan jawaban..."
                                                    class="flex-1 border rounded p-2 text-sm" />
                                                <button @click="removeOption(q, optIndex)"
                                                    class="text-red-400 text-xs">x</button>
                                            </div>
                                        </template>
                                        <button @click="addOption(q)" class="text-blue-600 text-xs mt-2 hover:underline">+
                                            Tambah Pilihan</button>
                                    </div>
                                </div>
                            </template>

                            <template x-if="q.type === 'essay'">
                                <div>
                                    <input type="text" x-model="q.question"
                                        placeholder="Masukkan pertanyaan uraian..."
                                        class="w-full border rounded mt-3 p-2 text-sm" />
                                    <div class="flex items-center mt-3 gap-x-2">
                                        <p class="text-xs">Batas jawaban: </p>
                                        <input type="number" x-model="q.maxWords"
                                            class="w-14 border rounded p-2 text-sm" />
                                        <p class="text-xs">karakter</p>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>


                <div class="flex justify-end">
                    <form id="testForm" @submit.prevent="submitData">
                        @csrf
                        @if (isset($test))
                            @method('PUT')
                        @endif
                        <x-primary-button
                            class="mt-5">{{ isset($test) ? 'Update Soal' : 'Simpan Soal' }}</x-primary-button>
                    </form>
                </div>
            </div>
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
                        v++;
                        input.value = v;
                        updateButtons(v);
                    }
                });
                btnMinus.addEventListener('click', () => {
                    let v = parseInt(input.value) || 0;
                    if (v > MIN) {
                        v--;
                        input.value = v;
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
    </section>
@endsection
