<?php

namespace App\Http\Controllers\Praktikan;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Auth;
use Illuminate\Http\Request;

class PraktikanCertificateController extends Controller
{
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
}
