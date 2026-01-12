<?php

use App\Http\Controllers\Frontend\AccommodationController;
use App\Http\Controllers\Frontend\BookingModelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\ReserveSubmissionController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\TareController;
use App\Http\Controllers\Frontend\AboutController;
use Illuminate\Support\Facades\Route;

Route::get('welcome', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('frontend.pages.home');
});
Route::view('/about', 'frontend.pages.about')->name('about');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/accommodation', [AccommodationController::class, 'index'])->name('accommodation');
Route::get('/tare', [TareController::class, 'index'])->name('tare');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::post('/reserve-submit', [ReserveSubmissionController::class, 'store'])->name('booking.submit');

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

        Route::resource('/admin/dashboard/map-location', App\Http\Controllers\Admin\MapLocationController::class);

        Route::resource('/admin/dashboard/faqs', App\Http\Controllers\Admin\FaqController::class);

        Route::resource('/admin/dashboard/reserve-submissions', App\Http\Controllers\Admin\ReserveSubmissionController::class)->only(['index', 'show', 'destroy']);
        Route::patch('/admin/dashboard/reserve-submissions/{reserveSubmission}/read', [App\Http\Controllers\Admin\ReserveSubmissionController::class, 'markAsRead'])->name('reserve-submissions.read');
        Route::patch('/admin/dashboard/reserve-submissions/{reserveSubmission}/unread', [App\Http\Controllers\Admin\ReserveSubmissionController::class, 'markAsUnread'])->name('reserve-submissions.unread');

        Route::resource('/admin/dashboard/gallery-hero', App\Http\Controllers\Admin\GalleryHeroController::class);

        Route::resource('/admin/dashboard/gallery-headers', App\Http\Controllers\Admin\GalleryHeaderController::class);

        Route::resource('/admin/dashboard/gallery-contents', App\Http\Controllers\Admin\GalleryContentController::class);

        Route::resource('/admin/dashboard/rate-header', App\Http\Controllers\Admin\RateHeaderController::class);

        Route::resource('/admin/dashboard/room-rates', App\Http\Controllers\Admin\RoomRateController::class);

        Route::resource('/admin/dashboard/rates-hero', \App\Http\Controllers\Admin\RatesHeroController::class);

        Route::resource('/admin/dashboard/rates-table', \App\Http\Controllers\Admin\RatesTableController::class);

        Route::resource('/admin/dashboard/exclusive-special-offer', \App\Http\Controllers\Admin\ExclusiveSpecialOfferController::class);

        Route::resource('/admin/dashboard/important-infos', \App\Http\Controllers\Admin\ImportantInfoController::class);

        Route::resource('/admin/dashboard/accommodation-hero', \App\Http\Controllers\Admin\AccommodationHeroController::class);

        Route::resource('/admin/dashboard/accommodation-header', \App\Http\Controllers\Admin\AccommodationHeaderController::class);

        Route::resource('/admin/dashboard/rooms', \App\Http\Controllers\Admin\RoomController::class);

        Route::resource('/admin/dashboard/accommodation-highlight', \App\Http\Controllers\Admin\AccommodationHighlightController::class);

        Route::resource('/admin/dashboard/accommodation-highlight-pic', \App\Http\Controllers\Admin\AccommodationHighlightPicController::class);

        Route::resource('/admin/dashboard/about-hero', \App\Http\Controllers\Admin\AboutHeroController::class);

        Route::resource('/admin/dashboard/about-header', \App\Http\Controllers\Admin\AboutHeaderController::class);

        Route::resource('/admin/dashboard/who-we-are-photos', \App\Http\Controllers\Admin\WhoWeArePhotoController::class);
    });
});

require __DIR__ . '/auth.php';
