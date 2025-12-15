<?php

namespace App\Http\Controllers\Praktikan;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Halaqah;
use App\Models\Meeting;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class AssignmentPraktikanController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $meetingName = $request->meeting_name;
        $halaqahName = $request->halaqah_name;

        $selectedMeeting = Meeting::where('meeting_name', $meetingName)->first();
        $selectedHalaqah = Halaqah::where('halaqah_name', $halaqahName)->first();

        if ($selectedHalaqah) {
            $this->authorize('view', $selectedHalaqah);
        }

        
        $assignments = Assignment::where('meeting_id', $selectedMeeting->id)
            ->where('halaqah_id', $selectedHalaqah->id)
            ->get();

        $userId = Auth::id();

        $userSubmissions = Submission::where('user_id', $userId)
            ->whereIn('assignment_id', $assignments->pluck('id'))
            ->get()
            ->keyBy('assignment_id');


        return view('dashboard.praktikan.tugas.index', compact(
            'selectedMeeting',
            'selectedHalaqah',
            'assignments',
            'userSubmissions'
        ));
    }
}
