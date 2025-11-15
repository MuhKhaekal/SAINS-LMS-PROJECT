<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Prodi::with('faculty');
        $faculties = Faculty::all();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('prodi_code', 'like', '%' . $request->search . '%')
                  ->orWhere('prodi_name', 'like', '%' . $request->search . '%');
            });
        }
    
        if ($request->filled('faculty')) {
            $query->where('faculty_id', $request->faculty);
        }
    
        $prodies = $query->paginate(10);
    
        return view('dashboard.admin.daftar-prodi.index', compact('prodies', 'faculties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'prodi_name.required' => 'Nama Prodi wajib diisi.',
            'prodi_code.required' => 'Kode Prodi wajib diisi.',
            'prodi_code.unique' => 'Kode Prodi ini sudah terdaftar.',
            'faculty_id.required' => 'Fakultas wajib dipilih'
        ];
        
        $validator = Validator::make($request->all(), [
            'prodi_name' => 'required|string|max:255',
            'prodi_code' => 'required|string|max:255|unique:prodis,prodi_code',
            'faculty_id' => 'exists:faculties,id',
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Periksa kembali input Anda!');
        }
    
        Prodi::create([
            'prodi_code' => $request->prodi_code,
            'prodi_name' => $request->prodi_name,
            'faculty_id' => $request->faculty_id,
        ]);
    
        return redirect()->route('daftar-prodi.index')->with('success', 'Data Program Studi berhasil ditambahkan');
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
            'prodi_name.required' => 'Nama Prodi wajib diisi.',
            'prodi_code.required' => 'Kode Prodi wajib diisi.',
            'prodi_code.unique' => 'Kode Prodi ini sudah terdaftar.',
            'faculty_id.required' => 'Fakultas wajib dipilih'
        ];
        
        $validator = Validator::make($request->all(), [
            'prodi_name' => 'required|string|max:255',
            'prodi_code' => 'required|string|max:255|unique:prodis,prodi_code,' . $id,
            'faculty_id' => 'exists:faculties,id',
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Periksa kembali input Anda!');
        }

        $prodi = Prodi::findOrFail($id);

        $data = [
            'prodi_name' => $request->prodi_name,
            'prodi_code' => $request->prodi_code,
            'faculty_id' => $request->faculty_id,
        ];

        $prodi->update($data);

        return redirect()->route('daftar-prodi.index')->with('success', 'Data Program Studi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prodi = Prodi::findOrFail($id);

        $prodi->delete();
        return redirect()->route('daftar-prodi.index')->with('success', 'Data Program Studi berhasil dihapus');
    }

    public function destroyMultiple(Request $request){
        $ids = $request->input('ids');

        if (!$ids) {
            return redirect()->back()->with('error', 'Tidak ada data yang dipilih.');
        }
    
        Prodi::whereIn('id', $ids)->delete();
    
        return redirect()->back()->with('success', 'Data Program Studi berhasil dihapus.');
    }
}
