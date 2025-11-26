<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'material_name',
        'description',
        'file_location',
        'halaqah_id',
        'meeting_id',
    ];

    public function halaqah()
    {
        return $this->belongsTo(Halaqah::class, 'halaqah_id');
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class, 'meeting_id');
    }
}
