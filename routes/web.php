<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/new-car', [App\Http\Controllers\CarController::class, 'new_car'])->name('new.car');
Route::post('/new-car', [App\Http\Controllers\CarController::class, 'store_car'])->name('store.car');
Route::get('/car-list', [App\Http\Controllers\CarController::class, 'car_list'])->name('car.list');

Route::get('/available-car', [App\Http\Controllers\BookingController::class, 'available_car'])->name('available.car');
Route::get('/show-available-car', [App\Http\Controllers\BookingController::class, 'show_available_car'])->name('available-cars');
Route::get('/book/{id}', [App\Http\Controllers\BookingController::class, 'book'])->name('book');
Route::post('/book/{id}', [App\Http\Controllers\BookingController::class, 'book_car'])->name('book.car');
Route::get('/booking-list', [App\Http\Controllers\BookingController::class, 'booking_list'])->name('booking.list');
Route::put('/booking-confirm/{id}', [App\Http\Controllers\BookingController::class, 'booking_confirm'])->name('booking.confirm');