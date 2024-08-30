<?php

namespace Arneon\LaravelPaypalCheckout\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Arneon\LaravelPaypalCheckout\Domain\Repositories\Repository;
use Arneon\LaravelPaypalCheckout\Infrastructure\Persistence\Eloquent\EloquentRepository;

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

        $this->publishes([
            __DIR__ . '/../../../config/laravel-paypal-checkout-config.php' => config_path('paypal-checkout-config.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__ . '/../../../config/laravel-paypal-checkout-config.php', 'paypal-checkout-config'
        );
    }
}
