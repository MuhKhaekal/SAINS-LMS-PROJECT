<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use App\Models\Halaqah;
use App\Models\Posttest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosttestController extends Controller
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
            $nilai = Posttest::where('user_id', $p->id)
                ->where('halaqah_id', $selectedHalaqah->id)
                ->first();

            $p->nilai_posttest = $nilai;
            $total = $nilai ? $nilai->total : 0;
        
        $ket = 'SANGAT KURANG'; 
        $grade = 'TIDAK PRE-TEST';

        if ($total > 0) { 
            if ($total >= 91) {
                $ket = 'SANGAT BAIK';
                $grade = 'A';
            } elseif ($total >= 81) {
                $ket = 'BAIK';
                $grade = 'A';
            } elseif ($total >= 61) {
                $ket = 'CUKUP';
                $grade = 'B';
            } elseif ($total >= 21) {
                $ket = 'KURANG';
                $grade = 'C';
            } else {
                $ket = 'SANGAT KURANG';
                $grade = 'C';
            }
        } else {
                 $ket = 'TIDAK PRE-TEST';
                 $grade = 'TIDAK PRE-TEST';

        }

        $p->ket = $ket;
        $p->grade = $grade;
        }

        return view('dashboard.asisten.posttest.index', compact('praktikans', 'selectedHalaqah'));
    }

    public function create(Request $request)
    {
        $halaqahName = $request->halaqah_name;
        $selectedHalaqah = Halaqah::where('halaqah_name', $halaqahName)->firstOrFail();
    
        $posttests = Posttest::where('halaqah_id', $selectedHalaqah->id)->get()->keyBy('user_id');
    
        $praktikans = $selectedHalaqah
            ? $selectedHalaqah->users()->where('role', 'praktikan')->get()
            : collect();

        return view('dashboard.asisten.posttest.create', compact('selectedHalaqah', 'praktikans', 'posttests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'halaqah_id' => 'required|exists:halaqahs,id',
            'posttests' => 'required|array',
            'posttests.*.kbq' => 'required|numeric|min:0|max:100',
            'posttests.*.hb' => 'required|numeric|min:0|max:100',
            'posttests.*.mh' => 'required|numeric|min:0|max:100',
        ]);

        foreach ($request->posttests as $userId => $scores) {
            $sum = $scores['kbq'] + $scores['hb'] + $scores['mh'];
            $totalScore = $sum / 30 * 100 ; 

            Posttest::updateOrCreate(
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

        return redirect()->back()->with('success', 'Nilai Posttest berhasil disimpan.');


    }
}
