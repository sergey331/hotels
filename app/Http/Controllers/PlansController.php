<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlansController extends Controller
{
    public function index()
    {
        $plans = Plan::all();

        return Inertia::render('Plans/index',compact('plans'));
    }

    public function choose(Request $request)
    {
        $user = User::find(Auth::id());
        
        $plan = Plan::find($request->id);
        $currentPlan = $user->plans()->where(['plan_id'=>$plan->id,'status' => 'active'])->first();
        if (!$currentPlan) {
            $historyFree = $user->plans()->where(['plan_id'=>1,'status' => 'inactive'])->first();
            dd($historyFree);
            if (!$historyFree) {
                $user->plans()->where('status','active')->update(['status' => 'inactive']);
                $expired = date('Y-m-d',strtotime('+' . $plan->period));
                $user->plans()->create(['plan_id' => $plan->id]);
                $user->plan_expired = $expired;
                $user->save();
            } else {
                return redirect()->back()->withErrors(['message' => "You can't choose a free plan"]);
            }
        } 
        return redirect()->route('dashboard');
    }
}
