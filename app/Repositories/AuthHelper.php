<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;

class AuthHelper
{
    public static function getCurrentHotel()
    {
        return Auth::user()->hotel ?? null;
    }
}
