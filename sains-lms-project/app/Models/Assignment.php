<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'assignment_name',
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

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

}
