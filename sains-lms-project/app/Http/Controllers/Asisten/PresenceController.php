<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use App\Models\Halaqah;
use App\Models\Meeting;
use App\Models\Presence;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresenceController extends Controller
{

    public function index(Request $request)
    {
        $meetingName = $request->meeting_name;
        $halaqahName = $request->halaqah_name;
    
        $selectedMeeting = Meeting::where('meeting_name', $meetingName)->first();
        $selectedHalaqah = Halaqah::where('halaqah_name', $halaqahName)->first();
    
        $todayDate = Carbon::today()->toDateString();
        $presences = Presence::where('meeting_id', $selectedMeeting->id)
        ->where('halaqah_id', $selectedHalaqah->id)
        ->get()
        ->keyBy('user_id');

    
        $praktikans = $selectedHalaqah
            ? $selectedHalaqah->users()->where('role', 'praktikan')->get()
            : collect();
    
        return view('dashboard.asisten.presensi.index', compact('todayDate', 'selectedHalaqah', 'selectedMeeting', 'praktikans', 'presences'));
    }
    


    public function store(Request $request)
    {
        $validated = $request->validate([
            'halaqah_id' => 'required|exists:halaqahs,id',
            'meeting_id' => 'required|exists:meetings,id',
            'presence' => 'required|array',
        ]);
    
        $halaqahId = $request->halaqah_id;
        $meetingId = $request->meeting_id;
    
        foreach ($validated['presence'] as $presenceData) {
    
            Presence::updateOrCreate(
                [
                    'halaqah_id' => $halaqahId,
                    'meeting_id' => $meetingId,
                    'user_id'    => $presenceData['user_id'],
                ],
                [
                    'status'      => $presenceData['status'] ?? null,
                    'description' => $presenceData['description'] ?? null,
                ]
            );
        }
    
        return back()->with('success', 'Presensi berhasil disimpan!');
    }
    
}
