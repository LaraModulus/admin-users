<?php

namespace Escapeboy\AdminUsers;

use Illuminate\Support\ServiceProvider;

class AdminUsersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'adminusers');
        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/escapeboy/admin-users'),
        ]);
//        $this->publishes([
//            __DIR__.'/assets' => public_path('assets/escapeboy/dashboard'),
//        ], 'public');
//        $this->publishes([
//            __DIR__.'/../config/adminusers.php' => config_path('adminusers.php')
//        ], 'config');


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/routes.php';
//        $this->mergeConfigFrom(
//            __DIR__.'/../config/admincore.php', 'admincore'
//        );

//        $this->app->make('Escapeboy\AdminUsers\AdminUsersController');
    }
}
