<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const AVATARS_PATH = 'avatars/';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'photo',
    ];

    protected $appends = [
        'photo_url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getPhotoUrlAttribute()
    {
        if (isset($this->attributes['photo']) && !empty($this->attributes['photo'])) {
            return asset('storage/' . self::AVATARS_PATH . $this->attributes['photo']);
        }

        return null;
    }

    public function fill(array $attributes)
    {
        (!isset($attributes['password']))?:$attributes['password'] = \Hash::make($attributes['password']);
        return parent::fill($attributes);
    }
}
