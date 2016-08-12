<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    
    protected $table = 'friends';

    public function users() {
    	$this->belongsToMany('App\User');
    } 
}
