<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
class PlansController extends Controller
{
    public function index()
    {
        $plans = Plan::all();

        return Inertia::render('Plans/index',compact('plans'));
    }

    public function choose(Request $request)
    {
        $user = Auth::user();
        $plan = Plan::find($request->id);
        $expired = date('Y-m-d',strtotime('+' . $plan->period));
        $user->plan_id = $plan->id;
        $user->plan_expired = $expired;
        $user->save();
        return redirect()->route('dashboard');
    }
}
