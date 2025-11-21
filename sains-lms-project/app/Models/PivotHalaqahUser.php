<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PivotHalaqahUser extends Model
{
    protected $fillable = [
        'halaqah_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function halaqah()
    {
        return $this->belongsTo(Halaqah::class, 'halaqah_id');
    }

}
