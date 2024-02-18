<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Plans
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $plan = auth()->user()->plans()->where('status', 'active')->first();

        if ($plan) {
            $expired = Carbon::parse(Auth::user()->plan_expired);
            if (Carbon::now() > $expired) {
                return  redirect()->route('choosePlan');
            }
        } else {
            return  redirect()->route('choosePlan');
        }

        return $next($request);
    }
}
