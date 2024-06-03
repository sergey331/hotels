<?php

use App\Http\Controllers\PlansController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Country\GetCountries;
use App\Http\Controllers\Country\GetStates;
use App\Http\Controllers\Country\GetCities;
use App\Http\Controllers\Staff\Index as StaffIndex;
use App\Http\Controllers\Staff\Create as StaffCreate;
use App\Http\Controllers\Staff\Store as StaffStore;

Route::get('/',[HomeController::class,'index']);
Route::middleware(['plan', 'auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('/staffs',[StaffIndex::class,'__invoke'])->name('staffs.index');
    Route::get('/staff/create',[StaffCreate::class,'__invoke'])->name('staffs.create');
    Route::post('/staff/store',[StaffStore::class,'__invoke'])->name('staffs.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/plan', [PlansController::class, 'index'])->name('choosePlan');
    Route::post('/choose', [PlansController::class, 'choose'])->name('choose');
});
Route::get('/counties',[GetCountries::class,'__invoke']);
Route::get('/states/{country_id}',[GetStates::class,'__invoke']);
Route::get('/cities/{state_id}',[GetCities::class,'__invoke']);

require __DIR__.'/auth.php';
