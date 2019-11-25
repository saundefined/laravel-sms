<?php

namespace Saundefined\LaravelSMS\Providers;

use Saundefined\LaravelSMS\Contracts\Provider;
use Saundefined\LaravelSMS\Contracts\Provider\HasBalance;

class TurboSmsProvider implements Provider, HasBalance
{
    public function __construct()
    {

    }

    public function send($phone, $text, $sender)
    {
        // TODO: Implement send() method.
    }

    public function getBalance()
    {
        // TODO: Implement getBalance() method.
    }
}
