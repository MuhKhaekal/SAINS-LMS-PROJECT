<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Halaqah;
use App\Models\Meeting;
use App\Models\PivotHalaqahUser;
use App\Models\Posttest;
use App\Models\Pretest;
use App\Models\Prodi;
use App\Models\TestSubmission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HalaqahController extends Controller
{

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


    public function show($id)
    {

        $halaqah = Halaqah::with(['prodi.faculty', 'classPais'])->findOrFail($id);

        $meetings = Meeting::orderBy('id', 'asc')->get(); 

        $asisten = $halaqah->users()->where('role', 'asisten')->first();

        $praktikans = $halaqah->users()
            ->where('role', 'praktikan')
            ->with(['presences' => function($q) use ($id) {
                $q->where('halaqah_id', $id);
            }])
            ->get();

        $totalPertemuan = $meetings->where('type', 'skk')->count(); 
        $totalPraktikan = $praktikans->count();

        $totalKehadiran = 0;
        $totalSlot = $totalPertemuan * $totalPraktikan;
        
        foreach($praktikans as $p) {
            $hadir = $p->presences->where('status', 'Hadir')->count();
            
            $p->jumlah_hadir = $hadir;
            $p->persentase = $totalPertemuan > 0 ? ($hadir / $totalPertemuan) * 100 : 0;
            
            $totalKehadiran += $hadir;
            
            $p->pretest = Pretest::where('user_id', $p->id)->where('halaqah_id', $id)->first();
            $p->posttest = Posttest::where('user_id', $p->id)->where('halaqah_id', $id)->first();
            $p->final = TestSubmission::where('user_id', $p->id)->where('halaqah_id', $id)->latest()->first();
        }

        $avgKehadiran = $totalSlot > 0 ? ($totalKehadiran / $totalSlot) * 100 : 0;

        return view('dashboard.admin.daftar-halaqah.show', compact(
            'halaqah', 'asisten', 'praktikans', 'meetings', 
            'totalPertemuan', 'totalPraktikan', 'avgKehadiran'
        ));
    }

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
