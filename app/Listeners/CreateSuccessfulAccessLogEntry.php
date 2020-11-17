<?php

namespace App\Listeners;

use App\Models\AccessLog;

class CreateSuccessfulAccessLogEntry {
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     *
     * @return void
     */
    public function handle( $event ) {
        $request = request();

        AccessLog::create( [
            'status'     => 'success',
            'url'        => $request->fullUrl(),
            'username'   => $event->user->email,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ] );
    }
}
