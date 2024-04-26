<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class GetCities extends Controller
{
    public function __invoke($state_id)
    {
        $cities= City::where('state_id',$state_id)->get();
        return response()->json($cities);
    }
}
