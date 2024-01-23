<?php

namespace Puzzles\Cards;

class Diamonds extends Card
{
    public function __construct(string|int $value) {
        parent::__construct('♢', $value);
    }
}
