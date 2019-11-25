<?php

namespace Saundefined\LaravelSMS\Test\Stubs;

use GuzzleHttp\Client;
use Mockery as m;
use Mockery\MockInterface;
use Saundefined\LaravelSMS\Providers\IntisProvider;
use stdClass;

class IntisProviderStub extends IntisProvider
{
    /**
     * @var Client|MockInterface
     */
    public $http;

    public function getHttpClient()
    {
        if ($this->http) {
            return $this->http;
        }

        return $this->http = m::mock(stdClass::class);
    }
}
