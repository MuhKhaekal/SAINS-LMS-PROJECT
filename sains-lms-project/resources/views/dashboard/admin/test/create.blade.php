@extends('dashboard.admin.admin-base')

@section('page-title', 'SAINS - Pengumuman')

@section('content')

    <script>
        var serverQuestions = @json($jsQuestions ?? []);

        console.log("Data Soal:", serverQuestions);

        document.addEventListener('alpine:init', () => {
            Alpine.data('testBuilder', () => ({
                questions: serverQuestions, 

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
                    if (!q.options) q.options = [];
                    q.options.push('');
                },
                removeOption(q, index) {
                    q.options.splice(index, 1);
                },
                moveUp(index) {
                    if (index === 0) return;
                    let temp = this.questions[index];
                    this.questions[index] = this.questions[index - 1];
                    this.questions[index - 1] = temp;
                },
                moveDown(index) {
                    if (index === this.questions.length - 1) return;
                    let temp = this.questions[index];
                    this.questions[index] = this.questions[index + 1];
                    this.questions[index + 1] = temp;
                },

                submitData() {
                    if (this.questions.length === 0) {
                        alert('Belum ada soal!');
                        return;
                    }
                    const titleInput = document.getElementById('visitors');
                    if (!titleInput.value) {
                        alert('Judul Tes wajib diisi!');
                        return;
                    }

                    const form = document.createElement('form');
                    form.method = 'POST';

                    @if (isset($test) && $test)
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

                    const addInput = (name, val) => {
                        const i = document.createElement('input');
                        i.type = 'hidden';
                        i.name = name;
                        i.value = val;
                        form.appendChild(i);
                    };

                    addInput('title', titleInput.value);
                    addInput('description', document.querySelector('textarea[name=description]').value);
                    addInput('duration', document.querySelector('input[name=duration]').value);

                    this.questions.forEach(q => {
                        addInput('questions[]', JSON.stringify(q));
                    });

                    document.body.appendChild(form);
                    form.submit();
                }
            }));
        });
    </script>

    <div x-data="testBuilder" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-14 md:mt-0">

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                <strong class="font-bold">Gagal Menyimpan!</strong>
                <ul class="mt-1 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ isset($test) ? 'Edit Soal Ujian' : 'Buat Ujian Baru' }}</h1>
                <p class="text-sm text-gray-500 mt-1">Konfigurasi detail ujian dan kelola daftar pertanyaan.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('questions.review-pretest') }}"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">Preview</a>

                <x-primary-button type="button" @click="submitData()">
                    {{ isset($test) ? 'Simpan Perubahan' : 'Simpan Ujian' }}
                </x-primary-button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <div class="lg:col-span-1 lg:sticky lg:top-6 space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Pengaturan Umum</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Tes</label>
                            <input type="text" id="visitors" value="{{ old('title', $test->title ?? '') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <textarea name="description" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300">{{ old('description', $test->description ?? '') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Durasi (Menit)</label>
                            <input type="number" name="duration" value="{{ old('duration', $test->duration ?? 60) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5">
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <button @click="addMultipleChoice()" type="button"
                        class="p-4 border-2 border-dashed border-gray-300 rounded-xl hover:border-indigo-500 hover:bg-indigo-50 flex flex-col items-center">
                        <span class="font-semibold text-gray-700 text-sm">Pilihan Ganda</span>
                    </button>
                    <button @click="addEssay()" type="button"
                        class="p-4 border-2 border-dashed border-gray-300 rounded-xl hover:border-pink-500 hover:bg-pink-50 flex flex-col items-center">
                        <span class="font-semibold text-gray-700 text-sm">Uraian / Essay</span>
                    </button>
                </div>

                <div class="space-y-4">
                    <template x-for="(q, index) in questions" :key="q.id || index">
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 transition hover:shadow-md">

                            <div class="flex justify-between items-center mb-4 pb-3 border-b border-gray-100">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="bg-gray-200 text-gray-700 text-xs font-bold w-6 h-6 flex items-center justify-center rounded-full"
                                        x-text="index + 1"></span>
                                    <span class="text-xs font-bold uppercase px-2 py-1 rounded"
                                        :class="q.type === 'mcq' ? 'bg-indigo-100 text-indigo-700' :
                                            'bg-pink-100 text-pink-700'"
                                        x-text="q.type === 'mcq' ? 'Pilihan Ganda' : 'Uraian'"></span>
                                </div>
                                <div class="flex gap-2">
                                    <button @click="moveUp(index)" class="text-gray-400 hover:text-gray-600">▲</button>
                                    <button @click="moveDown(index)" class="text-gray-400 hover:text-gray-600">▼</button>
                                    <button @click="removeQuestion(index)"
                                        class="text-red-400 hover:text-red-600">Hapus</button>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Pertanyaan</label>
                                <textarea x-model="q.question" rows="2"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            </div>

                            <template x-if="q.type === 'mcq'">
                                <div class="bg-gray-50 p-4 rounded-lg space-y-3">
                                    <p class="text-xs font-bold text-gray-500 uppercase">Opsi Jawaban (Klik bulat untuk set
                                        kunci jawaban)</p>
                                    <template x-for="(opt, optIndex) in q.options" :key="optIndex">
                                        <div class="flex items-center gap-2">
                                            <input type="radio" :name="'correct-' + q.id" :value="optIndex"
                                                x-model="q.answer"
                                                class="text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                            <input type="text" x-model="q.options[optIndex]"
                                                class="flex-1 border-gray-300 rounded-md text-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                placeholder="Opsi jawaban...">
                                            <button @click="removeOption(q, optIndex)"
                                                class="text-gray-400 hover:text-red-500">X</button>
                                        </div>
                                    </template>
                                    <button @click="addOption(q)"
                                        class="text-xs text-indigo-600 font-bold hover:underline">+ Tambah Opsi</button>
                                </div>
                            </template>

                            <template x-if="q.type === 'essay'">
                                <div class="bg-pink-50 p-3 rounded-lg flex items-center gap-2">
                                    <span class="text-sm text-pink-700">Maksimal Karakter:</span>
                                    <input type="number" x-model="q.maxWords"
                                        class="w-20 text-center border-gray-300 rounded-md text-sm">
                                </div>
                            </template>

                        </div>
                    </template>

                    <div x-show="questions.length === 0"
                        class="text-center py-10 border-2 border-dashed border-gray-300 rounded-xl">
                        <p class="text-gray-500">Belum ada soal dibuat.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
