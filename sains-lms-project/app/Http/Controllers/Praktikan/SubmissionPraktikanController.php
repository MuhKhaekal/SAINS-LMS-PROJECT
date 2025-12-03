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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SubmissionPraktikanController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $meetingName = $request->meeting_name;
        $halaqahName = $request->halaqah_name;
        $assignmentId = $request->assignment_id;

        $selectedMeeting = Meeting::where('meeting_name', $meetingName)->first();
        $selectedHalaqah = Halaqah::where('halaqah_name', $halaqahName)->first();


        if ($selectedHalaqah) {
            $this->authorize('view', $selectedHalaqah);
        }

        $selectedAssignment = Assignment::find($assignmentId);
        return view('dashboard.praktikan.tugas.pengajuan.index', compact('selectedMeeting', 'selectedHalaqah', 'selectedAssignment'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $messages = [
            'description.required' => 'Deskripsi tugas wajib diisi',
            'file_location.mimetypes' => 'Periksa format file terlebih dahulu',
            'file_location.max' => 'Ukuran file maksimal 10MB'
        ];

        $validator = Validator::make($request->all(), [
            'description' => 'string|required',
            'file_location' => 'nullable|mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,image/jpeg,image/png,audio/mpeg,audio/wav|max:10000'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Periksa kembali input Anda!');
        }

        $filePath = null;

        if ($request->hasFile('file_location')) {
            $filePath = $request->file('file_location')->store('submission_files', 'public');
        }
        
        $selectedMeeting = Meeting::find($request->meeting_id);
        $selectedHalaqah = Halaqah::find($request->halaqah_id);
        $selectedAssignment = Assignment::find($request->assignment_id);

        Submission::create([
            'description'    => $request->description,
            'file_location' => $filePath, 
            'assignment_id'    => $request->assignment_id,
            'user_id'    => Auth::id(),
        ]);

        return redirect()->route('tugas-praktikan.index', [
            'meeting_name' => $selectedMeeting->meeting_name,
            'halaqah_name' => $selectedHalaqah->halaqah_name,
            'assignment_id' => $selectedAssignment->id

        ])->with('success', 'Tugas berhasil diunggah');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $submission = Submission::findOrFail($id);
    
        $assignment = Assignment::find($submission->assignment_id);
        $meeting = Meeting::find($assignment->meeting_id);
        $halaqah = Halaqah::find($assignment->halaqah_id);
    
        return view('dashboard.praktikan.tugas.pengajuan.edit', [
            'submission' => $submission,
            'selectedAssignment' => $assignment,
            'selectedMeeting' => $meeting,
            'selectedHalaqah' => $halaqah,
        ]);
    }
    


    public function update(Request $request, $id)
    {
        $messages = [
            'description.required' => 'Deskripsi tugas wajib diisi',
            'file_location.mimetypes' => 'Periksa format file terlebih dahulu',
            'file_location.max' => 'Ukuran file maksimal 10MB'
        ];
    
        $validator = Validator::make($request->all(), [
            'description' => 'string|required',
            'file_location' => 'nullable|mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,image/jpeg,image/png,audio/mpeg,audio/wav|max:10000'
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Periksa kembali input Anda!');
        }
    
        $submission = Submission::findOrFail($id);
    
        $filePath = $submission->file_location;
    
        if ($request->hasFile('file_location')) {
            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
    
            $filePath = $request->file('file_location')->store('submission_files', 'public');
        }
    
        $submission->update([
            'description' => $request->description,
            'file_location' => $filePath,
        ]);
    
        // FIXED RELATION
        $assignment = Assignment::find($submission->assignment_id);
        $meeting = Meeting::find($assignment->meeting_id);
        $halaqah = Halaqah::find($assignment->halaqah_id);
    
        return redirect()->route('tugas-praktikan.index', [
            'meeting_name' => $meeting->meeting_name,
            'halaqah_name' => $halaqah->halaqah_name,
            'assignment_id' => $assignment->id
        ])->with('success', 'Tugas berhasil diperbarui');
    }
    
    

    public function destroy(string $id)
    {
        $submission = Submission::findOrFail($id);


        if ($submission->file_location) {
            Storage::disk('public')->delete($submission->file_location);

            $publicPath = public_path($submission->file_location);
            if (file_exists($publicPath)) {
                unlink($publicPath);
            }
        }

        $submission->delete();

        return redirect()->back()->with('success', 'Tugas berhasil dihapus');
    }
}
