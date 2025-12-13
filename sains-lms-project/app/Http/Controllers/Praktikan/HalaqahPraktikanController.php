<?php

namespace App\Http\Controllers\Praktikan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Halaqah;
use App\Models\Meeting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class HalaqahPraktikanController extends Controller
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
            ->where('type', 'sertifikat-praktikan-umum')
            ->exists();

        $hasSertifTerbaik = $user->certificates()
            ->whereIn('type', [
                'sertifikat-praktikan-akhwat-terbaik',
                'sertifikat-praktikan-ikhwan-terbaik',
            ])
            ->exists();

        $labelTerbaik = $user->gender == 'L' ? 'Praktikan Ikhwan Terbaik' : 'Praktikan Akhwat Terbaik';
        $typeTerbaik  = $user->gender == 'L' ? 'sertifikat-praktikan-ikhwan-terbaik' : 'sertifikat-praktikan-akhwat-terbaik';

        return view('dashboard.praktikan.halaqah.index', compact('selectedHalaqah', 'meetings', 'hasSertifUmum','hasSertifTerbaik','labelTerbaik', 'typeTerbaik'));
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
