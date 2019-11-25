<?php

namespace Saundefined\LaravelSMS\Contracts;

interface Provider
{
    public function send($phone, $text, $sender);
}
