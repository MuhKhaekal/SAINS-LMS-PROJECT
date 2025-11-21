<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\DaftarPenggunaImport;
use App\Imports\UsersImport;
use App\Models\Halaqah;
use App\Models\PivotHalaqahUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
            // Praktikan wajib punya halaqah
            if (!empty($request->halaqah_id)) {
                PivotHalaqahUser::updateOrCreate(
                    ['user_id' => $id],
                    ['halaqah_id' => $request->halaqah_id]
                );
            }
        } else {
            // Jika role berubah bukan praktikan → hapus halaqah
            PivotHalaqahUser::where('user_id', $id)->delete();
        }
        

    
    
        return redirect()->route('daftar-pengguna.index')->with('success', 'Akun berhasil diperbarui');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
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
