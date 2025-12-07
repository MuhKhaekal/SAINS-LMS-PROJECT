<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'test_id', 
        'user_id',
        'type',
        'question',
        'image',
        'correct_answer',
        'order_number'
    ];

    public function test() {
        return $this->belongsTo(Test::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function options() {
        return $this->hasMany(QuestionOption::class);
    }
}

