<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return view('dashboard.admin.admin-home');
            } elseif (Auth::user()->role == 'admin') {
                return view('dashboard.admin.admin-home');
            } else {
                return view('dashboard.praktikan.praktikan-home');
            }
        } else {
            return redirect('login');
        }
    }
}
