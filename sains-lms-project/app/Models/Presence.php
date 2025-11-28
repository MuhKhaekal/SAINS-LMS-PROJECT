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
}
