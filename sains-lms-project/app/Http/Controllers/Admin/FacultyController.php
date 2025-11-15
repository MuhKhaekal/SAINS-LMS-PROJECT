<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Faculty::withCount('prodies', 'halaqahs');



        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('faculty_name', 'like', '%' . $request->search . '%')
                  ->orWhere('faculty_code', 'like', '%' . $request->search . '%');
            });
        }
    
        $faculties = $query->paginate(10);
    
        return view('dashboard.admin.daftar-fakultas.index', compact('faculties'));
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
            'faculty_name.required' => 'Nama fakultas wajib diisi.',
            'faculty_code.required' => 'Kode fakultas wajib diisi.',
            'faculty_code.unique' => 'Kode fakultas ini sudah terdaftar.',
        ];
        
        $validator = Validator::make($request->all(), [
            'faculty_name' => 'required|string|max:255',
            'faculty_code' => 'required|string|max:255|unique:faculties,faculty_code',
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Periksa kembali input Anda!');
        }
    
        Faculty::create([
            'faculty_name' => $request->faculty_name,
            'faculty_code' => $request->faculty_code,
        ]);
    
        return redirect()->route('daftar-fakultas.index')->with('success', 'Data fakultas berhasil ditambahkan');
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'faculty_name.required' => 'Nama fakultas wajib diisi.',
            'faculty_code.required' => 'Kode fakultas wajib diisi.',
            'faculty_code.unique' => 'Kode fakultas ini sudah terdaftar.',
        ];
        
        $validator = Validator::make($request->all(), [
            'faculty_name' => 'required|string|max:255',
            'faculty_code' => 'required|string|max:255|unique:faculties,faculty_code,'. $id,
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Periksa kembali input Anda!');
        }

        $faculty = Faculty::findOrFail($id);

        $data = [
            'faculty_name' => $request->faculty_name,
            'faculty_code' => $request->faculty_code,
        ];

        $faculty->update($data);

        return redirect()->route('daftar-fakultas.index')->with('success', 'Data fakultas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faculty = Faculty::findOrFail($id);

        $faculty->delete();
        return redirect()->route('daftar-fakultas.index')->with('success', 'Data fakultas berhasil dihapus');
    }

    public function destroyMultiple(Request $request){
        $ids = $request->input('ids');

        if (!$ids) {
            return redirect()->back()->with('error', 'Tidak ada data yang dipilih.');
        }
    
        Faculty::whereIn('id', $ids)->delete();
    
        return redirect()->back()->with('success', 'Data fakultas berhasil dihapus.');
    }
}
