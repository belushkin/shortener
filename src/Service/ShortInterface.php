<?php

namespace App\Service;

interface ShortInterface {

    /**
     * Takes input, it can be URL or id or something else and short it
     *
     * @param string|int $input
     * @return string
     */
    public function short($input):string;

    /**
     * Takes input short URL and return complete URL or id or else
     *
     * @param string $input
     * @return string|int
     */
    public function unshort(string $input);
}
