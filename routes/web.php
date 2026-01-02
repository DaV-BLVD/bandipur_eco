<?php

use App\Http\Controllers\Frontend\BookingModelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('frontend.pages.home');
});
Route::view('/about', 'frontend.pages.about')->name('about');
Route::view('/accommodation', 'frontend.pages.accommodation')->name('accommodation');
Route::view('/tare', 'frontend.pages.tare')->name('tare');
Route::view('/gallery', 'frontend.pages.gallery')->name('gallery');
Route::view('/contact', 'frontend.pages.contact')->name('contact');

Route::post('/book-now', [BookingModelController::class, 'store'])->name('booking.submit');
