<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class HotelRooms extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['images'];

    public static function validatedCreatedData($data):  \Illuminate\Validation\Validator
    {
        $rules = [
            'price' => 'required|numeric',
            'room_count' => 'required|numeric',
            'currency' => 'required|string',
            'number' => 'required|string',
            'images' => 'nullable|array',
            'images.*' => 'mimes:jpeg,jpg,png,gif',
        ];

        return Validator::make($data, $rules);
    }

    public function hotel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    public function images()
    {
        return $this->hasMany(HotelRoomImages::class, 'hotel_room_id');
    }
}
