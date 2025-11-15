<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;



class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Announcement::all();
        return view('dashboard.admin.pengumuman.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'content.required' => 'Isi pesan terlebih dahulu.',
            'file_location.mimetypes' => 'Periksa format file terlebih dahulu',
            'file_location.max' => 'Ukuran file maksimal 10MB'
        ];

        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
            'file_location' => 'nullable|mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,image/jpeg,image/png,audio/mpeg,audio/wav|max:10000'

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

        dd($request->file('file_location')->getMimeType());

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil diunggah');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $announcement = Announcement::findOrFail($id);
    
        $request->validate([
            'content' => 'required|string',
            'file_location' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,mp3,wav,m4a,jpg,jpeg,png|max:10000'
        ], [
            'content.required' => 'Isi pesan terlebih dahulu.',
            'file_location.mimes' => 'Periksa format file terlebih dahulu',
            'file_location.max' => 'Ukuran file maksimal 10MB'
        ]);
    
        $filePath = $announcement->file_location; 
    
        if ($request->hasFile('file_location')) {

            if ($announcement->file_location &&
                Storage::disk('public')->exists($announcement->file_location)) {
                Storage::disk('public')->delete($announcement->file_location);
            }
    
            $filePath = $request->file('file_location')
                ->store('announcement_files', 'public');
        }
    
        $announcement->update([
            'content' => $request->content,
            'file_location' => $filePath,
            'user_id' => Auth::id()
        ]);
    
        return redirect()
            ->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();
        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil dihapus');
    }
}
