<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prename', 'lastname', 'username', 'email', 'password', 'birthday',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function feeds() {
        return $this->hasMany(Feed::class);
    }

    public function comments() {
        return $this->hasMany(FeedComment::class);
    }

    public function likes() {
    	return $this->hasMany(Like::class);
    }
}
