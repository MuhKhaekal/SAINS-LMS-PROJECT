<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $fillable = [
        'meeting_id',
        'halaqah_id',
        'user_id',
        'status',
        'description',
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function halaqah()
    {
        return $this->belongsTo(Halaqah::class);
    }
}
