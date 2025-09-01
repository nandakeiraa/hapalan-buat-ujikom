<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define HOME constant default.
     */
    public const HOME = '/home';

    /**
     * Bootstrapping services.
     */
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        });
    }

    /**
     * Tentukan redirect berdasarkan role user.
     */
    public static function redirectToBasedOnRole(): string
    {
        $user = auth()->user();
        if (!$user) {
            return '/login';
        }

        return match ($user->role) {
            'admin' => '/admin',
            'petugas' => '/petugas',
            'pengguna' => '/divisi',
            default => '/home',
        };
    }
}
