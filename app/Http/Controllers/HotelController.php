<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelRequest;
use App\Models\Hotel;
use App\Repositories\hotel\HotelRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HotelController extends Controller
{
    protected HotelRepository $hotelRepository;

    public function __construct(HotelRepository $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    public function index()
    {
        return Inertia::render('Hotels/Index');
    }

    public function create()
    {
        return Inertia::render('Hotels/Create');
    }
    public function store(HotelRequest $request)
    {
        $user = Auth::user();
        $user->hotel()->create($request->all());

        return response()->json(['success' => true, 'message' => 'hotel created successfully']);
    }

    public function rooms()
    {
        return Inertia::render('Hotels/Rooms');
    }

    public function service()
    {
        return Inertia::render('Hotels/Service');
    }
}
