<?php

namespace App\Http\Middleware;

use Closure;

class DisableClientViewing
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        if ( $request->getHost() === 'isnxo.com' || in_array( $request->getClientIp(), [ '94.3.15.135', '134.209.25.219', '2a02:c7f:408a:7d00:795e:c063:3972:a629' ] ) ) {
            return $next( $request );
//        } else {
//            abort( 500 );
//        }
    }
}
