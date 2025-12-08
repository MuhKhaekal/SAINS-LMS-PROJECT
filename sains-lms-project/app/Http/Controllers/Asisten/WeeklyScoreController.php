<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use App\Models\Halaqah;
use App\Models\WeeklyScore;
use Illuminate\Http\Request;

class WeeklyScoreController extends Controller
{
    public function index(Request $request)
    {
        $halaqahName = $request->halaqah_name;
        $selectedHalaqah = Halaqah::where('halaqah_name', $halaqahName)->firstOrFail();
    
        $weeklyScores = WeeklyScore::where('halaqah_id', $selectedHalaqah->id)->get()->keyBy('user_id');
    
        $praktikans = $selectedHalaqah
            ? $selectedHalaqah->users()->where('role', 'praktikan')->get()
            : collect();

        return view('dashboard.asisten.nilai.perpekan.index', compact('selectedHalaqah', 'praktikans', 'weeklyScores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'halaqah_id'  => 'required|exists:halaqahs,id',
            'weeklyScore' => 'required|array',
            'weeklyScore.*.score1' => 'nullable|numeric|min:0|max:100',
            'weeklyScore.*.score2' => 'nullable|numeric|min:0|max:100',
            'weeklyScore.*.score3' => 'nullable|numeric|min:0|max:100',
            'weeklyScore.*.score4' => 'nullable|numeric|min:0|max:100',
            'weeklyScore.*.score5' => 'nullable|numeric|min:0|max:100',
            'weeklyScore.*.score6' => 'nullable|numeric|min:0|max:100',
            'weeklyScore.*.description' => 'nullable|string',
        ]);
    
        $halaqahId = $request->halaqah_id;
        $weeklyScoresData = $request->input('weeklyScore');
    
        foreach ($weeklyScoresData as $userId => $data) {
            WeeklyScore::updateOrCreate(
                [
                    'halaqah_id' => $halaqahId,
                    'user_id'    => $userId,
                ],
                [
                    'score1'      => $data['score1'] ?? 0,
                    'score2'      => $data['score2'] ?? 0,
                    'score3'      => $data['score3'] ?? 0,
                    'score4'      => $data['score4'] ?? 0,
                    'score5'      => $data['score5'] ?? 0,
                    'score6'      => $data['score6'] ?? 0,
                    'description' => $data['description'] ?? null,
                ]
            );
        }
    
        return back()->with('success', 'Nilai pekanan berhasil disimpan!');
    }

    
}