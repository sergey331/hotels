<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hotel_price_discounts', function (Blueprint $table) {
            $table->id();
            $table->integer('discount');
            $table->date('from');
            $table->date('to');
            $table->foreignId('hotel_room_id')->references('id')->on('hotel_rooms')->onDelete('cascade');
            $table->foreignId('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_price_discounts');
    }
};
