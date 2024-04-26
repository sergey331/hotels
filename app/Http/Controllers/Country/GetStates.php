<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;

class GetStates extends Controller
{
    public function __invoke($country_id)
    {
        $countries = State::where('country_id',$country_id)->get();
        return response()->json($countries);
    }
}
