<?php

use App\Http\Controllers\Hotel\Rooms\CreateRoomData;
use App\Http\Controllers\Hotel\Rooms\DeleteRoomData;
use App\Http\Controllers\Hotel\Rooms\GetRoomData;
use App\Http\Controllers\Hotel\Rooms\UpdateRoomData;
use App\Http\Controllers\Hotel\Service\CreateServiceData;
use App\Http\Controllers\Hotel\Service\DeleteServiceData;
use App\Http\Controllers\Hotel\Service\GetServiceData;
use App\Http\Controllers\Hotel\Service\UpdateServiceData;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['plan', 'auth'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::prefix('hotel')->group(function () {
        Route::group(['middleware' => 'hotel'], function () {
            Route::get('/', [HotelController::class, 'index'])->name('hotel.index');
            Route::get('/get', [HotelController::class, 'getHotel'])->name('hotel.get');
            Route::get('/create', [HotelController::class, 'create'])->name('hotel.create');
            Route::post('/store', [HotelController::class, 'store'])->name('hotel.store');
            Route::post('/save', [HotelController::class, 'save'])->name('hotel.save');

            /* Rooms */

            Route::get('/rooms', [HotelController::class, 'rooms'])->name('hotel.rooms');
            Route::get('/rooms/new', [HotelController::class, 'roomNew'])->name('hotel.room.new');
            Route::get('/get-room-data', [GetRoomData::class, '__invoke'])->name('hotel.get_room_data');
            Route::post('/create-room-data', [CreateRoomData::class, '__invoke'])->name('hotel.create_room_data');
            Route::put('/update-room-data/{id}', [UpdateRoomData::class, '__invoke'])->name('hotel.update_room_data');
            Route::delete('/delete-room-data/{id}', [DeleteRoomData::class, '__invoke'])->name('hotel.delete_room_data');
            Route::get('/room/edit/{room}', [HotelController::class, 'editRoom'])->name('hotel.edit_room');

            /* Service */

            Route::get('/service', [HotelController::class, 'service'])->name('hotel.service');
            Route::get('get-service-data', [GetServiceData::class, '__invoke'])->name('hotel.get_service_data');
            Route::post('create-service-data', [CreateServiceData::class, '__invoke'])->name('hotel.create_service_data');
            Route::put('update-service-data', [UpdateServiceData::class, '__invoke'])->name('hotel.update_service_data');
            Route::delete('delete-service-data', [DeleteServiceData::class, '__invoke'])->name('hotel.delete_service_data');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/plan', [PlansController::class, 'index'])->name('choosePlan');
    Route::post('/choose', [PlansController::class, 'choose'])->name('choose');
});

require __DIR__.'/auth.php';
