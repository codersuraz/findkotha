<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

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
        $locale = request()->query('locale', session('locale', config('app.fallback_locale')));
        if (in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
            session(['locale' => $locale]);
        }

        // add the locale to the url query string
        URL::defaults(['locale' => $locale]); // this is for the route segments
        

        Vite::prefetch(concurrency: 3);
    }
}
