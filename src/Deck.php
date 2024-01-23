<?php

namespace Puzzles;

use Puzzles\Cards\{Hearts,Diamonds,Clubs,Spades};

class Deck implements \ArrayAccess {
    /**
     * @var array<int, Hearts|Diamonds|Clubs|Spades>
     */
    private array $cards = [];

    public function shuffle() {
        shuffle($this->cards);
    }

    public function getCards(): array {
        return $this->cards;
    }

    public function offsetSet($offset, $value): void {

        if (!($value instanceof Hearts)
            && !($value instanceof Diamonds)
            && !($value instanceof Clubs)
            && !($value instanceof Spades)
        ) {
            throw new \InvalidArgumentException('Invalid suit');
        }

        if (is_null($offset)) {
            $this->cards[] = $value;
        } else {
            $this->cards[$offset] = $value;
        }
    }

    public function offsetExists($offset): bool {
        return isset($this->cards[$offset]);
    }

    public function offsetUnset($offset): void {
        unset($this->cards[$offset]);
    }

    public function offsetGet($offset): mixed {
        return $this->carts[$offset] ?? null;
    }
}
