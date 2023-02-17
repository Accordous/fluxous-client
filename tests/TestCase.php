<?php

namespace Accordous\FluxousClient\Tests;

use Accordous\FluxousClient\Providers\FluxousClientServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * add the package provider
     *
     * @param  Application $app
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            FluxousClientServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app): void
    {
        $app->useEnvironmentPath(__DIR__.'/..');
        $app->bootstrapWith([LoadEnvironmentVariables::class]);

        $app['config']->set('fluxous.host', 'https://api.fluxous.com.br');
        $app['config']->set('fluxous.api', '/v1');
    }
}
