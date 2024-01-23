<?php

namespace Puzzles\Cards;

class Spades extends Card
{
    public function __construct(string|int $value) {
        parent::__construct('♠', $value);
    }
}
