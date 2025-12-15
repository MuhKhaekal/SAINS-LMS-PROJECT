<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ClassPaiExport;
use App\Http\Controllers\Controller;
use App\Models\ClassPai;
use App\Models\Meeting;
use App\Models\Posttest;
use App\Models\Presence;
use App\Models\Pretest;
use App\Models\TestSubmission;
use App\Models\User;
use App\Models\WeeklyScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ClassController extends Controller
{
    public function index(Request $request)
    {
        $query = ClassPai::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('class_name', 'like', '%' . $request->search . '%')
                  ->orWhere('lecturer', 'like', '%' . $request->search . '%');
            });
        }
    
    
        $classPais = $query->paginate(10);
    
        return view('dashboard.admin.daftar-kelas.index', compact('classPais'));
    }


    public function store(Request $request)
    {
        $messages = [
            'class_name.required' => 'Nama kelas wajib diisi.',
            'lecturer.required' => 'Nama dosen wajib diisi.',
        ];
        
        $validator = Validator::make($request->all(), [
            'class_name' => 'required|string|max:255',
            'lecturer' => 'required|string|max:255',
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Periksa kembali input Anda!');
        }
    
        ClassPai::create([
            'class_name' => $request->class_name,
            'lecturer' => $request->lecturer,
        ]);
    
        return redirect()->route('daftar-kelas.index')->with('success', 'Data kelas berhasil ditambahkan');
    }


    public function update(Request $request, string $id)
    {
        $messages = [
            'class_name.required' => 'Nama kelas wajib diisi.',
            'lecturer.required' => 'Nama dosen wajib diisi.',
        ];
        
        $validator = Validator::make($request->all(), [
            'class_name' => 'required|string|max:255',
            'lecturer' => 'required|string|max:255',
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Periksa kembali input Anda!');
        }

        $classPai = ClassPai::findOrFail($id);

        $data = [
            'class_name' => $request->class_name,
            'lecturer' => $request->lecturer,
        ];

        $classPai->update($data);

        return redirect()->route('daftar-kelas.index')->with('success', 'Data kelas berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $classPais = ClassPai::findOrFail($id);

        $classPais->delete();
        return redirect()->route('daftar-kelas.index')->with('success', 'Data kelas berhasil dihapus');
    }

    public function destroyMultiple(Request $request){
        $ids = $request->input('ids');

        if (!$ids) {
            return redirect()->back()->with('error', 'Tidak ada data yang dipilih.');
        }
    
        ClassPai::whereIn('id', $ids)->delete();
    
        return redirect()->back()->with('success', 'Data kelas berhasil dihapus.');
    }

    public function show($id)
    {
        // Panggil fungsi hitung data
        $data = $this->getCalculationData($id);
        
        // Return view show biasa
        return view('dashboard.admin.daftar-kelas.show', $data);
    }

    // --- METHOD BARU UNTUK EXPORT ---
    public function export($id)
    {
        // Panggil fungsi hitung data yang sama
        $data = $this->getCalculationData($id);
        
        $namaFile = 'Rekap_Nilai_' . str_replace(' ', '_', $data['classPai']->class_name) . '.xlsx';

        return Excel::download(new ClassPaiExport($data), $namaFile);
    }

    // --- LOGIKA PERHITUNGAN DIPINDAHKAN KESINI (PRIVATE) ---
    private function getCalculationData($id)
    {
        $classPai = ClassPai::with('halaqahs.prodi.faculty')->findOrFail($id);
        $halaqahIds = $classPai->halaqahs->pluck('id');
        
        $praktikans = User::where('role', 'praktikan')
            ->whereHas('halaqahs', function($q) use ($halaqahIds) {
                $q->whereIn('halaqahs.id', $halaqahIds);
            })
            ->with(['halaqahs' => function($q) use ($halaqahIds) {
                $q->whereIn('halaqahs.id', $halaqahIds);
            }])
            ->get();

        $skkMeetingIds = Meeting::where('type', 'skk')->pluck('id');
        $totalMeetings = $skkMeetingIds->count() ?: 1;

        // Init Stats
        $categories = ['SANGAT BAIK', 'BAIK', 'CUKUP', 'KURANG', 'SANGAT KURANG', 'TIDAK ADA NILAI'];
        $statsPre  = array_fill_keys($categories, 0);
        $statsPost = array_fill_keys($categories, 0);
        $statsLulus = ['LULUS' => 0, 'TIDAK LULUS' => 0];

        foreach ($praktikans as $p) {
            $userHalaqah = $p->halaqahs->first(); 
            $hId = $userHalaqah ? $userHalaqah->id : null;
            if (!$hId) continue; 

            // --- 1. PRETEST ---
            $pre = Pretest::where('user_id', $p->id)->where('halaqah_id', $hId)->first();
            $p->pre_kbq = $pre ? $pre->kbq : 0;
            $p->pre_hb  = $pre ? $pre->hb : 0;
            $p->pre_mh  = $pre ? $pre->mh : 0;
            $p->pre_hasil = $pre ? number_format(($pre->kbq + $pre->hb + $pre->mh) / 30 * 100, 2) : 0;
            $p->pre_ket   = $this->getKeterangan($p->pre_hasil);

            // --- 2. WEEKLY ---
            $weekly = WeeklyScore::where('user_id', $p->id)->where('halaqah_id', $hId)->first();
            $p->score1 = $weekly ? $weekly->score1 : 0;
            $p->score2 = $weekly ? $weekly->score2 : 0;
            $p->score3 = $weekly ? $weekly->score3 : 0;
            $p->score4 = $weekly ? $weekly->score4 : 0;
            $p->score5 = $weekly ? $weekly->score5 : 0;
            $p->score6 = $weekly ? $weekly->score6 : 0;

            // --- 3. POSTTEST ---
            $post = Posttest::where('user_id', $p->id)->where('halaqah_id', $hId)->first();
            $p->post_kbq = $post ? $post->kbq : 0;
            $p->post_hb  = $post ? $post->hb : 0;
            $p->post_mh  = $post ? $post->mh : 0;
            $p->post_hasil = $post ? number_format(($post->kbq + $post->hb + $post->mh) / 30 * 100, 2) : 0;
            $p->post_ket   = $this->getKeterangan($p->post_hasil);

            // --- 4. FINAL & TOTAL ---
            $final = TestSubmission::where('user_id', $p->id)->where('halaqah_id', $hId)->latest()->first();
            $p->final_score = $final ? $final->score : 0;

            $avgWeekly = ($p->score1 + $p->score2 + $p->score3 + $p->score4 + $p->score5 + $p->score6) / 6;
            $p->val_kbq_30 = ($avgWeekly * 10) * 0.30;

            $hadirCount = Presence::where('user_id', $p->id)->where('halaqah_id', $hId)->whereIn('meeting_id', $skkMeetingIds)->where('status', 'hadir')->count();
            $p->val_absen_50 = ($hadirCount / $totalMeetings) * 100 * 0.50;

            $p->val_final_20 = $p->final_score * 0.20;
            $p->val_total = $p->val_kbq_30 + $p->val_absen_50 + $p->val_final_20;

            $p->ket_absen = $p->val_absen_50 > 25 ? 'AKTIF' : 'TIDAK AKTIF';
            $p->ket_lulus = $p->val_total >= 50 ? 'LULUS' : 'TIDAK LULUS';

            // --- 5. STATS COUNTER ---
            $labelPre = ($p->pre_ket == '-') ? 'TIDAK ADA NILAI' : $p->pre_ket;
            $labelPost = ($p->post_ket == '-') ? 'TIDAK ADA NILAI' : $p->post_ket;

            if (isset($statsPre[$labelPre])) $statsPre[$labelPre]++;
            if (isset($statsPost[$labelPost])) $statsPost[$labelPost]++;
            if (isset($statsLulus[$p->ket_lulus])) $statsLulus[$p->ket_lulus]++;
        }

        $facultyList = $classPai->halaqahs->pluck('prodi.faculty.faculty_name')->unique()->filter()->join(', ') ?: '-';
        $prodiList = $classPai->halaqahs->pluck('prodi.prodi_name')->unique()->filter()->join(', ') ?: '-';

        // Return Array Data
        return compact('classPai', 'praktikans', 'facultyList', 'prodiList', 'statsPre', 'statsPost', 'statsLulus', 'categories');
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
}
