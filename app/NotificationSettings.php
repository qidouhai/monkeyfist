<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationSettings extends Model {

    protected $table = 'account_notification_settings';

    public function user() {
        return $this->belongsTo('App\User');
    }

}
