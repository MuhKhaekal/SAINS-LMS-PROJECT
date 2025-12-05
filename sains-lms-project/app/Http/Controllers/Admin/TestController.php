<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */

     public function create()
    {
        // Cari data pretest yang sudah ada
        $test = Test::with(['questions.options'])
                    ->where('test_type', 'pretest')
                    ->first();

        $jsQuestions = [];

        // Jika data ditemukan, format ulang untuk Javascript
        if ($test) {
            foreach ($test->questions as $q) {
                $optionsText = [];
                $correctIndex = null; // Default null jika essay

                if ($q->type === 'mcq') {
                    foreach ($q->options as $idx => $opt) {
                        $optionsText[] = $opt->option_text;
                        if ($opt->is_correct) {
                            $correctIndex = $idx;
                        }
                    }
                }

                $jsQuestions[] = [
                    'id'       => $q->id,
                    'type'     => $q->type,
                    'question' => $q->question,
                    'options'  => $q->type === 'mcq' ? $optionsText : [''],
                    'answer'   => $correctIndex, 
                    'maxWords' => 100 // Atau ambil dari DB jika ada kolomnya
                ];
            }
        }

        // Kirim $test dan $jsQuestions ke view
        // Jika $test null (belum ada data), blade akan menangani form kosong
        return view('dashboard.admin.test.create', compact('test', 'jsQuestions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'test_type' => 'required|in:pretest,posttest',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:1',
            'questions' => 'required|array',
        ]);
    
        $test = Test::create([
            'user_id'    => Auth::id(),
            'title'      => $data['title'],
            'test_type'  => $data['test_type'],
            'duration' => $data['duration'],
            'description'=> $data['description'] ?? null,
        ]);
    
        foreach ($data['questions'] as $index => $q) {
    
            $q = json_decode($q, true);
    
            $question = Question::create([
                'test_id'       => $test->id,
                'user_id'       => Auth::id(),
                'type'          => $q['type'],        
                'question'      => $q['question'],
                'correct_answer'=> $q['type'] === 'essay' ? null : ($q['answer'] ?? null),
                'order_number'  => $index + 1,       
            ]);
    
            if ($q['type'] === 'mcq') {
    
                foreach ($q['options'] as $optIndex => $optText) {
    
                    QuestionOption::create([
                        'question_id'  => $question->id,
                        'option_text'  => $optText,
                        'is_correct'   => $optIndex == $q['answer'],
                    ]);
                }
            }
        }
        return redirect()
            ->route('pertemuan.index')
            ->with('success', 'Soal berhasil disimpan!');
            
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'test_type' => 'required|in:pretest,posttest',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:1',
            'questions' => 'required|array',
        ]);

        $test = Test::findOrFail($id);
        
        $test->update([
            'title'       => $data['title'],
            'test_type'   => $data['test_type'],
            'duration'    => $data['duration'],
            'description' => $data['description'] ?? null,
        ]);

        foreach($test->questions as $q){
            if($q->type == 'mcq') $q->options()->delete();
            $q->delete();
        }

        foreach ($data['questions'] as $index => $qRaw) {
            $q = json_decode($qRaw, true);
    
            $question = Question::create([
                'test_id'        => $test->id,
                'user_id'        => Auth::id(),
                'type'           => $q['type'],        
                'question'       => $q['question'],
                'correct_answer' => $q['type'] === 'essay' ? null : ($q['answer'] ?? null),
                'order_number'   => $index + 1,        
            ]);
    
            if ($q['type'] === 'mcq') {
                foreach ($q['options'] as $optIndex => $optText) {
                    QuestionOption::create([
                        'question_id'  => $question->id,
                        'option_text'  => $optText,
                        'is_correct'   => $optIndex == $q['answer'],
                    ]);
                }
            }
        }

        return redirect()
            ->route('pertemuan.index') 
            ->with('success', 'Soal berhasil diperbarui!');
    }


    public function destroy(string $id)
    {
        $question = Question::with('options')->findOrFail($id);

        if ($question->type === 'mcq') {
            $question->options()->delete();
        }


        $question->delete();

        return back()->with('success', 'Soal berhasil dihapus!');
    }

    public function reviewPretest()
    {
        $questions = Question::whereHas('test', function ($q) {
            $q->where('test_type', 'pretest');
        })->get();
        
        return view('dashboard.admin.test.pretest.index', compact('questions'));
    }
}
