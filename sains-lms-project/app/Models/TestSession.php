<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestSession extends Model
{
    protected $fillable = [
        'test_id',
        'halaqah_id',
        'is_open',
        'opened_at',
    ];

    public function test() {
        return $this->belongsTo(Test::class);
    }

    public function halaqah() {
        return $this->belongsTo(Halaqah::class);
    }
}
