<?php

namespace App\Repositories\Permission;

use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }
    public function register()
    {
        $this->app->bind('App\Repositories\Permission\PermissionInterface', 'App\Repositories\Permission\PermissionRepository');
    }
}
