<?php

namespace App\Service;

use App\Service\ShortEngine\IdToUrl;

class InvokableShortenerFactory
{
    public function __invoke()
    {
        $shortener = new Shortener(new IdToUrl());
        return $shortener;
    }
}
