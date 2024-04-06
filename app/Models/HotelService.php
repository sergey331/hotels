<?php

namespace App\Models;

use App\Repositories\AuthHelper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelService extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function hotel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

//    protected function getImageAttribute($value)
//    {
//        $hotel = AuthHelper::getCurrentHotel();
//
//        return env('APP_URL').'/images/hotel/'.$hotel->id .'/services/'.$this->id.'/'.$value;
//    }
}
