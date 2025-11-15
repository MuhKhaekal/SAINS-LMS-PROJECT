<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PivotHalaqahUser extends Model
{
    protected $fillable = [
        'halaqah_id',
        'user_id'
    ];
}
