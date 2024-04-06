<?php

namespace App\Repositories\hotel;

use App\Models\HotelRooms;
use App\Repositories\AuthHelper;

class RoomsRepositories
{
    public function getRooms($filter)
    {

        $hotel = AuthHelper::getCurrentHotel();

        $rooms = HotelRooms::query();

        if ($hotel) {
            $rooms = $rooms->where('hotel_id', $hotel->id);
        }

        if (isset($filter['search']) && $filter['search'] !== '') {
            $rooms = $rooms->where('price', 'like', '%'.$filter['search'].'%');
        }

        if (isset($filter['currency']) && $filter['currency'] !== '') {

            $rooms = $rooms->where('currency', '=', $filter['currency']);
        }

        if (isset($filter['sort'])) {
            foreach ($filter['sort'] as $key => $value) {
                $rooms = $rooms->orderBy($key, $value);
            }
        }

        $per_page = $filter['per_page'] ?? 10;

        return $rooms->paginate($per_page);
    }
}
