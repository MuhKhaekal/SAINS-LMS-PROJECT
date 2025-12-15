<?php

namespace App\Http\Controllers;

use App\Models\ClassPai;
use App\Models\Faculty;
use App\Models\Halaqah;
use App\Models\Presence;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                

                $stats = [
                    'asisten'   => User::where('role', 'asisten')->count(),
                    'praktikan' => User::where('role', 'praktikan')->count(),
                    'halaqah'   => Halaqah::count(),
                    'kelas'     => ClassPai::count(),
                ];
        
                $presenceRaw = Presence::selectRaw('status, count(*) as total')
                    ->groupBy('status')
                    ->pluck('total', 'status');
        
                $chartPresence = [
                    $presenceRaw['Hadir'] ?? 0,
                    $presenceRaw['Izin'] ?? 0,
                    $presenceRaw['Sakit'] ?? 0,
                    $presenceRaw['Alfa'] ?? 0,
                ];
        
                $faculties = Faculty::withCount('halaqahs')->get();
        

                $labelsFakultas = $faculties->pluck('faculty_code'); 
                $dataFakultas   = $faculties->pluck('halaqahs_count'); 
        
                $recentPresences = Presence::with(['user', 'halaqah'])
                    ->latest()
                    ->limit(5)
                    ->get();
        
                $topAsisten = User::where('role', 'asisten')
                    ->withCount('halaqahs')
                    ->orderByDesc('halaqahs_count')
                    ->limit(5)
                    ->get();
        
                return view('dashboard.admin.admin-home', compact(
                    'stats', 
                    'chartPresence', 
                    'labelsFakultas', 
                    'dataFakultas',
                    'recentPresences',
                    'topAsisten'
                ));


            } elseif (Auth::user()->role == 'asisten') {
                return view('dashboard.asisten.asisten-home');
            } else {
                return view('dashboard.praktikan.praktikan-home');
            }
        } else {
            return redirect('login');
        }
    }
}
