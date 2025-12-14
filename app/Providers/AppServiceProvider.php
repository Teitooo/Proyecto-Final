<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        Paginator::useBootstrap();

        // Gates para Inventario - permitir acceso a admin y bodeguero
        Gate::define('inventario-list', function (User $user) {
            return true; // Permitir a todos por ahora
        });

        Gate::define('inventario-create', function (User $user) {
            return true; // Permitir a todos por ahora
        });

        Gate::define('inventario-edit', function (User $user) {
            return true; // Permitir a todos por ahora
        });

        Gate::define('inventario-delete', function (User $user) {
            return $user->hasRole('Admin');
        });
    }
}
