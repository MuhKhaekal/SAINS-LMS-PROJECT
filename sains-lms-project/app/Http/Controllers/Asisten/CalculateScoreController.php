<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use App\Models\ClassPai;
use App\Models\Halaqah;
use App\Models\Meeting;
use App\Models\Posttest;
use App\Models\Presence;
use App\Models\Pretest;
use App\Models\TestSubmission;
use App\Models\WeeklyScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CalculateScoreController extends Controller
{

    public function index(Request $request)
    {
        $halaqahName = $request->query('halaqah_name');
        if (!$halaqahName) return back()->with('error', 'Nama halaqah tidak ditemukan.');

        $asisten = Auth::user();

        $selectedHalaqah = Halaqah::where('halaqah_name', $halaqahName)
            ->with(['prodi.faculty', 'classPais'])
            ->whereHas('users', function($q) use ($asisten) {
                $q->where('users.id', $asisten->id);
            })->first();

        if (!$selectedHalaqah) return back()->with('error', 'Akses ditolak.');

        $linkedClass = $selectedHalaqah->classPais->first();
        if (!$linkedClass) {
            $classPais = ClassPai::all();
            return view('dashboard.asisten.akumulasi-nilai.select-class', compact('selectedHalaqah', 'classPais'));
        }

        $praktikans = $selectedHalaqah->users()->where('role', 'praktikan')->get();

        $skkMeetingIds = Meeting::where('type', 'skk')->pluck('id');

        $totalMeetings = $skkMeetingIds->count();
        if ($totalMeetings == 0) $totalMeetings = 1; 

        foreach ($praktikans as $p) {
            $pre = Pretest::where('user_id', $p->id)->where('halaqah_id', $selectedHalaqah->id)->first();
            $p->pre_kbq = $pre ? $pre->kbq : 0;
            $p->pre_hb  = $pre ? $pre->hb : 0;
            $p->pre_mh  = $pre ? $pre->mh : 0;
            
            $rawPreScore = $pre ? ($pre->kbq + $pre->hb + $pre->mh) / 3 : 0; 
            $p->pre_hasil = $pre ? number_format(($pre->kbq + $pre->hb + $pre->mh) / 30 * 100, 2) : 0;
            $p->pre_ket   = $this->getKeterangan($p->pre_hasil);
            
            $weekly = WeeklyScore::where('user_id', $p->id)->where('halaqah_id', $selectedHalaqah->id)->first();
            $p->score1 = $weekly ? $weekly->score1 : 0;
            $p->score2 = $weekly ? $weekly->score2 : 0;
            $p->score3 = $weekly ? $weekly->score3 : 0;
            $p->score4 = $weekly ? $weekly->score4 : 0;
            $p->score5 = $weekly ? $weekly->score5 : 0;
            $p->score6 = $weekly ? $weekly->score6 : 0;

            $post = Posttest::where('user_id', $p->id)->where('halaqah_id', $selectedHalaqah->id)->first();
            $p->post_kbq = $post ? $post->kbq : 0;
            $p->post_hb  = $post ? $post->hb : 0;
            $p->post_mh  = $post ? $post->mh : 0;
            $p->post_hasil = $post ? number_format(($post->kbq + $post->hb + $post->mh) / 30 * 100, 2) : 0;
            $p->post_ket   = $this->getKeterangan($p->post_hasil);

            $final = TestSubmission::where('user_id', $p->id)->where('halaqah_id', $selectedHalaqah->id)->latest()->first();
            $p->final_score = $final ? $final->score : 0;


            $avgWeekly = ($p->score1 + $p->score2 + $p->score3 + $p->score4 + $p->score5 + $p->score6) / 6;
            $p->val_kbq_30 = ($avgWeekly * 10) * 0.30;


            $hadirCount = Presence::where('user_id', $p->id)
            ->where('halaqah_id', $selectedHalaqah->id)
            ->whereIn('meeting_id', $skkMeetingIds)
            ->where('status', 'Hadir') 
            ->count();
            
            $p->val_absen_50 = ($hadirCount / $totalMeetings) * 100 * 0.50;

            $p->val_final_20 = $p->final_score * 0.20;

            $p->val_total = $p->val_kbq_30 + $p->val_absen_50 + $p->val_final_20;

            $p->ket_absen = $p->val_absen_50 > 25 ? 'AKTIF' : 'TIDAK AKTIF';

            $p->ket_lulus = $p->val_total >= 50 ? 'LULUS' : 'TIDAK LULUS';
        }

        return view('dashboard.asisten.akumulasi-nilai.index', compact('selectedHalaqah', 'linkedClass', 'praktikans'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'halaqah_id' => 'required|exists:halaqahs,id',
            'class_pai_id' => 'required|exists:class_pais,id',
            'halaqah_name' => 'required' 
        ]);

        $halaqah = Halaqah::findOrFail($request->halaqah_id);
        $halaqah->classPais()->sync([$request->class_pai_id]);

        return redirect()->route('akumulasi-nilai.index', ['halaqah_name' => $request->halaqah_name])
            ->with('success', 'Kelas PAI berhasil dipilih.');
    }

    private function getKeterangan($score)
    {
        if ($score >= 91) return 'SANGAT BAIK';
        if ($score >= 81) return 'BAIK';
        if ($score >= 61) return 'CUKUP';
        if ($score >= 21) return 'KURANG';
        if ($score > 0)   return 'SANGAT KURANG';
        return '-';
    }

    public function resetClass(Request $request, $halaqahId)
    {
        $halaqah = Halaqah::findOrFail($halaqahId);

        $halaqah->classPais()->detach();

        return redirect()->route('akumulasi-nilai.index', ['halaqah_name' => $request->halaqah_name])
            ->with('success', 'Pemilihan Kelas PAI berhasil dibatalkan. Silakan pilih ulang.');
    }
}
