<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class GetCountries extends Controller
{
    public function __invoke()
    {
        $countries = Country::get();
        return response()->json($countries);
    }
}
