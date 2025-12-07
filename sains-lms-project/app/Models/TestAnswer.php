<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestAnswer extends Model
{
    protected $fillable = [
        'submission_id',
        'question_id',
        'answer_text',
        'question_option_id',
        'is_correct',
        'score'
    ];

    public function submission()
    {
        return $this->belongsTo(TestSubmission::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function option()
    {
        return $this->belongsTo(QuestionOption::class, 'question_option_id');
    }
}
