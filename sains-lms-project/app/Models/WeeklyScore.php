<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklyScore extends Model
{
    protected $fillable = [
        'halaqah_id',
        'user_id',
        'score1',
        'score2',
        'score3',
        'score4',
        'score5',
        'score6',
        'description',
    ];
}
