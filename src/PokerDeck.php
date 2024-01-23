<?php

namespace Puzzles;

use Puzzles\Cards;

class PokerDeck extends Deck {

    public function __construct() {
        $suits = [
            Cards\Hearts::class,
            Cards\Diamonds::class,
            Cards\Clubs::class,
            Cards\Spades::class
        ];

        foreach ($suits as $suit) {
            foreach (Cards\Card::allowedValues() as $value) {
                $this[] = new $suit($value); // Array A
            }
        }
    }
}
