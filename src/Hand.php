<?php

namespace Puzzles;

use Puzzles\Cards\Card;

class Hand
{
    private array $cards;

    public function __construct(Card ...$cards)
    {
        $this->cards = $cards;
    }

    /**
     * @return Card[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }
}