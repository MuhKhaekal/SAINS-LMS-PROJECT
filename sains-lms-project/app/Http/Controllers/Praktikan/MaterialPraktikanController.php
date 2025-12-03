<?php

namespace App\Http\Controllers\Praktikan;

use App\Http\Controllers\Controller;
use App\Models\Halaqah;
use App\Models\Material;
use App\Models\Meeting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class MaterialPraktikanController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $meetingName = $request->meeting_name;
        $halaqahName = $request->halaqah_name;

        $selectedMeeting = Meeting::where('meeting_name', $meetingName)->first();
        $selectedHalaqah = Halaqah::where('halaqah_name', $halaqahName)->first();

        if ($selectedHalaqah) {
            $this->authorize('view', $selectedHalaqah);
        }

        $materials = Material::where('meeting_id', $selectedMeeting->id)
            ->where('halaqah_id', $selectedHalaqah->id)
            ->get();

        return view('dashboard.praktikan.materi.index', compact(
            'selectedMeeting',
            'selectedHalaqah',
            'materials'
        ));
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
