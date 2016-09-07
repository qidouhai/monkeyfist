<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    
    protected $table = 'participants';
    public $timestamps = false;

    public function conversation() {
    	return $this->belongsTo('App\Conversation');
    }

    public function messages() {
    	return $this->hasMany('App\Message', 'participant');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
