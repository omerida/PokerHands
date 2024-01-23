<?php

namespace Puzzles\Cards;

abstract class Card {
    public function __construct(
        readonly public string $suit,
        readonly string|int $value,
    ){
        if (!in_array($this->value, self::allowedValues())) {
            throw new \InvalidArgumentException('Invalid card value');
        }
    }

    public static function allowedValues(): array {
        return array_merge(
            range(2, 10), ['J', 'Q', 'K', 'A']
        );
    }

    public function __toString(): string {
        return $this->value . $this->suit;
    }
}