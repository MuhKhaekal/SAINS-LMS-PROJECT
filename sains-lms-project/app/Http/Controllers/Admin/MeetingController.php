<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meetings = Meeting::all();
        return view('dashboard.admin.pertemuan.index', compact('meetings'));
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
            'meeting_name.required' => 'Nama pertemuan wajib diisi.',
            'topic.required' => 'Topik pertemuan wajib diisi.',
            'type.required' => 'Type pertemuan wajib dipilih.',
            'description.required' => 'Deskripsi wajib dipilih.'
        ];
        
        $validator = Validator::make($request->all(), [
            'meeting_name' => 'required|string|max:255',
            'topic' => 'required|string|max:255',
            'type' => 'required|string',
            'description' => 'required|string',
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Periksa kembali input Anda!');
        }
    
        Meeting::create([
            'meeting_name' => $request->meeting_name,
            'topic' => $request->topic,
            'type' => $request->type,
            'description' => $request->description,
        ]);
    
        return redirect()->route('pertemuan.index')->with('success', 'Data Pertemuan berhasil ditambahkan');
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
        $messages = [
            'meeting_name.required' => 'Nama pertemuan wajib diisi.',
            'topic.required' => 'Topik pertemuan wajib diisi.',
            'type.required' => 'Type pertemuan wajib dipilih.',
            'description.required' => 'Deskripsi wajib dipilih.'
        ];
        
        $validator = Validator::make($request->all(), [
            'meeting_name' => 'required|string|max:255',
            'topic' => 'required|string|max:255',
            'type' => 'required|string',
            'description' => 'required|string',
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Periksa kembali input Anda!');
        }

        $meeting = Meeting::findOrFail($id);

        $data = [
            'meeting_name' => $request->meeting_name,
            'topic' => $request->topic,
            'type' => $request->type,
            'description' => $request->description,
        ];

        $meeting->update($data);

        return redirect()->route('pertemuan.index')->with('success', 'Data Pertemuan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $meeting = Meeting::findOrFail($id);

        $meeting->delete();
        return redirect()->route('pertemuan.index')->with('success', 'Data Pertemuan berhasil dihapus');
    }
}
