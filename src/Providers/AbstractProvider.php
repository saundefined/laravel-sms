<?php

namespace Saundefined\LaravelSMS\Providers;

use GuzzleHttp\Client;
use Saundefined\LaravelSMS\Contracts\Provider;

abstract class AbstractProvider implements Provider
{
    /** @var Client $httpClient */
    protected $httpClient;

    abstract public function send($phone, $text, $sender);

    protected function getHttpClient()
    {
        if ($this->httpClient === null) {
            $this->httpClient = new Client();
        }

        return $this->httpClient;
    }
}
