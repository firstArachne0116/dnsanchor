<?php

namespace App\Listeners;

use App\Models\AccessLog;

class CreateFailedAccessLogEntry {
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
            'status'     => 'failed',
            'url'        => $request->fullUrl(),
            'username'   => $request->input( 'email' ),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ] );
    }
}
