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
    public function handle(Request $request, Closure $next): Response
    {
        $user = \auth()->user();
        if (! $user->hotel && $request->route()->uri === 'hotels') {
            return redirect()->route('hotel.create');
        } elseif ($user->hotel && $request->route()->uri === 'hotels/create') {
            return redirect()->route('hotel.index');
        }

        return $next($request);
    }
}
