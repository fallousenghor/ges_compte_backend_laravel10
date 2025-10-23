<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\CompteRepositoryInterface;
use App\Repositories\CompteRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind repository interfaces to their implementations
        $this->app->bind(CompteRepositoryInterface::class, CompteRepository::class);

        // If UserRepositoryInterface/UserRepository exist, bind them too (safe check)
        if (interface_exists(UserRepositoryInterface::class) && class_exists(UserRepository::class)) {
            $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
        }
    }
