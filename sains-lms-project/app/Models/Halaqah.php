<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Halaqah extends Model
{
    protected $fillable = [
        'halaqah_code',
        'halaqah_name',
        'halaqah_type',
        'prodi_id',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'pivot_halaqah_users', 'halaqah_id', 'user_id')
                    ->withTimestamps();
    }

    public function asisten()
    {
        return $this->belongsToMany(User::class, 'pivot_halaqah_users')
                    ->where('role', 'asisten');
    }

}
