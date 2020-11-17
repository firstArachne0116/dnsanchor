<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification {

    public function getCreatedAtAttribute( $value ) {
        return Carbon::parse( $value )->getTimestamp();
    }

    public function getUpdatedAtAttribute( $value ) {
        return Carbon::parse( $value )->getTimestamp();
    }

}
