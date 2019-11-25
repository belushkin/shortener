<?php

namespace App\Tests\Service;

use App\Service\Shortener;
use App\Service\ShortEngine\IdToUrl;
use PHPUnit\Framework\TestCase;

class ShortenerTest extends TestCase
{
    public function testShorteningFunctionShort()
    {
        $shortener = new Shortener(new IdToUrl());
        $this->assertEquals('dnh', $shortener->short(12345));
    }

    public function testShorteningFunctionUnShort()
    {
        $shortener = new Shortener(new IdToUrl());
        $this->assertEquals(12345, $shortener->unshort('dnh'));
    }

}
