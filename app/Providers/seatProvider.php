<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\SeatRepository;
use App\Repositories\Contracts\SeatRepositorieInterface;

class seatProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SeatRepositorieInterface::class,SeatRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
