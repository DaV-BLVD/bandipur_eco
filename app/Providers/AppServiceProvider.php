<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ContactInfo;
use Illuminate\Support\Facades\View;
use App\Models\SocialLink;
use App\Models\ContactSubmission;
use App\Models\MapLocation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Existing Contact Info composer
        View::composer('*', function ($view) {
            $view->with('footerContactInfo', ContactInfo::where('is_active', true)->orderBy('id', 'asc')->get());
        });

        // New Social Links composer
        View::composer('*', function ($view) {
            $view->with('footerSocialLinks', SocialLink::where('is_active', true)->orderBy('id', 'asc')->get());
        });

        View::composer('*', function ($view) {
            $contactUnreadCount = ContactSubmission::where('is_read', false)->count();
            $view->with('contactUnreadCount', $contactUnreadCount);
        });

        View::composer('*', function ($view) {
            $view->with('footerMap', MapLocation::where('is_active', true)->first());
        });
    }
}
