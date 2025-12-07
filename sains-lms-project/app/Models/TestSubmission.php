<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestSubmission extends Model
{
    protected $dates = [
        'started_at', 
        'submitted_at'
    ];

    protected $fillable = [
        'test_id',
        'user_id',
        'halaqah_id',
        'score',
        'started_at',
        'submitted_at',
        'duration_seconds'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'submitted_at' => 'datetime',
    ];
    

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(TestAnswer::class, 'submission_id');
    }
}
