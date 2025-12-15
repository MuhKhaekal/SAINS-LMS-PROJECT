<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionAsistenController extends Controller
{


    public function updateAll(Request $request)
    {
        $scores = $request->input('score', []);
    
        foreach ($scores as $submissionId => $score) {
            Submission::where('id', $submissionId)
                ->update([
                    'score' => $score,
                ]);
        }
    
        return back()->with('success', 'Nilai berhasil diperbarui untuk semua praktikan.');
    }

}
