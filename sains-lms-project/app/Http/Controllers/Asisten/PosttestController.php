<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use App\Models\Halaqah;
use App\Models\Posttest;
use Illuminate\Http\Request;

class PosttestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
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

    /**
     * Store a newly created resource in storage.
     */
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
