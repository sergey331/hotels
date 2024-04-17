<?php

namespace App\Repositories\hotel;

use App\Models\HotelRoomImages;
use App\Models\HotelRooms;
use App\Repositories\AuthHelper;
use Illuminate\Support\Facades\File;

class RoomsRepositories
{
    public function getRooms($filter)
    {
        $hotel = $this->getHotel();
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

    public function getRoom($id)
    {
        $hotel = $this->getHotel();
        if (! $hotel) {
            return null;
        }

        return HotelRooms::where(['hotel_id' => $hotel->id, 'id' => $id])->first();
    }

    public function saveRoom($data)
    {
        $hotel = $this->getHotel();
        $roomData = [
            'price' => $data['price'],
            'room_count' => $data['room_count'],
            'number' => $data['number'],
            'currency' => $data['currency'],
            'hotel_id' => $hotel->id,
        ];
        $room_images = $data['images'] ?? [];

        $room = new HotelRooms();

        $room->fill($roomData);
        $room->save();

        if (! empty($room_images)) {
            foreach ($room_images as $image) {
                $path = public_path('images/hotel/'.$hotel->id.'/rooms/'.$room->id);
                $image_name = $this->uploadFile($path, $image);
                HotelRoomImages::create([
                    'hotel_room_id' => $room->id,
                    'image' => $image_name,
                ]);
            }
        }
    }

    public function updateRoom($id, $data)
    {
        $room = $this->getRoom($id);

        if (!$room) {
            return;
        }
        $hotel = $this->getHotel();
        $roomData = [
            'price' => $data['price'],
            'room_count' => $data['room_count'],
            'number' => $data['number'],
            'currency' => $data['currency'],
            'hotel_id' => $hotel->id,
        ];

        $room->fill($roomData);
        $room->save();
        $room_images = $data['images'] ?? [];

        if (! empty($room_images)) {
            foreach ($room_images as $image) {
                $path = public_path('images/hotel/'.$hotel->id.'/rooms/'.$room->id);
                $image_name = $this->uploadFile($path, $image);
                HotelRoomImages::create([
                    'hotel_room_id' => $room->id,
                    'image' => $image_name,
                ]);
            }
        }
    }

    public function deleteRoom($id)
    {
        $room = $this->getRoom($id);
        if (! $room) {
            return false;
        }
        $hotel = $this->getHotel();
        $room->delete();

        $directory = public_path('images/hotel/'.$hotel->id.'/rooms/'.$room->id);
        File::deleteDirectory($directory);
        return true;
    }

    private function getHotel()
    {
        return AuthHelper::getCurrentHotel();
    }

    public function uploadFile($path, $im): string
    {
        $image_name = time().'_'.$im->getClientOriginalName();
        $im->move($path, $image_name);

        return $image_name;
    }
}
