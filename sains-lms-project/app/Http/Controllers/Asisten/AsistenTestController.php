<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use App\Models\Halaqah;
use App\Models\Meeting;
use App\Models\Test;
use App\Models\TestSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AsistenTestController extends Controller
{
    use AuthorizesRequests;

    public function indexPretest(Request $request)
    {
        $meetingName = $request->meeting_name;
        $halaqahName = $request->halaqah_name;
    
        $selectedMeeting = Meeting::where('meeting_name', $meetingName)->first();
        $selectedHalaqah = Halaqah::where('halaqah_name', $halaqahName)->first();
    
        if ($selectedHalaqah) {
            $this->authorize('view', $selectedHalaqah);
        }
    
        $test = Test::with('questions')->first();
    
        if (!$test) {
            return view('dashboard.asisten.tests.index', compact(
                'selectedMeeting',
                'selectedHalaqah'
            ))->with('error', 'Belum ada soal tes yang dibuat oleh Admin!');
        }
    
        $halaqahId = null;
        $user = Auth::user();
        
        if ($user && $user->halaqahs()->exists()) {
            $halaqahId = $user->halaqahs()->first()->id;
        }
    
        $testSession = null;
        if ($halaqahId) {
            $testSession = TestSession::where('test_id', $test->id)
                ->where('halaqah_id', $halaqahId)
                ->first();
        }

        $questions = $test->questions;
    
        return view('dashboard.asisten.tests.index', compact(
            'selectedMeeting',
            'selectedHalaqah',
            'test', 
            'testSession',
            'questions',
        ));
    }
    

    public function open($id)
    {
        $test = Test::findOrFail($id);
    
        $user = Auth::user();
        
        if (!$user->halaqahs()->exists()) {
            return back()->with('error', 'Anda belum terdaftar dalam halaqah manapun.');
        }

        $halaqahId = $user->halaqahs()->first()->id;
    
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
    
        return back()->with('success', 'Ujian berhasil dibuka untuk praktikan');
    }

    public function close($id)
    {
        $test = Test::findOrFail($id);

        $user = Auth::user();

        if (!$user->halaqahs()->exists()) {
            return back()->with('error', 'Anda belum terdaftar dalam halaqah manapun.');
        }

        $halaqahId = $user->halaqahs()->first()->id;

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

        return back()->with('success', 'Ujian berhasil ditutup');
    }

}