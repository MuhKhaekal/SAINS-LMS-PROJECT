<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use App\Models\Halaqah;
use App\Models\Assignment;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AssignmentController extends Controller
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

        return view('dashboard.asisten.tugas.index', compact(
            'selectedMeeting',
            'selectedHalaqah',
            'assignments'
        ));
    }


    public function store(Request $request)
    {
        $messages = [
            'assignment_name.required' => 'Judul materi wajib diisi.',
            'description.required' => 'Deskripsi materi wajib diisi.',
            'file_location.mimetypes' => 'Periksa format file terlebih dahulu',
            'file_location.max' => 'Ukuran file maksimal 10MB'
        ];

        $validator = Validator::make($request->all(), [
            'assignment_name' => 'required|string',
            'description' => 'required|string',
            'file_location' => 'nullable|mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,image/jpeg,image/png,audio/mpeg,audio/wav|max:10000',

        
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Periksa kembali input Anda!');
        }

        $filePath = null;

        if ($request->hasFile('file_location')) {
            $filePath = $request->file('file_location')->store('assignment_files', 'public');

            $storagePath = storage_path('app/public/' . $filePath);
            $publicPath = public_path($filePath);
            if (!file_exists(dirname($publicPath))) {
                mkdir(dirname($publicPath), 0777, true);
            }
            copy($storagePath, $publicPath);
        }

        $selectedMeeting = Meeting::find($request->meeting_id);
        $selectedHalaqah = Halaqah::find($request->halaqah_id);

        Assignment::create([
            'assignment_name' => $request->assignment_name,
            'description' => $request->description,
            'file_location' => $filePath,
            'meeting_id' => $request->meeting_id,
            'halaqah_id' => $request->halaqah_id,
        ]);

        return redirect()->route('tugas-asisten.index', [
            'meeting_name' => $selectedMeeting->meeting_name,
            'halaqah_name' => $selectedHalaqah->halaqah_name,
        ])->with('success', 'Tugas berhasil diunggah');
    }


    public function show(Assignment $tugas_asisten)
    {
        return view('dashboard.asisten.tugas.show', [
            'assignment' => $tugas_asisten
        ]);
    }


    public function update(Request $request, string $id)
    {
        $assignment = Assignment::findOrFail($id);

        $messages = [
            'assignment_name.required' => 'Judul materi wajib diisi.',
            'description.required' => 'Deskripsi materi wajib diisi.',
            'file_location.mimetypes' => 'Periksa format file terlebih dahulu',
            'file_location.max' => 'Ukuran file maksimal 10MB'
        ];

        $validator = Validator::make($request->all(), [
            'assignment_name' => 'required|string',
            'description' => 'required|string',
            'file_location' => 'nullable|mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,image/jpeg,image/png,audio/mpeg,audio/wav|max:10000'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Periksa kembali input Anda!');
        }

        $filePath = $assignment->file_location;

        if ($request->hasFile('file_location')) {

            if ($assignment->file_location) {
                Storage::disk('public')->delete($assignment->file_location);

                $publicPath = public_path($assignment->file_location);
                if (file_exists($publicPath)) {
                    unlink($publicPath);
                }
            }

            $filePath = $request->file('file_location')->store('assignment_files', 'public');


            $storagePath = storage_path('app/public/' . $filePath);
            $publicPath = public_path($filePath);
            if (!file_exists(dirname($publicPath))) {
                mkdir(dirname($publicPath), 0777, true);
            }
            copy($storagePath, $publicPath);
        }

        $assignment->update([
            'assignment_name' => $request->assignment_name,
            'description' => $request->description,
            'file_location' => $filePath,
        ]);

        return back()->with('success', 'Tugas berhasil diperbarui');
    }


    public function destroy(string $id)
    {
        $assignment = Assignment::findOrFail($id);


        if ($assignment->file_location) {
            Storage::disk('public')->delete($assignment->file_location);

            $publicPath = public_path($assignment->file_location);
            if (file_exists($publicPath)) {
                unlink($publicPath);
            }
        }

        $assignment->delete();

        return redirect()->back()->with('success', 'Tugas berhasil dihapus');
    }
}
