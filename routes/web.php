<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\FilterController;


// === Ana Sayfa (Marka Filtreleme) ===
// Route::get('/', [FilterController::class, 'showBrands'])->name('home');

// === Kayıt ve Giriş İşlemleri ===
Route::get('/register', [SessionController::class, 'showRegister'])->name('register.show');
Route::post('/register', [SessionController::class, 'register'])->name('register.post');

Route::get('/login', [SessionController::class, 'showLogin'])->name('login.show');
Route::post('/login', [SessionController::class, 'login'])->name('login.post');

Route::get('/logout', [SessionController::class, 'logout'])->name('logout');

// === Araç Ekleme === (cars.create vb.. çünkü başka tabloların create vb.. de olabilir)
Route::get('/add-car', [CarController::class, 'showAdd'])->name('cars.create');
Route::post('/add-car', [CarController::class, 'store'])->name('cars.store');

// === AJAX için Model Getirme ===
Route::get('/get-models-by-brand', [FilterController::class, 'getModelsByBrand'])->name('getModelsByBrand');
Route::get('/get-gear-type-by-model', [FilterController::class, 'getGearTypeByModel'])->name('getGearTypeByModel');
Route::get('/get-fuel-type-by-gear-type', [FilterController::class, 'getFuelTypeByGearType'])->name('getFuelTypeByGearType');
// ===SHOWFILTER===
Route::get('/filtered-cars', [FilterController::class, 'filterCars'])->name('cars.filter');

//===SLIDER===
Route::get('/', [FilterController::class, 'showCars'])->name('home');




