<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use App\Models\Halaqah;
use App\Models\Meeting;
use App\Models\Question;
use App\Models\Test;
use App\Models\TestSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AsistenTestController extends Controller
{
    use AuthorizesRequests;

    public function indexPretest(Request $request)
    {
        // Ambil parameter dari query
        $meetingName = $request->meeting_name;
        $halaqahName = $request->halaqah_name;
    
        // Cari meeting dan halaqah berdasarkan nama
        $selectedMeeting = Meeting::where('meeting_name', $meetingName)->first();
        $selectedHalaqah = Halaqah::where('halaqah_name', $halaqahName)->first();
    
        // Authorization (hanya jika halaqah ditemukan)
        if ($selectedHalaqah) {
            $this->authorize('view', $selectedHalaqah);
        }
    
        // Ambil test pretest pertama
        $tests = Test::where('test_type', 'pretest')->first();
    
        // Jika belum ada test, hindari error
        if (!$tests) {
            return view('dashboard.asisten.tests.pretest.index', compact(
                'selectedMeeting',
                'selectedHalaqah'
            ))->with('error', 'Belum ada pretest yang dibuat!');
        }
    
        // Ambil halaqah ID yang sedang digunakan user asisten
        $halaqahId = null;
        if (Auth::check()) {
            $halaqahId = User::find(Auth::id())->halaqahs()->first()->id ?? null;
        }
    
        // Ambil test session untuk menentukan apakah test sedang dibuka
        $testSession = null;
        if ($halaqahId) {
            $testSession = TestSession::where('test_id', $tests->id)
                ->where('halaqah_id', $halaqahId)
                ->first();
        }

        $questions = Question::whereHas('test', function ($q) {
            $q->where('test_type', 'pretest');
        })->get();
    
        return view('dashboard.asisten.tests.pretest.index', compact(
            'selectedMeeting',
            'selectedHalaqah',
            'tests',
            'testSession',
            'questions',
        ));
    }
    

    public function open($id)
    {
        $test = Test::findOrFail($id);
    
        $halaqahId = User::find(Auth::id())->halaqahs()->first()->id;
    
        TestSession::updateOrCreate(
            [
                'test_id' => $id,
                'halaqah_id' => $halaqahId,
            ],
            [
                'is_open' => true,
                'opened_at' => now(),
            ]
        );
    
        return back()->with('success', 'Test berhasil dibuka untuk praktikan');
    }

    public function close($id)
{
    $test = Test::findOrFail($id);

    $halaqahId = User::find(Auth::id())->halaqahs()->first()->id;

    TestSession::updateOrCreate(
        [
            'test_id' => $id,
            'halaqah_id' => $halaqahId,
        ],
        [
            'is_open' => false,
            'closed_at' => now(),
        ]
    );

    return back()->with('success', 'Test berhasil ditutup');
}

    

}
