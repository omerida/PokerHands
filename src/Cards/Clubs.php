<?php

namespace Puzzles\Cards;

class Clubs extends Card
{
    public function __construct(string|int $value) {
        parent::__construct('♣', $value);
    }
}
