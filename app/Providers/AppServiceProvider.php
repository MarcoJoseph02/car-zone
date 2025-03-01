<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Car;
use App\Observers\CarObserver;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Car::observe(CarObserver::class);
    }
}
