<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CertificateController extends Controller
{

    public function index()
    {
        return view('dashboard.admin.sertifikat.index');
    }

    public function create(Request $request)
    {
        $type = $request->input('type');
        $certificate = Certificate::where('type', $type)->first();
        
        $candidates = [];
        $candidateLabel = '';
        
        $isDistributed = false; 
    
        if ($type == 'sertifikat-asisten-umum') {
            $candidateLabel = 'Seluruh Asisten';
            
            $totalAsisten = User::where('role', 'asisten')->count();
            
            $assignedCount = 0;
            if($certificate) {
                $assignedCount = $certificate->users()->where('role', 'asisten')->count();
            }
    
            $candidates = ['count' => $totalAsisten]; 
    
            if ($totalAsisten > 0 && $totalAsisten === $assignedCount) {
                $isDistributed = true;
            }
        }
    
        if ($type == 'sertifikat-asisten-umum') {
            $candidateLabel = 'Seluruh Asisten';
            $candidates = ['count' => User::where('role', 'asisten')->count()]; 
        }
        elseif ($type == 'sertifikat-asisten-akhwat-terbaik') {
            $candidateLabel = 'Asisten Akhwat (Perempuan)';
            $candidates = User::where('role', 'asisten')->where('gender', 'P')->orderBy('nama')->get();
        }
        elseif ($type == 'sertifikat-asisten-ikhwan-terbaik') {
            $candidateLabel = 'Asisten Ikhwan (Laki-laki)';
            $candidates = User::where('role', 'asisten')->where('gender', 'L')->orderBy('nama')->get();
        }
        elseif ($type == 'sertifikat-praktikan-akhwat-terbaik') {
            $candidateLabel = 'Praktikan Akhwat (Perempuan)';
            $candidates = User::where('role', 'praktikan')->where('gender', 'P')->orderBy('nama')->get();
        }
        elseif ($type == 'sertifikat-praktikan-ikhwan-terbaik') {
            $candidateLabel = 'Praktikan Ikhwan (Laki-laki)';
            $candidates = User::where('role', 'praktikan')->where('gender', 'L')->orderBy('nama')->get();
        }

        $data = [
            'type' => $type,
            'certificate' => $certificate,
            'candidates' => $candidates,
            'candidateLabel' => $candidateLabel,
            'isDistributed' => $isDistributed, 
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
            return view('dashboard.admin.sertifikat.index');
    
        endif;
    }


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

    public function destroy(string $id)
    {
        $certificate = Certificate::findOrFail($id);
    
        if ($certificate->file_location && Storage::disk('public')->exists($certificate->file_location)) {
            Storage::disk('public')->delete($certificate->file_location);
        }
    
        $certificate->delete();

        return redirect()->back()->with('success', 'Template berhasil dihapus!');
    }

    public function assign(Request $request)
    {
        $request->validate([
            'certificate_id' => 'required|exists:certificates,id',
            'type' => 'required',
        ]);
    
        $certificate = Certificate::findOrFail($request->certificate_id);
        $type = $request->type;
    
        if ($type == 'sertifikat-asisten-umum') {            
            $asistenIds = User::where('role', 'asisten')->pluck('id');
    
            if ($request->input('action') == 'revoke') {
                $certificate->users()->detach($asistenIds);
                return back()->with('success', 'Pengesahan sertifikat untuk seluruh Asisten berhasil DIBATALKAN.');
            } 
            
            else {
                $certificate->users()->syncWithoutDetaching($asistenIds);
                return back()->with('success', 'Sertifikat berhasil disahkan untuk seluruh Asisten!');
            }
        }

        else {
            $request->validate([
                'user_id' => 'required|exists:users,id'
            ]);

            if (!$certificate->users()->where('user_id', $request->user_id)->exists()) {
                $certificate->users()->attach($request->user_id);
                return back()->with('success', 'Sertifikat berhasil diberikan kepada user terpilih!');
            } else {
                return back()->with('error', 'User tersebut sudah memiliki sertifikat ini.');
            }
        }
    }

    public function revoke($certId, $userId)
    {
        $certificate = Certificate::findOrFail($certId);
        $certificate->users()->detach($userId);
        
        return back()->with('success', 'Penerima berhasil dihapus dari daftar.');
    }
}
