<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use App\Models\Halaqah;
use App\Models\Pretest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PretestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 1. Validasi Input URL
        $halaqahName = $request->query('halaqah_name');
        if (!$halaqahName) return back()->with('error', 'Nama halaqah tidak ditemukan.');

        $asisten = Auth::user();

        // 2. Cari Halaqah & Validasi Akses Asisten
        $selectedHalaqah = Halaqah::where('halaqah_name', $halaqahName)
            ->whereHas('users', function($q) use ($asisten) {
                $q->where('users.id', $asisten->id);
            })->first();

        if (!$selectedHalaqah) {
            return back()->with('error', 'Halaqah tidak ditemukan atau Anda tidak memiliki akses.');
        }

        // 3. Ambil Praktikan di Halaqah ini
        // Kita eager load relasi 'pretest' agar lebih efisien (N+1 Problem Solved)
        // Asumsi relasi di model User: public function pretest() { return $this->hasOne(Pretest::class); }
        // Tapi karena pretest terikat halaqah_id juga, kita filter manual di view atau query builder
        
        $praktikans = $selectedHalaqah->users()
            ->where('role', 'praktikan')
            ->get();

        // 4. Map Data Nilai Pretest
        foreach ($praktikans as $p) {
            // Cari nilai pretest user INI di halaqah INI
            $nilai = Pretest::where('user_id', $p->id)
                ->where('halaqah_id', $selectedHalaqah->id)
                ->first();

            // Tempelkan data nilai ke object praktikan
            $p->nilai_pretest = $nilai; // Bisa null jika belum dinilai
        }

        return view('dashboard.asisten.pretest.index', compact('praktikans', 'selectedHalaqah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $halaqahName = $request->halaqah_name;
        $selectedHalaqah = Halaqah::where('halaqah_name', $halaqahName)->firstOrFail();
    
        $pretests = Pretest::where('halaqah_id', $selectedHalaqah->id)->get()->keyBy('user_id');
    
        $praktikans = $selectedHalaqah
            ? $selectedHalaqah->users()->where('role', 'praktikan')->get()
            : collect();

        return view('dashboard.asisten.pretest.create', compact('selectedHalaqah', 'praktikans', 'pretests'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'halaqah_id' => 'required|exists:halaqahs,id',
            'pretests' => 'required|array',
            'pretests.*.kbq' => 'required|numeric|min:0|max:100',
            'pretests.*.hb' => 'required|numeric|min:0|max:100',
            'pretests.*.mh' => 'required|numeric|min:0|max:100',
        ]);

        foreach ($request->pretests as $userId => $scores) {
            $sum = $scores['kbq'] + $scores['hb'] + $scores['mh'];
            $totalScore = $sum / 30 * 100 ; 

            Pretest::updateOrCreate(
                [
                    'halaqah_id' => $request->halaqah_id,
                    'user_id'    => $userId,
                ],
                [
                    'kbq'   => $scores['kbq'],
                    'hb'    => $scores['hb'],
                    'mh'    => $scores['mh'],
                    'total' => round($totalScore), 
                ]
            );
        }

        return redirect()->back()->with('success', 'Nilai Pretest berhasil disimpan.');


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
