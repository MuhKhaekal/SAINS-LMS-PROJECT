<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pretest extends Model
{
    protected $fillable = [
        'halaqah_id',
        'user_id',
        'kbq',
        'hb',
        'mh',
        'total',
    ];
}
