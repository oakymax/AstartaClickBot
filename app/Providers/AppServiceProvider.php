<?php

namespace App\Providers;

use App\Contracts\IUserRepository;
use App\Models\UserRepository;
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
        $this->app->bind(IUserRepository::class, fn () => new UserRepository());
    }
}
