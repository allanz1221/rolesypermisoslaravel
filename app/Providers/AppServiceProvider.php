<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Request;
use App\Observers\RegistroObserver;

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
        //
        Request::observe(RegistroObserver::class);
    }
}
