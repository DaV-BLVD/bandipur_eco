<?php

use App\Http\Controllers\Frontend\BookingModelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('welcome', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('frontend.pages.home');
});
Route::view('/about', 'frontend.pages.about')->name('about');
Route::view('/accommodation', 'frontend.pages.accommodation')->name('accommodation');
Route::view('/tare', 'frontend.pages.tare')->name('tare');
Route::view('/gallery', 'frontend.pages.gallery')->name('gallery');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::post('/book-now', [BookingModelController::class, 'store'])->name('booking.submit');

// admin

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\ContactHeroController;
use App\Http\Controllers\Admin\ContactHeaderController;
use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\ContactSubmissionController;

Route::middleware(['auth'])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Dashboard (Admin + Super Admin)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['admin_role'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    });

    /*
    |--------------------------------------------------------------------------
    | Profile (Admin + Super Admin)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['admin_role'])->group(function () {
        Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('profile.update');
    });

    /*
    |--------------------------------------------------------------------------
    | Super Admin Only — Manage Admins/Super Admins
    |--------------------------------------------------------------------------
    */
    Route::middleware(['super_admin'])->group(function () {
        Route::resource('/admin/dashboard/users', AdminUsersController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | Admin + Super Admin — Shared Dashboard Resources
    |--------------------------------------------------------------------------
    */
    Route::middleware(['admin_role'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::resource('/admin/dashboard/contact-hero', ContactHeroController::class);

        Route::resource('/admin/dashboard/contact-header', ContactHeaderController::class);

        Route::resource('/admin/dashboard/contact-info', ContactInfoController::class);

        Route::resource('/admin/dashboard/social-links', SocialLinkController::class);

        Route::resource('/admin/dashboard/contact-submissions', ContactSubmissionController::class)->only(['index', 'show', 'destroy']);

        Route::patch('/admin/dashboard/contact-submissions/{contactSubmission}/read', [ContactSubmissionController::class, 'markAsRead'])->name('contact-submissions.read');

        Route::patch('/admin/dashboard/contact-submissions/{contactSubmission}/unread', [ContactSubmissionController::class, 'markAsUnread'])->name('contact-submissions.unread');
    });
});

require __DIR__ . '/auth.php';
