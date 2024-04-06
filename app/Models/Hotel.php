<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Hotel extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['rooms', 'services'];

    public static function validateRooms($data): \Illuminate\Validation\Validator
    {
        $rules = [
            'rooms' => 'required|array',
            'rooms.*.price' => 'required|numeric',
            'rooms.*.room_count' => 'required|numeric',
            'services' => 'nullable|array',
        ];

        return Validator::make($data, $rules);
    }

    public function rooms(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HotelRooms::class);
    }

    public function discountRooms(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HotelPriceDiscount::class);
    }

    public function services(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HotelService::class);
    }
}
