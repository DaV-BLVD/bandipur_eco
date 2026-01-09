<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ContactInfo;
use Illuminate\Support\Facades\View;
use App\Models\SocialLink;

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
    }
}
