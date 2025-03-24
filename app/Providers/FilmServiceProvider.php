<?php

namespace App\Providers;

use App\Repositories\Contracts\FilmRepositorieInterface;
use App\Repositories\FilmRepository;
use Illuminate\Support\ServiceProvider;

class FilmServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(FilmRepositorieInterface::class, FilmRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
