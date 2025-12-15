<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AnnouncementAsistenController extends Controller
{

    public function index()
    {
        $announcements = Announcement::all();
        return view('dashboard.asisten.pengumuman.index', compact('announcements'));
    }


    public function store(Request $request)
    {
        $messages = [
            'content.required' => 'Isi pesan terlebih dahulu.',
            'file_location.mimetypes' => 'Periksa format file terlebih dahulu',
            'file_location.max' => 'Ukuran file maksimal 10MB'
        ];

        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
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
            $filePath = $request->file('file_location')->store('announcement_files', 'public');
        }
        


        Announcement::create([
            'content'    => $request->content,
            'file_location' => $filePath, 
            'user_id'    => Auth::id(),
        ]);


        return redirect()->route('pengumuman-asisten.index')->with('success', 'Pengumuman berhasil diunggah');
    }

    public function update(Request $request, string $id)
    {
        $announcement = Announcement::findOrFail($id);
    
        $messages = [
            'content.required' => 'Isi pesan terlebih dahulu.',
            'file_location.mimetypes' => 'Periksa format file terlebih dahulu',
            'file_location.max' => 'Ukuran file maksimal 10MB'
        ];
    
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
            'file_location' => 'nullable|mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,image/jpeg,image/png,audio/mpeg,audio/wav|max:10000'

        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Periksa kembali input Anda!');
        }
    
        $announcement->content = $request->content;
    
        if ($request->hasFile('file_location')) {
    
            if ($announcement->file_location) {
                Storage::disk('public')->delete($announcement->file_location);
            }
    
            $filePath = $request->file('file_location')->store('announcement_files', 'public');
    
            $announcement->file_location = $filePath;
        }
    
        $announcement->save();
    
        return redirect()
            ->route('pengumuman-asisten.index')
            ->with('success', 'Pengumuman berhasil diperbarui');
    }
    

    public function destroy(string $id)
    {
        $announcement = Announcement::findOrFail($id);
    
        if($announcement->file_location){
            Storage::disk('public')->delete($announcement->file_location);
            $publicPath = public_path($announcement->file_location);
            if(file_exists($publicPath)){
                unlink($publicPath);
            }
        }

        $announcement->delete();
    
        return redirect()->back()->with('success', 'Pengumuman berhasil dihapus');
    }
}
