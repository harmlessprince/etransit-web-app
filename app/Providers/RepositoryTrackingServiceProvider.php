<?php

namespace App\Providers;

use App\Interfaces\TrackingInterface;
use App\Repositories\TrackingRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryTrackingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TrackingInterface::class, TrackingRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
