<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $fillable = [
        'prodi_code',
        'prodi_name',
        'faculty_id'
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    public function halaqahs()
    {
        return $this->hasMany(Halaqah::class, 'prodi_id');
    }
}
