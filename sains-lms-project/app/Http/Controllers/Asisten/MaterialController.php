<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use App\Models\Halaqah;
use App\Models\Material;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
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

        $materials = Material::where('meeting_id', $selectedMeeting->id)
            ->where('halaqah_id', $selectedHalaqah->id)
            ->get();

        return view('dashboard.asisten.materi.index', compact(
            'selectedMeeting',
            'selectedHalaqah',
            'materials'
        ));
    }


    public function store(Request $request)
    {
        $messages = [
            'material_name.required' => 'Judul materi wajib diisi.',
            'description.required' => 'Deskripsi materi wajib diisi.',
            'file_location.mimetypes' => 'Periksa format file terlebih dahulu',
            'file_location.max' => 'Ukuran file maksimal 10MB'
        ];

        $validator = Validator::make($request->all(), [
            'material_name' => 'required|string',
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
            // simpan di storage public
            $filePath = $request->file('file_location')->store('material_files', 'public');

            // copy ke public agar bisa dibuka iframe
            // ⬅️ PERUBAHAN
            $storagePath = storage_path('app/public/' . $filePath);
            $publicPath = public_path($filePath);
            if (!file_exists(dirname($publicPath))) {
                mkdir(dirname($publicPath), 0777, true);
            }
            copy($storagePath, $publicPath);
        }

        $selectedMeeting = Meeting::find($request->meeting_id);
        $selectedHalaqah = Halaqah::find($request->halaqah_id);

        Material::create([
            'material_name' => $request->material_name,
            'description' => $request->description,
            'file_location' => $filePath,
            'meeting_id' => $request->meeting_id,
            'halaqah_id' => $request->halaqah_id,
        ]);

        return redirect()->route('materi-asisten.index', [
            'meeting_name' => $selectedMeeting->meeting_name,
            'halaqah_name' => $selectedHalaqah->halaqah_name,
        ])->with('success', 'Materi berhasil diunggah');
    }


    public function show(Material $materi_asisten)
    {
        return view('dashboard.asisten.materi.show', [
            'material' => $materi_asisten
        ]);
    }


    public function update(Request $request, string $id)
    {
        $material = Material::findOrFail($id);

        $messages = [
            'material_name.required' => 'Judul materi wajib diisi.',
            'description.required' => 'Deskripsi materi wajib diisi.',
            'file_location.mimetypes' => 'Periksa format file terlebih dahulu',
            'file_location.max' => 'Ukuran file maksimal 10MB'
        ];

        $validator = Validator::make($request->all(), [
            'material_name' => 'required|string',
            'description' => 'required|string',
            'file_location' => 'nullable|mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,image/jpeg,image/png,audio/mpeg,audio/wav|max:10000',

        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Periksa kembali input Anda!');
        }

        $filePath = $material->file_location;

        if ($request->hasFile('file_location')) {

            // Hapus file lama (storage + public)
            // ⬅️ PERUBAHAN
            if ($material->file_location) {
                Storage::disk('public')->delete($material->file_location);

                $publicPath = public_path($material->file_location);
                if (file_exists($publicPath)) {
                    unlink($publicPath);
                }
            }

            // Upload baru
            $filePath = $request->file('file_location')->store('material_files', 'public');

            // Copy ke public
            // ⬅️ PERUBAHAN
            $storagePath = storage_path('app/public/' . $filePath);
            $publicPath = public_path($filePath);
            if (!file_exists(dirname($publicPath))) {
                mkdir(dirname($publicPath), 0777, true);
            }
            copy($storagePath, $publicPath);
        }

        $material->update([
            'material_name' => $request->material_name,
            'description' => $request->description,
            'file_location' => $filePath,
        ]);

        return back()->with('success', 'Materi berhasil diperbarui');
    }


    public function destroy(string $id)
    {
        $material = Material::findOrFail($id);


        if ($material->file_location) {
            Storage::disk('public')->delete($material->file_location);

            $publicPath = public_path($material->file_location);
            if (file_exists($publicPath)) {
                unlink($publicPath);
            }
        }

        $material->delete();

        return redirect()->back()->with('success', 'Materi berhasil dihapus');
    }
}
