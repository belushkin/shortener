<?php

namespace App\Service\ShortEngine;

use App\Service\ShortInterface;


class IdToUrl implements ShortInterface
{
    /**
     * @var string
     */
    private $hash = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    /**
     * @var array
     */
    private $map = [];

    public function __construct()
    {
        $this->map = str_split($this->hash);
    }

    /**
     * Takes input, it can be URL or id or something else and short it
     *
     * @param string|int $input
     * @return string
     */
    public function short($input): string
    {
        return $this->idToCode($input);
    }

    /**
     * Takes input short URL and return URL or id or else
     *
     * @param string $input
     * @return string|int
     */
    public function unshort(string $input)
    {
        return $this->codeToId($input);
    }

    /**
     * Takes id and short it to string
     *
     * @param int $id
     * @return string
     */
    private function idToCode(int $id):string
    {
        $code = '';
        while ((int)$id) {
            $code .= $this->map[$id%62];
            $id = $id/62;
        }
        return strrev($code);
    }

    /**
     * Takes string and return id
     *
     * @param string $code
     * @return int
     */
    private function codeToId(string $code):int
    {
        $id = 0;
        for ($i = 0; $i < strlen($code); $i++) {
            if ('a' <= $code[$i] && $code[$i] <= 'z') {
                $id = $id*62 + $code[$i] - 'a';
            }
            if ('A' <= $code[$i] && $code[$i] <= 'Z') {
                $id = $id*62 + $code[$i] - 'A' + 26;
            }
            if ('0' <= $code[$i] && $code[$i] <= '9') {
                $id = $id*62 + $code[$i] - '0' + 52;
            }
        }
        return $id;
    }

}
