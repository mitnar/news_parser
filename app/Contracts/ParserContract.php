<?php

namespace App\Contracts;

interface ParserContract
{
    public function parse(string $url);
}