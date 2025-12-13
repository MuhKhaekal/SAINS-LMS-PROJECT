<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Halaqah;
use App\Models\Presence;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsistenCertificateController extends Controller
{

    public function indexValidasi(Request $request)
    {
        $halaqahName = $request->query('halaqah_name');
        if (!$halaqahName) return back()->with('error', 'Nama halaqah tidak ditemukan.');
    
        $asisten = Auth::user();
        
        $selectedHalaqah = Halaqah::where('halaqah_name', $halaqahName)
            ->whereHas('users', function($q) use ($asisten) {
                $q->where('users.id', $asisten->id);
            })->first();
    
        if (!$selectedHalaqah) return back()->with('error', 'Halaqah tidak ditemukan atau akses ditolak.');
            $cert = Certificate::where('type', 'sertifikat-praktikan-umum')->first();
        
        $hasTemplate = $cert ? true : false;
    
        if (!$hasTemplate) {
            return view('dashboard.asisten.sertifikat.index', [
                'selectedHalaqah' => $selectedHalaqah,
                'hasTemplate' => false,
                'praktikans' => collect([]), 
                'stats' => ['total' => 0, 'layak' => 0, 'validated' => 0]
            ]);
        }
    
        
        $praktikans = $selectedHalaqah->users()->where('role', 'praktikan')->get();
        $minReq = 4;
    
        foreach ($praktikans as $p) {
            $p->attendance_count = Presence::where('user_id', $p->id)
                ->where('halaqah_id', $selectedHalaqah->id)
                ->where('status', 'hadir') 
                ->count();
    
            $p->task_count = Submission::where('user_id', $p->id)->count();
    
            $p->is_validated = $cert->users()->where('user_id', $p->id)->exists();
            $p->is_eligible = ($p->attendance_count >= $minReq && $p->task_count >= $minReq);
            
            $p->confirm_message = $p->is_eligible 
                ? "Apakah Anda yakin ingin mengesahkan sertifikat untuk {$p->nama}?" 
                : "PERHATIAN: Praktikan {$p->nama} BELUM MEMENUHI SYARAT. Tetap sahkan?";
        }
    
        $stats = [
            'total' => $praktikans->count(),
            'layak' => $praktikans->where('is_eligible', true)->count(),
            'validated' => $praktikans->where('is_validated', true)->count(),
        ];
    
        return view('dashboard.asisten.sertifikat.index', compact('praktikans', 'selectedHalaqah', 'stats', 'hasTemplate'));
    }

    public function storeSahkan($userId)
    {
        $cert = Certificate::where('type', 'sertifikat-praktikan-umum')->firstOrFail();

        if (!$cert->users()->where('user_id', $userId)->exists()) {
            $cert->users()->attach($userId);
            return back()->with('success', 'Sertifikat praktikan berhasil disahkan.');
        }

        return back()->with('info', 'Sertifikat sudah disahkan sebelumnya.');
    }


    public function download($type)
    {
        $user = Auth::user();
        
        $certificate = Certificate::where('type', $type)->firstOrFail();
        
        if (!$certificate->users()->where('user_id', $user->id)->exists()) {
            abort(403, 'Anda belum berhak mengklaim sertifikat ini.');
        }

        $path = storage_path('app/public/' . $certificate->file_location);
        
        if (!file_exists($path)) {
            abort(404, 'File template tidak ditemukan.');
        }

        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if ($ext == 'png') {
            $image = imagecreatefrompng($path);
        } elseif ($ext == 'jpg' || $ext == 'jpeg') {
            $image = imagecreatefromjpeg($path);
        } else {
            return response()->download($path); 
        }

        $color = imagecolorallocate($image, 50, 50, 50); 
        
        $fontPath = public_path('fonts/SertifikatFont.ttf'); 
        $text = $user->nama;
        
        $imageWidth = imagesx($image);
        $imageHeight = imagesy($image);
        if (!file_exists($fontPath)) {
            dd("File font tidak ditemukan di: " . $fontPath);
        }

        if (file_exists($fontPath)) {
            $fontSize = 70;
            
            $textBox = imagettfbbox($fontSize, 0, $fontPath, $text);
            $textWidth = $textBox[2] - $textBox[0];
            $textHeight = $textBox[1] - $textBox[7];
            
            $x = ($imageWidth - $textWidth) / 2;
            $centerY = ($imageHeight / 2) + ($textHeight / 2);
            $y = $centerY - 120; 
            imagettftext($image, $fontSize, 0, $x, $y, $color, $fontPath, $text);
            
        } else {
            imagestring($image, 5, 50, 50, "FONT TIDAK DITEMUKAN", $color);
        }

        $filename = 'Sertifikat-' . str_replace(' ', '-', $user->nama) . '-' . time() . '.jpg';
        
        header('Content-Type: image/jpeg');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        
        imagejpeg($image);
        imagedestroy($image);
        exit;
    }

    public function revokeSahkan($userId)
    {
        $cert = Certificate::where('type', 'sertifikat-praktikan-umum')->firstOrFail();
        $cert->users()->detach($userId);
        return back()->with('success', 'Pengesahan sertifikat berhasil dibatalkan.');
    }
}

