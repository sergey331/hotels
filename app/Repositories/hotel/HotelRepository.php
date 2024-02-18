<?php

namespace App\Repositories\hotel;

use App\Models\HotelRoomImages;
use App\Repositories\AuthHelper;
use Illuminate\Http\UploadedFile;

class HotelRepository
{
    public function save(array $data)
    {
        $hotel = AuthHelper::getCurrentHotel();
        $rooms = $hotel->rooms();
        $services = $hotel->services();
        foreach ($data['services']['name'] as $key => $r) {
            $currentService = $services->find($data['services']['id'][$key]);
            if (! $currentService) {
                $service = $services->create([
                    'name' => $data['services']['name'][$key],
                    'description' => $data['services']['description'][$key],
                    'time' => date('Y-m-d h:i:s', strtotime($data['services']['description'][$key])),
                ]);
            } else {
                $service = $currentService->update([
                    'name' => $data['services']['name'][$key],
                    'description' => $data['services']['description'][$key],
                    'time' => date('Y-m-d h:i:s', strtotime($data['services']['description'][$key])),
                ]);
            }

            if ($data['services']['image'][$key] instanceof UploadedFile) {
                $path = public_path('images/hotel/'.$hotel->id.'/services/'.$service->id);
                $im = $data['services']['image'][$key];
                $service->image = $this->uploadFile($path, $im);
                $service->save();
            }
        }
        foreach ($data['rooms']['price'] as $key => $r) {
            $currentRoom = $rooms->find($data['rooms']['id'][$key]);

            if (! $currentRoom) {
                $room = $rooms->create([
                    'price' => $data['rooms']['price'][$key],
                    'room_count' => $data['rooms']['room_count'][$key],
                    'currency' => $data['rooms']['currency'][$key],
                ]);
            } else {
                $room = $currentRoom->update([
                    'price' => $data['rooms']['price'][$key],
                    'room_count' => $data['rooms']['room_count'][$key],
                    'currency' => $data['rooms']['currency'][$key],
                ]);
            }
            if (! empty($data['rooms']['room_images'])) {
                foreach ($data['rooms']['room_images'][$key] as $im) {
                    $path = public_path('images/hotel/'.$hotel->id.'/rooms/'.$room->id);

                    $image_name = $this->uploadFile($path, $im);
                    HotelRoomImages::create([
                        'hotel_room_id' => $room->id,
                        'image' => $image_name,
                    ]);
                }
            }
        }
    }

    public function uploadFile($path, $im): string
    {
        $image_name = time().'_'.$im->getClientOriginalName();
        $im->move($path, $image_name);

        return $image_name;
    }
}
