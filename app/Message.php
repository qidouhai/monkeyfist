<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    
    protected $table = 'messages';

    public function conversation() {
    	return $this->belongsTo('App\Conversation');
    }

    public function participant() {
    	return $this->belongsTo('App\Participant');
    }
}
