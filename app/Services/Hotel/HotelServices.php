<?php

namespace App\Services\Hotel;

use App\Models\HotelRoomImages;
use App\Models\HotelRooms;
use App\Repositories\AuthHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

class HotelServices
{
    private $hotel;

    private $roomData = [];

    private $roomId;

    private $roomIds = [];

    private $model;

    private $serviceData = [];

    private $serviceId;

    private $serviceIds = [];

    public function setModel($model): void
    {
        $this->model = new $model();
    }

    public function setHotel($hotel): void
    {
        $this->hotel = $hotel;
    }

    public function getRoom($id)
    {
        return HotelRooms::where(['hotel_id' => $this->getHotelId(), 'id' => $id])->first();
    }

    public function getService($id)
    {
        return $this->model::where(['hotel_id' => $this->getHotelId(), 'id' => $id])->first();
    }

    public function getHotelId()
    {
        return $this->hotel->id ?? null;
    }

    public function setHotelRooms($room): void
    {
        $this->roomId = $room['id'];
        if ($room['id']) {
            $this->roomIds[] = $room['id'];
        }
        $this->roomData = [
            'price' => $room['price'],
            'room_count' => $room['room_count'],
            'currency' => $room['currency'],
            'room_images' => $room['images'] ?? [],
        ];
    }

    public function setServiceData($service)
    {
        $this->serviceId = $service['id'];
        if ($service['id']) {
            $this->serviceIds[] = $service['id'];
        }
        $this->serviceData = [
            'name' => $service['name'],
            'description' => $service['description'],
            'time' => date('h:i:s', strtotime($service['time'])),
            'image' => $service['image'],
        ];
    }

    public function processRooms()
    {
        $currentRoom = $this->getRoom($this->roomId);
        if ($currentRoom) {
            $currentRoom->update(Arr::only($this->roomData, ['price', 'room_count', 'currency']));
        } else {
            $room = $this->model->create(array_merge(Arr::only($this->roomData, ['price', 'room_count', 'currency']), ['hotel_id' => $this->getHotelId()]));
            $this->roomId = $room->id;
            $this->roomIds[] = $room->id;
        }
    }

    public function processService(): void
    {
        $currentService = $this->getService($this->serviceId);

        if ($currentService) {
            $currentService->update(Arr::only($this->serviceData, ['name', 'description', 'time']));
        } else {
            $service = $this->model->create(array_merge(Arr::only($this->serviceData, ['name', 'description', 'time']), ['hotel_id' => $this->getHotelId()]));
            $this->serviceId = $service->id;
            $this->serviceIds[] = $service->id;
        }
    }

    public function processImageService(): void
    {
        $image = $this->serviceData['image'];
        if (isset($image) && $image instanceof UploadedFile) {
            $path = public_path('images/hotel/'.$this->getHotelId().'/services/'.$this->serviceId);
            $service = $this->model->find($this->serviceId);
            $service->image = $this->uploadFile($path, $image);
            $service->save();
        }
    }

    public function processRoomImages(): void
    {
        foreach ($this->roomData['room_images'] as $im) {
            $path = public_path('images/hotel/'.$this->hotel->id.'/rooms/'.$this->roomId);

            $image_name = $this->uploadFile($path, $im);
            HotelRoomImages::create([
                'hotel_room_id' => $this->roomId,
                'image' => $image_name,
            ]);
        }
    }

    public function removeRooms(): bool
    {
        $this->model->whereNotIn('id', $this->roomIds)->delete();

        return true;
    }

    public function removeService(): bool
    {
        $this->model->whereNotIn('id', $this->serviceIds)->delete();

        return true;
    }

    public function uploadFile($path, $im): string
    {
        $image_name = time().'_'.$im->getClientOriginalName();
        $im->move($path, $image_name);

        return $image_name;
    }
}
