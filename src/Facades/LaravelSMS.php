<?php

namespace Saundefined\LaravelSMS\Facades;

use Illuminate\Support\Facades\Facade;
use Saundefined\LaravelSMS\Contracts\Factory;

class LaravelSMS extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Factory::class;
    }
}
