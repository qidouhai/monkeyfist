<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    
    protected $table = 'conversations';

    public function participants() {
    	return $this->hasMany('App\Participant');
    }

    public function messages() {
    	return $this->hasMany('App\Message');
    }
}
