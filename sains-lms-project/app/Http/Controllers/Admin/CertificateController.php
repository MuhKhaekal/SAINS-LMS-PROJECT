<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.admin.sertifikat.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $type = $request->input('type');
        
        // AMBIL DATA: Cek apakah sertifikat tipe ini sudah pernah diupload
        $certificate = Certificate::where('type', $type)->first();
    
        // ARRAY DATA: Siapkan data untuk dikirim ke view
        $data = [
            'type' => $type,
            'certificate' => $certificate // Data ini akan null jika belum ada upload
        ];
    
        if ($type == 'sertifikat-praktikan-umum'):
            return view('dashboard.admin.sertifikat.praktikan-umum.index', $data);
    
        elseif ($type == 'sertifikat-asisten-umum'):
            return view('dashboard.admin.sertifikat.asisten-umum.index', $data);
    
        elseif ($type == 'sertifikat-praktikan-akhwat-terbaik'):
            return view('dashboard.admin.sertifikat.praktikan-akhwat-terbaik.index', $data);
    
        elseif ($type == 'sertifikat-praktikan-ikhwan-terbaik'):
            return view('dashboard.admin.sertifikat.praktikan-ikhwan-terbaik.index', $data);
    
        elseif ($type == 'sertifikat-asisten-akhwat-terbaik'):
            return view('dashboard.admin.sertifikat.asisten-akhwat-terbaik.index', $data);
    
        elseif ($type == 'sertifikat-asisten-ikhwan-terbaik'):
            return view('dashboard.admin.sertifikat.asisten-ikhwan-terbaik.index', $data);
    
        else:
            return view('dashboard.admin.sertifikat.index', $data);
    
        endif;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $messages = [
        'file_location.mimetypes' => 'Periksa format file terlebih dahulu',
        'file_location.max' => 'Ukuran file maksimal 2MB'
       ];

        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'file_location' => 'nullable|mimetypes:image/jpeg,image/png|max:2000',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Periksa kembali input Anda!');
        }

        if ($request->hasFile('file_location')) {
            $path = $request->file('file_location')->store('certificates', 'public');
            Certificate::updateOrCreate(
                ['type' => $request->type],
                ['file_location' => $path]  
            );

            return redirect()->back()->with('success', 'Template sertifikat berhasil diupload!');
        }

        return redirect()->back()->with('error', 'Gagal mengupload file.');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $certificate = Certificate::findOrFail($id);
    
        if ($certificate->file_location && Storage::disk('public')->exists($certificate->file_location)) {
            Storage::disk('public')->delete($certificate->file_location);
        }
    
        $certificate->delete();

        return redirect()->back()->with('success', 'Template berhasil dihapus!');
    }
}
