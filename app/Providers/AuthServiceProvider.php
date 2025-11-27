<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Definir permisos por roles
        Gate::define('super-admin', function (User $user) {
            return $user->type == 1;
        });

        Gate::define('admin', function (User $user) {
            return $user->type == 2;
        });

        Gate::define('staff', function (User $user) {
            return $user->type == 3;
        });
    }
}




