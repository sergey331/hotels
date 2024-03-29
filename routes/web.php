<?php

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
            Route::get('/create', [HotelController::class, 'create'])->name('hotel.create');
            Route::post('/store', [HotelController::class, 'store'])->name('hotel.store');
            Route::post('/save', [HotelController::class, 'save'])->name('hotel.save');
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
