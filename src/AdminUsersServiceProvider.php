<?php

namespace LaraMod\Admin\Users;

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
        $this->loadViewsFrom(__DIR__ . '/views', 'adminusers');
        $this->publishes([
            __DIR__ . '/views' => base_path('resources/views/laramod/admin/users'),
        ]);

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__ . '/routes.php';
    }
}
