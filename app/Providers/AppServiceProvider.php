<?php

namespace ConorSmith\Wedding\Providers;

use ConorSmith\Wedding\Domain\GuestRepository;
use ConorSmith\Wedding\Domain\InviteRepository;
use ConorSmith\Wedding\Infrastructure\GuestRepositoryEloquent;
use ConorSmith\Wedding\Infrastructure\InviteRepositoryEloquent;
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

        $this->app->bind(GuestRepository::class, GuestRepositoryEloquent::class);
        $this->app->bind(InviteRepository::class, InviteRepositoryEloquent::class);
    }
}
