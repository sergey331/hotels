<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class Create extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Staff/Create');
    }
}
