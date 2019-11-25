<?php

namespace Saundefined\LaravelSMS\Providers;

use Saundefined\LaravelSMS\Contracts\Provider;
use Saundefined\LaravelSMS\Contracts\Provider\HasBalance;
use Saundefined\LaravelSMS\Contracts\Provider\HasSender;

class Sms4bProvider implements Provider, HasBalance, HasSender
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

    public function getSenderList()
    {
        // TODO: Implement getSenderList() method.
    }
}
