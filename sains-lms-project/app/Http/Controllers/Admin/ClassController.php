<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassPai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ClassPai::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('class_name', 'like', '%' . $request->search . '%')
                  ->orWhere('lecturer', 'like', '%' . $request->search . '%');
            });
        }
    
    
        $classPais = $query->paginate(10);
    
        return view('dashboard.admin.daftar-kelas.index', compact('classPais'));
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
            'class_name.required' => 'Nama kelas wajib diisi.',
            'lecturer.required' => 'Nama dosen wajib diisi.',
        ];
        
        $validator = Validator::make($request->all(), [
            'class_name' => 'required|string|max:255',
            'lecturer' => 'required|string|max:255',
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Periksa kembali input Anda!');
        }
    
        ClassPai::create([
            'class_name' => $request->class_name,
            'lecturer' => $request->lecturer,
        ]);
    
        return redirect()->route('daftar-kelas.index')->with('success', 'Data kelas berhasil ditambahkan');
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
            'class_name.required' => 'Nama kelas wajib diisi.',
            'lecturer.required' => 'Nama dosen wajib diisi.',
        ];
        
        $validator = Validator::make($request->all(), [
            'class_name' => 'required|string|max:255',
            'lecturer' => 'required|string|max:255',
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Periksa kembali input Anda!');
        }

        $classPai = ClassPai::findOrFail($id);

        $data = [
            'class_name' => $request->class_name,
            'lecturer' => $request->lecturer,
        ];

        $classPai->update($data);

        return redirect()->route('daftar-kelas.index')->with('success', 'Data kelas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $classPais = ClassPai::findOrFail($id);

        $classPais->delete();
        return redirect()->route('daftar-kelas.index')->with('success', 'Data kelas berhasil dihapus');
    }

    public function destroyMultiple(Request $request){
        $ids = $request->input('ids');

        if (!$ids) {
            return redirect()->back()->with('error', 'Tidak ada data yang dipilih.');
        }
    
        ClassPai::whereIn('id', $ids)->delete();
    
        return redirect()->back()->with('success', 'Data kelas berhasil dihapus.');
    }
}
