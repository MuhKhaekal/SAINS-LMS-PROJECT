<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\DaftarPenggunaImport;
use App\Imports\UsersImport;
use App\Models\Halaqah;
use App\Models\PivotHalaqahUser;
use App\Models\Posttest;
use App\Models\Presence;
use App\Models\Pretest;
use App\Models\TestSubmission;
use App\Models\User;
use App\Models\WeeklyScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $query = User::with('halaqahs');
        $halaqahs = Halaqah::orderBy('halaqah_name', 'asc')->get();


        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nim', 'like', '%' . $request->search . '%')
                  ->orWhere('role', 'like', '%' . $request->search . '%')
                  ->orWhere('gender', 'like', '%' . $request->search . '%');
            });
        }
    
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
    
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }
    
        $users = $query->paginate(10);
    
        return view('dashboard.admin.daftar-pengguna.index', compact('users', 'halaqahs'));
    }

    public function store(Request $request)
    {
        $messages = [
            'nama.required' => 'Nama wajib diisi.',
            'nim.required' => 'NIM wajib diisi.',
            'nim.unique' => 'NIM ini sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'gender.required' => 'Jenis kelamin wajib dipilih.',
            'role.required' => 'Role wajib dipilih.',
        ];
        
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:255|unique:users,nim',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|string',
            'role' => 'required|string',
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Periksa kembali input Anda!');
        }
    
        $user = User::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'role' => $request->role,
        ]);

        if ($request->filled('halaqah_id')) {
            PivotHalaqahUser::create([
                'halaqah_id' => $request->halaqah_id,
                'user_id' => $user->id, 
            ]);
        }
    
        return redirect()->route('daftar-pengguna.index')->with('success', 'Akun berhasil ditambahkan');
    }
    


    public function show($id)
    {
        $user = User::findOrFail($id);

        $user->load(['halaqahs.prodi.faculty']);

        $academicData = [];

        if ($user->role == 'praktikan') {
            foreach ($user->halaqahs as $halaqah) {
                $pretest = Pretest::where('user_id', $user->id)->where('halaqah_id', $halaqah->id)->first();
                $posttest = Posttest::where('user_id', $user->id)->where('halaqah_id', $halaqah->id)->first();
                $weekly = WeeklyScore::where('user_id', $user->id)->where('halaqah_id', $halaqah->id)->first();
                $final = TestSubmission::where('user_id', $user->id)->where('halaqah_id', $halaqah->id)->latest()->first();
                
                $presences = Presence::with('meeting')
                    ->where('user_id', $user->id)
                    ->where('halaqah_id', $halaqah->id)
                    ->get();

                $totalHadir = $presences->where('status', 'Hadir')->count();
                $totalIzin = $presences->where('status', 'Izin')->count();
                $totalSakit = $presences->where('status', 'Sakit')->count();
                $totalAlfa = $presences->where('status', 'Alfa')->count();

                $academicData[] = (object) [
                    'halaqah' => $halaqah,
                    'pretest' => $pretest,
                    'posttest' => $posttest,
                    'weekly' => $weekly,
                    'final' => $final,
                    'presences' => $presences,
                    'summary_presence' => [
                        'hadir' => $totalHadir,
                        'izin' => $totalIzin,
                        'sakit' => $totalSakit,
                        'alfa' => $totalAlfa,
                        'total' => $presences->count()
                    ]
                ];
            }
        }

        return view('dashboard.admin.daftar-pengguna.show', compact('user', 'academicData'));
    }


    public function update(Request $request, string $id)
    {
        $messages = [
            'nama.required' => 'Nama wajib diisi.',
            'nim.required' => 'NIM wajib diisi.',
            'nim.unique' => 'NIM ini sudah terdaftar.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'gender.required' => 'Jenis kelamin wajib dipilih.',
            'role.required' => 'Role wajib dipilih.',
        ];
    
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:255|unique:users,nim,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'gender' => 'required|string',
            'role' => 'required|string',
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Periksa kembali input Anda!');
        }
    
        $user = User::findOrFail($id);
    
        $data = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'gender' => $request->gender,
            'role' => $request->role,
        ];
    
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
    

        $user->update($data);

        if ($request->role === 'praktikan') {
            if (!empty($request->halaqah_id)) {
                PivotHalaqahUser::updateOrCreate(
                    ['user_id' => $id],
                    ['halaqah_id' => $request->halaqah_id]
                );
            }
        } else {
            PivotHalaqahUser::where('user_id', $id)->delete();
        }
         
        return redirect()->route('daftar-pengguna.index')->with('success', 'Akun berhasil diperbarui');
    }
    
    
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();
        return redirect()->route('daftar-pengguna.index')->with('success', 'Akun berhasil dihapus');
    }

    public function destroyMultiple(Request $request){
        $ids = $request->input('ids');

        if (!$ids) {
            return redirect()->back()->with('error', 'Tidak ada data yang dipilih.');
        }
    
        User::whereIn('id', $ids)->delete();
        PivotHalaqahUser::whereIn('user_id', $ids)->delete();
        return redirect()->back()->with('success', 'Data pengguna berhasil dihapus.');
        return redirect()->back()->with('success', 'Data pengguna berhasil dihapus.');

    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ], [
            'file.required' => 'File wajib diupload.',
            'file.mimes' => 'Format harus xlsx, xls, atau csv.',
        ]);

        try {
            Excel::import(new DaftarPenggunaImport, $request->file('file'));
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true, 
                    'message' => 'Data pengguna berhasil diimport!'
                ], 200);
            }
            
            return back()->with('success', 'Data pengguna berhasil diimport!');
    
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                 return response()->json([
                    'success' => false, 
                    'message' => 'Terjadi kesalahan saat import: ' . $e->getMessage()
                ], 500); 
            }
            
            return back()->with('error', 'Terjadi kesalahan saat import: ' . $e->getMessage());
        }
    }

}
