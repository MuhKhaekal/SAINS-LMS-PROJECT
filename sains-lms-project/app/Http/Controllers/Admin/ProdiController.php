<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdiController extends Controller
{

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
    

    public function show($id)
    {
        $prodi = Prodi::with(['faculty', 'halaqahs'])->findOrFail($id);

        $totalHalaqah = $prodi->halaqahs->count();

        $totalAsisten = User::where('role', 'asisten')
            ->whereHas('halaqahs', function($q) use ($id) {
                $q->where('prodi_id', $id);
            })->distinct()->count('users.id');

        $totalPraktikan = User::where('role', 'praktikan')
            ->whereHas('halaqahs', function($q) use ($id) {
                $q->where('prodi_id', $id);
            })->distinct()->count('users.id');

        $listHalaqah = $prodi->halaqahs;

        $listAsisten = User::where('role', 'asisten')
            ->whereHas('halaqahs', function($q) use ($id) {
                $q->where('prodi_id', $id);
            })
            ->with(['halaqahs' => function($q) use ($id) {
                $q->where('prodi_id', $id);
            }])
            ->distinct()
            ->get();

        $listPraktikan = User::where('role', 'praktikan')
            ->whereHas('halaqahs', function($q) use ($id) {
                $q->where('prodi_id', $id);
            })
            ->with(['halaqahs' => function($q) use ($id) {
                $q->where('prodi_id', $id);
            }])
            ->distinct()
            ->limit(500)
            ->get();

        $chartDataRaw = $prodi->halaqahs->groupBy('halaqah_type')->map->count();
        $chartLabels = $chartDataRaw->keys();
        $chartValues = $chartDataRaw->values();

        return view('dashboard.admin.daftar-prodi.show', compact(
            'prodi',
            'totalHalaqah', 'totalAsisten', 'totalPraktikan',
            'listHalaqah', 'listAsisten', 'listPraktikan',
            'chartLabels', 'chartValues'
        ));
    }


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
