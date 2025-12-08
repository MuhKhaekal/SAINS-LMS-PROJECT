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
    public function create()
    {
        $test = Test::with(['questions.options'])
                    ->first();

        $jsQuestions = [];

        if ($test) {
            foreach ($test->questions as $q) {
                $optionsText = [];
                $correctIndex = null; 

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
                    'maxWords' => 100 
                ];
            }
        }

        return view('dashboard.admin.test.create', compact('test', 'jsQuestions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string',
            'description' => 'nullable|string',
            'duration'    => 'required|integer|min:1',
            'questions'   => 'required|array',
        ]);
    
        $test = Test::create([
            'user_id'     => Auth::id(),
            'title'       => $data['title'],
            'duration'    => $data['duration'],
            'description' => $data['description'] ?? null,
        ]);
    
        foreach ($data['questions'] as $index => $q) {
    
            $q = json_decode($q, true);
    
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
                        'question_id' => $question->id,
                        'option_text' => $optText,
                        'is_correct'  => $optIndex == $q['answer'],
                    ]);
                }
            }
        }

        return redirect()
            ->route('pertemuan.index')
            ->with('success', 'Soal berhasil disimpan!');
    }
    

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title'       => 'required|string',
            'description' => 'nullable|string',
            'duration'    => 'required|integer|min:1',
            'questions'   => 'required|array',
        ]);

        $test = Test::findOrFail($id);
        
        $test->update([
            'title'       => $data['title'],
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
                        'question_id' => $question->id,
                        'option_text' => $optText,
                        'is_correct'  => $optIndex == $q['answer'],
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
        $questions = Question::with('test')->get();
        
        return view('dashboard.admin.test.index', compact('questions'));
    }
}