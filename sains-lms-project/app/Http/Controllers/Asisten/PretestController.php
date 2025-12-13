<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use App\Models\Halaqah;
use App\Models\Pretest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PretestController extends Controller
{
    public function index(Request $request)
    {
        $halaqahName = $request->query('halaqah_name');
        if (!$halaqahName) return back()->with('error', 'Nama halaqah tidak ditemukan.');

        $asisten = Auth::user();

        $selectedHalaqah = Halaqah::where('halaqah_name', $halaqahName)
            ->whereHas('users', function($q) use ($asisten) {
                $q->where('users.id', $asisten->id);
            })->first();

        if (!$selectedHalaqah) {
            return back()->with('error', 'Halaqah tidak ditemukan atau Anda tidak memiliki akses.');
        }
        
        $praktikans = $selectedHalaqah->users()
            ->where('role', 'praktikan')
            ->get();

        foreach ($praktikans as $p) {
            $nilai = Pretest::where('user_id', $p->id)
                ->where('halaqah_id', $selectedHalaqah->id)
                ->first();

            $p->nilai_pretest = $nilai;
        }

        return view('dashboard.asisten.pretest.index', compact('praktikans', 'selectedHalaqah'));
    }

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

}
