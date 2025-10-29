<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\FilterController;



// Route::get('/', [FilterController::class, 'showBrands'])->name('home');


Route::get('/register', [SessionController::class, 'showRegister'])->name('register.show');
Route::post('/register', [SessionController::class, 'register'])->name('register.post');

Route::get('/login', [SessionController::class, 'showLogin'])->name('login.show');
Route::post('/login', [SessionController::class, 'login'])->name('login.post');

Route::get('/logout', [SessionController::class, 'logout'])->name('logout');


Route::get('/add-car', [CarController::class, 'showAdd'])->name('cars.create');
Route::post('/add-car', [CarController::class, 'store'])->name('cars.store');


Route::get('/get-models-by-brand', [FilterController::class, 'getModelsByBrand'])->name('getModelsByBrand');
Route::get('/get-gear-type-by-model', [FilterController::class, 'getGearTypeByModel'])->name('getGearTypeByModel');
Route::get('/get-fuel-type-by-gear-type', [FilterController::class, 'getFuelTypeByGearType'])->name('getFuelTypeByGearType');

Route::get('/filtered-cars', [FilterController::class, 'filterCars'])->name('cars.filter');


Route::get('/', [FilterController::class, 'showCars'])->name('home');




