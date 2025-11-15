<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = [
        'faculty_code',
        'faculty_name',
    ];

    public function prodies()
    {
        return $this->hasMany(Prodi::class, 'faculty_id');
    }

    public function halaqahs()
    {
        return $this->hasManyThrough(Halaqah::class, Prodi::class, 'faculty_id', 'prodi_id');
    }
}
