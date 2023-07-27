<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        // ============================================== BACKEND ==============================================
        Route::group(['prefix' => 'admin'], function () {
            $this->bookRoute();
            Route::group(['prefix' => 'user-management'], function () {
                $this->userRoute();
                $this->roleRoute();
                $this->permissionsRoute();
            });
            Route::group(['prefix' => 'setting'], function () {
                $this->appSettingRoute();
            });
        });
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    // ============================================== BACKEND ==============================================
    protected function userRoute()
    {
        Route::middleware(['web', 'auth', 'verify-user'])
            ->namespace($this->namespace)
            ->group(base_path('routes/userRoute.php'));
    }
    protected function roleRoute()
    {
        Route::middleware(['web', 'auth', 'verify-user'])
            ->namespace($this->namespace)
            ->group(base_path('routes/roleRoute.php'));
    }
    protected function permissionsRoute()
    {
        Route::middleware(['web', 'auth', 'verify-user'])
            ->namespace($this->namespace)
            ->group(base_path('routes/permissionsRoute.php'));
    }
    protected function appSettingRoute()
    {
        Route::prefix('app')
            ->middleware(['web', 'auth', 'verify-user', 'role:developer|superadmin'])
            ->namespace($this->namespace)
            ->group(base_path('routes/appSettingRoute.php'));
    }
    protected function bookRoute()
    {
        Route::middleware(['web', 'auth', 'verify-user'])
            ->prefix('books')
            ->namespace($this->namespace)
            ->group(base_path('routes/bookRoute.php'));
    }
}
