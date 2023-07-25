<?php

namespace App\Repositories\Role;

use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }
    public function register()
    {
        $this->app->bind('App\Repositories\Role\RoleInterface', 'App\Repositories\Role\RoleRepository');
    }
}
