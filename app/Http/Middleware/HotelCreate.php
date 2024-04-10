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
    const ROUTE_LIST = [
        'hotel',
        'hotel/rooms',
        'hotel/service',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $user = \auth()->user();
        $uri = $request->route()->uri;
        if (! $user->hotel && in_array($uri, self::ROUTE_LIST)) {
            return redirect()->route('hotel.create');
        } elseif ($user->hotel && $request->route()->uri === 'hotel/create') {
            return redirect()->route('hotel.index');
        }

        return $next($request);
    }
}
