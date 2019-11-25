<?php

namespace Saundefined\LaravelSMS\Services;

use Illuminate\Support\Collection;

class SenderCollection extends Collection
{
    public function getValidCollection()
    {
        return $this->filter(function ($item) {
            /** @var $item Sender */
            return $item->isValid();
        });
    }
}
