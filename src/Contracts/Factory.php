<?php

namespace Saundefined\LaravelSMS\Contracts;

interface Factory
{
    public function driver($driver = null);
}
