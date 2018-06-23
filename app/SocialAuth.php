<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAuth extends Model
{
    protected $fillable = ['provider', 'social_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
