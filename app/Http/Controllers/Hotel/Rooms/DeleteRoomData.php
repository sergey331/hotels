<?php

namespace App\Http\Controllers\Hotel\Rooms;

use App\Http\Controllers\Controller;
use App\Repositories\hotel\RoomsRepositories;
use Illuminate\Http\Request;

class DeleteRoomData extends Controller
{
    private RoomsRepositories $repositories;

    public function __construct(RoomsRepositories $repositories)
    {
        $this->repositories = $repositories;
    }
    public function __invoke($id)
    {
        $this->repositories->deleteRoom($id);

        return response()->json(['success' => true]);
    }
}
