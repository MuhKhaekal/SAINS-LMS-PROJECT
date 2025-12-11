<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Halaqah;
use App\Models\Presence;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsistenCertificateController extends Controller
{

    public function indexValidasi(Request $request)
{
    // 1. Validasi Input
    $halaqahName = $request->query('halaqah_name');
    if (!$halaqahName) return back()->with('error', 'Nama halaqah tidak ditemukan.');

    $asisten = Auth::user();
    
    // 2. Cari Halaqah & Validasi Akses
    $selectedHalaqah = Halaqah::where('halaqah_name', $halaqahName)
        ->whereHas('users', function($q) use ($asisten) {
            $q->where('users.id', $asisten->id);
        })->first();

    if (!$selectedHalaqah) return back()->with('error', 'Halaqah tidak ditemukan atau akses ditolak.');

    // 3. Ambil Praktikan
    $praktikans = $selectedHalaqah->users()->where('role', 'praktikan')->get();

    // 4. Ambil Data Sertifikat (Sekali saja di luar loop)
    $cert = Certificate::where('type', 'sertifikat-praktikan-umum')->first();
    
    // Syarat Minimal
    $minReq = 4; 

    // 5. Loop Perhitungan Logic
    foreach ($praktikans as $p) {
        // Hitung Presensi (Hanya di halaqah ini)
        $p->attendance_count = Presence::where('user_id', $p->id)
            ->where('halaqah_id', $selectedHalaqah->id)
            ->where('status', 'hadir') 
            ->count();

        // Hitung Tugas
        $p->task_count = Submission::where('user_id', $p->id)->count();

        // Cek Validasi (Query ke Pivot)
        $p->is_validated = $cert ? $cert->users()->where('user_id', $p->id)->exists() : false;

        // Tentukan Kelayakan (Eligible)
        $p->is_eligible = ($p->attendance_count >= $minReq && $p->task_count >= $minReq);

    }

    // 6. Hitung Statistik untuk Header Dashboard
    $stats = [
        'total' => $praktikans->count(),
        'layak' => $praktikans->where('is_eligible', true)->count(),
        'validated' => $praktikans->where('is_validated', true)->count(),
    ];

    return view('dashboard.asisten.sertifikat.index', compact('praktikans', 'selectedHalaqah', 'stats'));
}

    /**
     * 2. Aksi Simpan Validasi (Masukin ke Pivot)
     */
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

        // --- LOAD IMAGE ---
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if ($ext == 'png') {
            $image = imagecreatefrompng($path);
        } elseif ($ext == 'jpg' || $ext == 'jpeg') {
            $image = imagecreatefromjpeg($path);
        } else {
            return response()->download($path); 
        }

        // Warna Teks (Misal: Hitam)
        $color = imagecolorallocate($image, 50, 50, 50); 
        
        // Path Font
        $fontPath = public_path('fonts/SertifikatFont.ttf'); 
        $text = $user->nama;
        
        $imageWidth = imagesx($image);
        $imageHeight = imagesy($image);

        // --- DEBUGGING: Pastikan Font Ada ---
        if (!file_exists($fontPath)) {
            // Matikan program dan kasih tau kalau font hilang
            dd("File font tidak ditemukan di: " . $fontPath);
        }

        if (file_exists($fontPath)) {
            $fontSize = 70; // Ukuran Font
            
            // Hitung Kotak Teks
            $textBox = imagettfbbox($fontSize, 0, $fontPath, $text);
            $textWidth = $textBox[2] - $textBox[0];
            $textHeight = $textBox[1] - $textBox[7]; // Tinggi teks
            
            // Posisi X: Tengah Horizontal
            $x = ($imageWidth - $textWidth) / 2;
            
            // Posisi Y: Tengah Vertikal
            // Karena imagettftext patokannya GARIS BAWAH teks, kita harus tambah setengah tinggi teks
            $centerY = ($imageHeight / 2) + ($textHeight / 2);
            
            // Geser ke atas sedikit (kurangi nilai Y)
            $y = $centerY - 120; 

            imagettftext($image, $fontSize, 0, $x, $y, $color, $fontPath, $text);
            
        } else {
            // Fallback
            imagestring($image, 5, 50, 50, "FONT TIDAK DITEMUKAN", $color);
        }

        // Tambahkan time() biar tidak kena cache browser
        $filename = 'Sertifikat-' . str_replace(' ', '-', $user->nama) . '-' . time() . '.jpg';
        
        // Output Header
        header('Content-Type: image/jpeg');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        
        imagejpeg($image);
        imagedestroy($image);
        exit;
    }

    public function revokeSahkan($userId)
    {
        // Cari sertifikat tipe praktikan umum
        $cert = Certificate::where('type', 'sertifikat-praktikan-umum')->firstOrFail();
        
        // Hapus relasi (detach) user dari sertifikat ini
        $cert->users()->detach($userId);

        return back()->with('success', 'Pengesahan sertifikat berhasil dibatalkan.');
    }
}

