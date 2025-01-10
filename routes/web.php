<?php

use App\Http\Controllers\BoardingHouseController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\FindController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/check-booking', [BookingController::class, 'checkBooking'])->name('check-booking');
Route::post('/check-booking', [BookingController::class, 'showBooking'])->name('show-booking');
Route::get('/find-booking', [BoardingHouseController::class, 'findBooking'])->name('find-booking');
Route::get('/find-booking-result', [BoardingHouseController::class, 'findBookingResult'])->name('find-booking.result');

Route::get('/detail/{slug}', [BoardingHouseController::class, 'show'])->name('boarding-house.show');

Route::get('/detail/{slug}/room', [BoardingHouseController::class, 'room'])->name('boardingHouse.room');
Route::get('/detail/booking/{slug}', [BookingController::class, 'booking'])->name('booking');
Route::get('/detail/booking/{slug}/information', [BookingController::class, 'getBookingInformation'])->name('booking.information');

Route::get('/detail/booking/{slug}/checkout', [BookingController::class, 'checkout'])->name('booking.checkout');


Route::get('/booking/success', [BookingController::class, 'success'])->name('booking.success');


Route::post('/detail/booking/{slug}/payment', [BookingController::class, 'storeDB'])->name('booking.payment');
Route::post('/detail/booking/{slug}/information/save', [BookingController::class, 'saveBookingInformation'])->name('booking.information.save');

Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/city/{slug}', [CityController::class, 'show'])->name('city.show');
