<?php

namespace Arneon\LaravelOrders\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Arneon\LaravelOrders\Domain\Repositories\Repository;
use Arneon\LaravelOrders\Infrastructure\Persistence\Eloquent\EloquentRepository;

class PackageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Repository::class, EloquentRepository::class);
    }
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../Routes/Api.php');

        $this->loadViewsFrom(__DIR__ . '/../Views', 'arneon/laravel-orders');
        $this->publishes([
            __DIR__ . '/../Views' => resource_path('views/vendor/arneon/laravel-orders'),
        ], 'views');
    }
}
