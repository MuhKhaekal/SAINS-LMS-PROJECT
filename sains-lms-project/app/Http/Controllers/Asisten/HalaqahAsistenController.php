<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use App\Models\Halaqah;
use App\Models\Meeting;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class HalaqahAsistenController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $meetings = Meeting::all();
        $halaqahName = $request->halaqah_name;

        $selectedHalaqah = null;
    
        if ($halaqahName) {
            $selectedHalaqah = Halaqah::where('halaqah_name', $halaqahName)->first();
        }
    
        if ($selectedHalaqah) {
            $this->authorize('view', $selectedHalaqah);
        }
        $user = Auth::user();

        $hasSertifUmum = $user->certificates()
            ->where('type', 'sertifikat-asisten-umum')
            ->exists();

        $hasSertifTerbaik = $user->certificates()
            ->whereIn('type', [
                'sertifikat-asisten-akhwat-terbaik',
                'sertifikat-asisten-ikhwan-terbaik',
            ])
            ->exists();

        $labelTerbaik = $user->gender == 'L' ? 'Asisten Ikhwan Terbaik' : 'Asisten Akhwat Terbaik';
        $typeTerbaik  = $user->gender == 'L' ? 'sertifikat-asisten-ikhwan-terbaik' : 'sertifikat-asisten-akhwat-terbaik';
        return view('dashboard.asisten.halaqah.index', compact(
            'selectedHalaqah', 'meetings', 'hasSertifUmum', 'hasSertifTerbaik',
            'labelTerbaik', 'typeTerbaik'));
    }
}
