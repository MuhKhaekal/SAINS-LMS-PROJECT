<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'type', 
        'file_location'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'pivot_certificate_users', 'certificate_id', 'user_id')
                    ->withTimestamps();
    }
}
