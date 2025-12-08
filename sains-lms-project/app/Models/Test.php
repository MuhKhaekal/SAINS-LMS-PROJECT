<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
        'user_id', 
        'title', 
        'description',  
        'duration'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function questions() {
        return $this->hasMany(Question::class)->orderBy('order_number');
    } 

    public function session() {
        return $this->hasOne(TestSession::class);
    } 

    public function submissions()
    {
        return $this->hasMany(TestSubmission::class);
    }
}
