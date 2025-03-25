<?php

namespace App\Providers;

use App\Repositories\Contracts\SalleRepositorieInterface;
use App\Repositories\SalleRepository;
use Illuminate\Support\ServiceProvider;

class SalleProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SalleRepositorieInterface::class,SalleRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
