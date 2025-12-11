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

        // --- LOGIC SERTIFIKAT DIPINDAHKAN KE SINI ---
        $user = Auth::user();

        // 1. Cek Sertifikat Umum
        $hasSertifUmum = $user->certificates()
            ->where('type', 'sertifikat-asisten-umum')
            ->exists();

        // 2. Cek Sertifikat Terbaik
        $hasSertifTerbaik = $user->certificates()
            ->whereIn('type', [
                'sertifikat-asisten-akhwat-terbaik',
                'sertifikat-asisten-ikhwan-terbaik',
            ])
            ->exists();

        // 3. Tentukan Label & Tipe URL berdasarkan Gender
        $labelTerbaik = $user->gender == 'L' ? 'Asisten Ikhwan Terbaik' : 'Asisten Akhwat Terbaik';
        $typeTerbaik  = $user->gender == 'L' ? 'sertifikat-asisten-ikhwan-terbaik' : 'sertifikat-asisten-akhwat-terbaik';

        // Kirim semua variabel ke View menggunakan compact
        return view('dashboard.asisten.halaqah.index', compact(
            'selectedHalaqah', 
            'meetings',
            'hasSertifUmum',
            'hasSertifTerbaik',
            'labelTerbaik',
            'typeTerbaik'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
