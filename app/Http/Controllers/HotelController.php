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
        return Inertia::render('Hotels/Index', [
            'hotel' => Auth::user()->hotel,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Hotels/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HotelRequest $request)
    {
        $user = Auth::user();
        $user->hotel()->create($request->all());

        return response()->json(['success' => true, 'message' => 'hotel created successfully']);
    }

    public function save(Request $request)
    {
        try {
            $data = $request->all();
            $validated = Hotel::validateRooms($data);

            if ($validated->fails()) {
                return response()->json(['errors' => $validated->getMessageBag()->all()]);
            }

            $this->hotelRepository->save($data);
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
