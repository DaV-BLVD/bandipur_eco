<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ContactInfo;
use Illuminate\Support\Facades\View;

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
        View::composer('*', function ($view) {
            $view->with('footerContactInfo', ContactInfo::where('is_active', true)->orderBy('id', 'asc')->get());
        });
    }
}
