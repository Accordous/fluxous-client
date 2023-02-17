<?php

namespace Accordous\FluxousClient\Providers;

use Accordous\FluxousClient\Services\FluxousService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class FluxousClientServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Relative path to the root
     */
    const ROOT_PATH = __DIR__ . '/../..';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            self::ROOT_PATH . '/config/fluxous.php' => config_path('fluxous.php'),
        ], 'Fluxous');
    }

    /**
     * Register the package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            self::ROOT_PATH . '/config/fluxous.php', 'fluxous'
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            FluxousService::class
        ];
    }
}
