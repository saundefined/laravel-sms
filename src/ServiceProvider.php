<?php

namespace Saundefined\LaravelSMS;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Saundefined\LaravelSMS\Contracts\Factory;

class ServiceProvider extends IlluminateServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(Factory::class, function ($app) {
            return new Manager($app);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Factory::class];
    }
}
