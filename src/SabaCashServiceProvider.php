<?php

namespace Alsharie\SabaCashPayment;

use Illuminate\Support\ServiceProvider;

class  SabaCashServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Config file
        $this->publishes([
            __DIR__ . '/../config/sabaCash.php' => config_path('sabaCash.php'),
        ]);

        // Merge config
        $this->mergeConfigFrom(__DIR__ . '/../config/sabaCash.php', 'SabaCash');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SabaCash::class, function () {
            return new SabaCash();
        });
    }
}