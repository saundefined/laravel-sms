<?php

namespace Saundefined\LaravelSMS\Services;

class Sender
{
    protected $name;

    protected $isValid;

    public function __construct($name, $isValid = true)
    {
        $this->name = $name;
        $this->isValid = $isValid;
    }

    public function getName()
    {
        return $this->name;
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }
}
