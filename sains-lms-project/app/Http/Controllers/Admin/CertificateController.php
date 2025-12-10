<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.admin.sertifikat.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $type = $request->input('type');

        if ($type == 'sertifikat-praktikan-umum'):
            return view('dashboard.admin.sertifikat.praktikan-umum.index');

        elseif ($type == 'sertifikat-asisten-umum'):
            return view('dashboard.admin.sertifikat.asisten-umum.index');

        elseif ($type == 'sertifikat-praktikan-akhwat-terbaik'):
            return view('dashboard.admin.sertifikat.praktikan-akhwat-terbaik.index');

        elseif ($type == 'sertifikat-praktikan-ikhwan-terbaik'):
            return view('dashboard.admin.sertifikat.praktikan-ikhwan-terbaik.index');

        elseif ($type == 'sertifikat-asisten-akhwat-terbaik'):
            return view('dashboard.admin.sertifikat.asisten-akhwat-terbaik.index');

        elseif ($type == 'sertifikat-asisten-ikhwan-terbaik'):
            return view('dashboard.admin.sertifikat.asisten-ikhwan-terbaik.index');

        else:
            return view('dashboard.admin.sertifikat.index');

        endif;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
