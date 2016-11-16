<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrivacySettings extends Model {

    protected $table = 'account_privacy_settings';

    public function user() {
        return $this->belongsTo('App\User');
    }

}
