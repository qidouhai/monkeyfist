<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $table = 'friends';

    public function user() {
        return $this->belongsTo(User::class);
    }
}
