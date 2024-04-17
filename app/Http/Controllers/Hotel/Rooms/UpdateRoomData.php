<?php

namespace App\Http\Controllers\Hotel\Rooms;

use App\Http\Controllers\Controller;
use App\Models\HotelRooms;
use App\Repositories\hotel\RoomsRepositories;
use Illuminate\Http\Request;

class UpdateRoomData extends Controller
{
    private RoomsRepositories $repositories;

    public function __construct(RoomsRepositories $repositories)
    {
        $this->repositories = $repositories;
    }
    public function __invoke(Request $request,$id)
    {
        $data = $request->all();
        $validated = HotelRooms::validatedCreatedData($data);

        if ($validated->fails()) {
            return response()->json(['success' => false, 'errors' => $validated->errors()]);
        }

        $this->repositories->updateRoom($id, $data);
        return response()->json(['success' => true]);
    }
}
