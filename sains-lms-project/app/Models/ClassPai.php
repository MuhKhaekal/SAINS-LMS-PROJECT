<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassPai extends Model
{
    protected $fillable = [
        'class_name',
        'lecturer',
    ];

    public function halaqahs()
    {
        return $this->belongsToMany(
            Halaqah::class,           // Model Tujuan
            'pivot_halaqah_classes',  // Nama Tabel Pivot (Wajib ditulis karena nama tabel Anda custom)
            'class_pai_id',           // Foreign Key untuk model INI (ClassPai) di tabel pivot
            'halaqah_id'              // Foreign Key untuk model TUJUAN (Halaqah) di tabel pivot
        )->withTimestamps();
    }
}
