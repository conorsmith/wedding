<?php

namespace ConorSmith\Wedding\Providers;

use ConorSmith\Wedding\SiteMode;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SiteMode::class, function ($app) {
            return new SiteMode(getenv('SITE_MODE'));
        });
    }
}
