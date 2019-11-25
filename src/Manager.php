<?php

namespace Saundefined\LaravelSMS;

use Illuminate\Support\Manager as IlluminateManager;
use InvalidArgumentException;
use Saundefined\LaravelSMS\Providers\IntisProvider;

class Manager extends IlluminateManager implements Contracts\Factory
{
    public function with($driver)
    {
        return $this->driver($driver);
    }

    public function getDefaultDriver()
    {
        throw new InvalidArgumentException('No Socialite driver was specified.');
    }

    protected function createIntisDriver()
    {
        $config = $this->app['config']['services.intis'];
        return $this->buildProvider(
            IntisProvider::class, $config
        );
    }

    public function buildProvider($provider, $config)
    {
        return new $provider($config);
    }
}
