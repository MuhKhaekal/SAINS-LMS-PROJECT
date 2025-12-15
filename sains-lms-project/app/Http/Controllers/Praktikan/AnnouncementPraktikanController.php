<?php

namespace App\Http\Controllers\Praktikan;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementPraktikanController extends Controller
{

    public function index()
    {
        $announcements = Announcement::all();
        return view('dashboard.praktikan.pengumuman.index', compact('announcements'));
    }

}
