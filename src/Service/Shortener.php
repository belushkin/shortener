<?php

namespace App\Service;

use App\Service\ShortInterface;

class Shortener implements ShortInterface
{

    /**
     * @var ShortInterface
     */
    private $engine;

    /**
     * @param ShortInterface $engine
     */
    public function __construct(ShortInterface $engine)
    {
        $this->engine = $engine;
    }

    /**
     * Takes input, it can be URL or id or something else and short it
     *
     * @param string|int $input
     * @return string
     */
    public function short($input):string
    {
        return $this->engine->short($input);
    }

    /**
     * Takes input short URL and return URL or id or else
     *
     * @param string $input
     * @return string|int
     */
    public function unshort(string $input)
    {
        return $this->engine->unshort($input);
    }

}
