<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HotelCreate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    CONST ROUTE_LIST = [
      'hotel',
      'hotel/rooms',
      'hotel/service',
    ];
    public function handle(Request $request, Closure $next): Response
    {

//        dd($request->route());
        $user = \auth()->user();
        if (! $user->hotel && in_array($request->route()->uri, self::ROUTE_LIST)) {
            return redirect()->route('hotel.create');
        } elseif ($user->hotel && $request->route()->uri === 'hotel/create') {
            return redirect()->route('hotel.index');
        }

        return $next($request);
    }
}
