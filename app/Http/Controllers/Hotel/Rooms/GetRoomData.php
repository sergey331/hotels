<?php

namespace App\Http\Controllers\Hotel\Rooms;

use App\Http\Controllers\Controller;
use App\Repositories\hotel\RoomsRepositories;
use Illuminate\Http\Request;

class GetRoomData extends Controller
{
    private RoomsRepositories $repositories;

    public function __construct(RoomsRepositories $repositories)
    {
        $this->repositories = $repositories;
    }

    public function __invoke(Request $request)
    {
        $filter = $request->all();
        $paginated = $this->repositories->getRooms($filter);

        return response()->json([
            'success' => true,
            'rooms' => $paginated->items(),
            'pagination' => [
                'current_page' => $paginated->currentPage(),
                'total_pages' => $paginated->lastPage(),
                'per_page' => $paginated->perPage(),
                'total' => $paginated->total(),
            ],
        ]);
    }
}
