<?php

namespace App\Http\Controllers\Asisten;

use App\Http\Controllers\Controller;
use App\Models\Halaqah;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class HalaqahAsistenController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $meetings = Meeting::all();
        $halaqahName = $request->halaqah_name;

        $selectedHalaqah = null;
    
        if ($halaqahName) {
            $selectedHalaqah = Halaqah::where('halaqah_name', $halaqahName)->first();
        }
    
        if ($selectedHalaqah) {
            $this->authorize('view', $selectedHalaqah);
        }
    
        return view('dashboard.asisten.halaqah.index', compact('selectedHalaqah', 'meetings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
