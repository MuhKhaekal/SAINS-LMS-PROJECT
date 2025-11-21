<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Halaqah;
use App\Models\PivotHalaqahUser;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HalaqahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Halaqah::with('prodi', 'users');
        $users = User::where('role', 'asisten')->get();
        $prodis = Prodi::all();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('halaqah_code', 'like', '%' . $request->search . '%')
                  ->orWhere('halaqah_name', 'like', '%' . $request->search . '%');
            });
        }
    
        if ($request->filled('halaqah_type')) {
            $query->where('halaqah_type', $request->halaqah_type);
        }

        if ($request->filled('prodi')) {
            $query->where('prodi_id', $request->prodi);
        }
    
        $halaqahs = $query->paginate(10);
    
        return view('dashboard.admin.daftar-halaqah.index', compact('halaqahs', 'users', 'prodis'));
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
            'halaqah_code.required' => 'Kode halaqah wajib diisi.',
            'halaqah_code.unique' => 'Kode halaqah ini sudah terdaftar.',
            'halaqah_name.required' => 'Nama halaqah wajib diisi',
            'halaqah_type.required' => 'Jenis halaqah wajib diisi',
            'prodi_id.required' => 'Program Studi wajib diisi.',
            'prodi_id.exists' => 'Asisten yang dipilih tidak valid.',
        ];
        
        $validator = Validator::make($request->all(), [
            'halaqah_code' => 'required|string|max:255|unique:halaqahs,halaqah_code',
            'halaqah_name' => 'required|string|max:255',
            'halaqah_type' => 'required|string',
            'prodi_id' => 'required|exists:prodis,id',
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Periksa kembali input Anda!');
        }
    
        $halaqah = Halaqah::create([
            'halaqah_code' => $request->halaqah_code,
            'halaqah_name' => $request->halaqah_name,
            'halaqah_type' => $request->halaqah_type,
            'prodi_id' => $request->prodi_id,
        ]);
    
        if ($request->filled('user_id')) {
            PivotHalaqahUser::create([
                'halaqah_id' => $halaqah->id,
                'user_id' => $request->user_id, 
            ]);
        }
       

    
        return redirect()->route('daftar-halaqah.index')->with('success', 'Data halaqah berhasil ditambahkan');
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
            'halaqah_code.required' => 'Kode halaqah wajib diisi.',
            'halaqah_code.unique' => 'Kode halaqah ini sudah terdaftar.',
            'halaqah_name.required' => 'Nama halaqah wajib diisi',
            'halaqah_type.required' => 'Jenis halaqah wajib diisi',
            'prodi_id.exists' => 'Asisten yang dipilih tidak valid.',
        ];
        
        $validator = Validator::make($request->all(), [
            'halaqah_code' => 'required|string|max:255|unique:halaqahs,halaqah_code,' . $id,
            'halaqah_name' => 'required|string|max:255',
            'halaqah_type' => 'required|string',
            'prodi_id' => 'nullable|exists:prodis,id',
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Periksa kembali input Anda!');
        }

        $halaqah = Halaqah::findOrFail($id);
    
        $data = [
            'halaqah_code' => $request->halaqah_code,
            'halaqah_name' => $request->halaqah_name,
            'halaqah_type' => $request->halaqah_type,
            'prodi_id' => $request->prodi_id,
        ];
    

        $halaqah->update($data);
    

        if (!empty($request->user_id)) {
            PivotHalaqahUser::where('halaqah_id', $id)
                ->whereHas('user', function ($q) {
                    $q->where('role', 'asisten');
                })
                ->delete();
            PivotHalaqahUser::create([
                'halaqah_id' => $id,
                'user_id' => $request->user_id,
            ]);
        
        } else {
            PivotHalaqahUser::where('halaqah_id', $id)
                ->whereHas('user', function ($q) {
                    $q->where('role', 'asisten');
                })
                ->delete();
        }
        
    
        return redirect()->route('daftar-halaqah.index')->with('success', 'Data halaqah berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $halaqah = Halaqah::findOrFail($id);

        $halaqah->delete();
        return redirect()->route('daftar-halaqah.index')->with('success', 'Data halaqah berhasil dihapus');
    }

    public function destroyMultiple(Request $request){
        $ids = $request->input('ids');

        if (!$ids) {
            return redirect()->back()->with('error', 'Tidak ada data yang dipilih.');
        }
    
        Halaqah::whereIn('id', $ids)->delete();

        PivotHalaqahUser::whereIn('halaqah_id', $ids)->delete();
        return redirect()->back()->with('success', 'Data halaqah berhasil dihapus.');
    }
}
