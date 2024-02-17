<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['rooms','services'];

    public function  rooms(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HotelRooms::class);
    }
    public function  discountRooms(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HotelPriceDiscount::class);
    }

    public function services()
    {
        return $this->hasMany(HotelService::class);
    }
}
