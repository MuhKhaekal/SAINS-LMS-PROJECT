<?php

namespace App\Http\Controllers\Praktikan;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\TestSession;
use App\Models\TestSubmission;
use App\Models\TestAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PraktikanTestController extends Controller
{
    public function index()
    {
        $test = Test::latest()->first();
    
        $session = null;
        $existingSubmission = null;
    
        if ($test) {
            $halaqahId = null;
            if (Auth::user()->halaqahs()->exists()) {
                $halaqahId = Auth::user()->halaqahs()->first()->id;
            }
    
            $session = TestSession::where('test_id', $test->id)
                ->where('halaqah_id', $halaqahId)
                ->first();
    
            $existingSubmission = TestSubmission::where('test_id', $test->id)
                ->where('user_id', Auth::id())
                ->whereNotNull('submitted_at')
                ->first();
        }
    
        return view('dashboard.praktikan.tests.index', compact('test', 'session', 'existingSubmission'));
    }

    public function start($id)
    {
        $test = Test::findOrFail($id);
        $user = Auth::user();
        
        if (!$user->halaqahs()->exists()) {
            abort(403, 'Anda tidak terdaftar pada halaqah manapun.');
        }

        $halaqahId = $user->halaqahs()->first()->id;

        $session = TestSession::where('test_id', $test->id)
            ->where('halaqah_id', $halaqahId)
            ->first();

        if (!$session || !$session->is_open) {
            return redirect()->back()->with('error', 'Test belum dibuka oleh asisten.');
        }

        $submission = TestSubmission::firstOrCreate(
            [
                'test_id' => $test->id, 
                'user_id' => $user->id
            ],
            [
                'halaqah_id' => $halaqahId,
                'started_at' => now(),
                'score' => 0
            ]
        );

        if ($submission->submitted_at) {
            return redirect()->route('ujian-praktikan.index')
                ->with('error', 'Anda sudah mengerjakan test ini.');
        }

        return redirect()->route('ujian-praktikan.take', ['submissionId' => $submission->id]);
    }

    public function take($submissionId)
    {
        $submission = TestSubmission::with('test.questions.options')
                        ->where('id', $submissionId)
                        ->where('user_id', Auth::id())
                        ->firstOrFail();

        $test = $submission->test;

        if ($submission->submitted_at) {
             return redirect()->route('ujian-praktikan.index')->with('error', 'Test sudah dikumpulkan.');
        }

        $endTime = $submission->started_at->copy()->addMinutes($test->duration);
        $remainingSeconds = now()->diffInSeconds($endTime, false);

        if ($remainingSeconds < 0) {
            $remainingSeconds = 0;
        }

        return view('dashboard.praktikan.tests.take', compact('test', 'submission', 'remainingSeconds'));
    }

    public function submit(Request $request, $testId)
    {
        $submission = TestSubmission::where('test_id', $testId)
                        ->where('user_id', Auth::id())
                        ->firstOrFail();

        if ($submission->submitted_at) {
            return redirect()->back()->with('error', 'Anda sudah mengumpulkan test ini.');
        }

        $answers = $request->input('answers', []);
        $totalScore = 0;
        $mcqCorrect = 0;

        $questions = $submission->test->questions; 
        
        $totalQuestions = $questions->count();
        $scorePerQuestion = $totalQuestions > 0 ? (100 / $totalQuestions) : 0;

        DB::transaction(function () use ($submission, $questions, $answers, $scorePerQuestion, &$totalScore, &$mcqCorrect) {
            
            foreach ($questions as $question) {
                $given = $answers[$question->id] ?? null;

                if ($question->type === 'mcq') {
                    $selectedOptionId = $given['option'] ?? null;
                    $isCorrect = false;
                    $scoreForQ = 0;

                    if ($selectedOptionId) {
                        $option = $question->options->where('id', $selectedOptionId)->first();
                        if ($option && $option->is_correct) {
                            $isCorrect = true;
                            $scoreForQ = $scorePerQuestion; 
                        }
                    }

                    TestAnswer::create([
                        'submission_id'      => $submission->id,
                        'question_id'        => $question->id,
                        'question_option_id' => $selectedOptionId,
                        'answer_text'        => null,
                        'is_correct'         => $isCorrect,
                        'score'              => $scoreForQ,
                    ]);

                    $totalScore += $scoreForQ;
                    if ($isCorrect) $mcqCorrect++;

                } else {

                    $text = $given['essay'] ?? null;
                    
                    TestAnswer::create([
                        'submission_id'      => $submission->id,
                        'question_id'        => $question->id,
                        'question_option_id' => null,
                        'answer_text'        => $text,
                        'is_correct'         => null, 
                        'score'              => 0,  
                    ]);
                }
            }

            $submission->update([
                'score'        => $totalScore,
                'submitted_at' => now(),
            ]);
        });

        return redirect()->route('ujian-praktikan.index')
            ->with('success', 'Jawaban berhasil dikumpulkan. Skor Sementara: ' . round($totalScore, 2));
    }
}