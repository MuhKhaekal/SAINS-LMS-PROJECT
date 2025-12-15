<?php

namespace App\Http\Controllers;

use App\Models\Halaqah;
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
                

                $totalUsers = User::count();
                $totalHalaqah = Halaqah::count();
                $totalProdi = Prodi::count();
                
                // Gender
                $maleCount = User::where('gender', 'L')->count();
                $femaleCount = User::where('gender', 'P')->count();
                
                // Chart Data (Contoh query agregat)
                // Anda bisa menggunakan ->groupBy('faculty_id') pada relasi untuk mendapatkan ini
                $facultyNames = ['Teknik', 'Ekonomi', 'Hukum', 'Sastra']; 
                $facultyCounts = [150, 200, 100, 80];
                
                // Recent Halaqah
                $recentHalaqahs = Halaqah::with('prodi')->latest()->take(5)->get();
                
                return view('dashboard.admin.admin-home', compact(
                    'totalUsers', 'totalHalaqah', 'maleCount', 'femaleCount', 
                    'facultyNames', 'facultyCounts', 'recentHalaqahs'
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
