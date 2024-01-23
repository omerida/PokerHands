<?php

namespace Puzzles\Cards;

class Hearts extends Card
{
    public function __construct(string|int $value) {
        parent::__construct('♡', $value);
    }
}
