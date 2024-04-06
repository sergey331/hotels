<?php

namespace App\Repositories\hotel;

use App\Models\HotelRooms;
use App\Models\HotelService;
use App\Repositories\AuthHelper;
use App\Services\Hotel\HotelServices;

class HotelRepository
{
    private HotelServices $hotelService;

    public function __construct(HotelServices $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function save(array $data)
    {
        $hotel = AuthHelper::getCurrentHotel();

        $this->hotelService->setHotel($hotel);
        $this->hotelService->setModel(HotelService::class);
        foreach ($data['services'] as $s) {
            $this->hotelService->setServiceData($s);
            $this->hotelService->processService();
            $this->hotelService->processImageService();
        }
        $this->hotelService->removeService();

        $this->hotelService->setModel(HotelRooms::class);
        foreach ($data['rooms'] as $r) {
            $this->hotelService->setHotelRooms($r);
            $this->hotelService->processRooms();
            $this->hotelService->processRoomImages();
        }

        $this->hotelService->removeRooms();
    }
}
