<?php

namespace Puzzles;

class HandAnalyzer
{
    private array $freqs = [];
    private array $suits = [];
    private array $sorted = [];
    private array $faceSeq = [10, 'J', 'Q', 'K', 'A'];

    public function __construct(
        private readonly Hand $hand
    ) {
        $this->analyze();
    }

    private function analyze(): void
    {
        $this->countFrequency();
        $this->countSuits();
        $this->sortValues();
    }

    private function countFrequency(): void
    {
        foreach($this->hand->getCards() as $card) {
            if (isset($this->freqs[$card->value])) {
                $this->freqs[$card->value]++;
            } else {
                $this->freqs[$card->value] = 1;
            }
        }
    }

    private function countSuits(): void
    {
        foreach($this->hand->getCards() as $card) {
            if (isset($this->suits[$card->suit])) {
                $this->suits[$card->suit]++;
            } else {
                $this->suits[$card->suit] = 1;
            }
        }
    }

    private function sortValues(): void {
        $vals = array_map(
            fn($card) => $card->value,
            $this->hand->getCards()
        );

        usort($vals, function($a, $b) {
            if ($a == $b) {
                return 0;
            }
            if (is_numeric($a) && is_numeric($b)) {
                return $a <=> $b;
            }
            if (is_numeric($a) && ctype_alpha($b)) {
                return -1; // face cards are higher
            }
            if (is_numeric($b) && ctype_alpha($a)) {
                return 1; // face cards are higher
            }

            $aKey = array_keys($this->faceSeq, $a)[0];
            $bKey = array_keys($this->faceSeq, $b)[0];

            return $aKey <=> $bKey;
        });

        $this->sorted = $vals;
    }

    public function getHighest(): string|int
    {
        $key = array_key_last($this->sorted);
        return $this->sorted[$key];
    }

    public function getFourOfAKinds(): array
    {
        return array_keys($this->freqs, 4, true);
    }

    public function getTriples(): array
    {
        // should a four-of-kind count as a triple?
        return array_keys($this->freqs, 3, true);
    }

    public function getPairs(): array
    {
        // again, should a three or four of the same, also be a pair?
        return array_keys($this->freqs, 2, true);
    }

    public function isAllSingles(): bool
    {
        return 1 === max($this->freqs);
    }

    public function isOneSuit()
    {
        return 1 === count($this->suits);
    }

    public function isSequential() {
        $isSequential = true; // assume
        $pos = 0;
        $last = array_key_last($this->sorted);
        while ($isSequential && $pos < $last) {
            $current = $this->sorted[$pos++];
            $next = $this->sorted[$pos];

            if ($next === null) {
                // at last card
                break;
            }

            if ($current < 10 && $current + 1 === $next) {
                $isSequential = true;
                continue;
            }

            if ($current < 10 && $current + 1 !== $next) {
                $isSequential = false;
                break; // done
            }
            // sequence after 9 card
            $nextKey = array_keys($this->faceSeq, $current)[0];
            $nextExpected = $this->faceSeq[$nextKey + 1];

            if ($next === $nextExpected) {
                $isSequential = true;
                continue;
            }

            $isSequential = false;
        }
        return $isSequential;
    }

    public function isFullHouse(): bool
    {
        $myTriples = $this->getTriples();
        $myPairs = $this->getPairs();
        return count($myTriples) > 0 && count($myPairs) > 0;
    }

    public function hasTriple(): bool
    {
        $myTriples = $this->getTriples();
        return count($myTriples) > 0;
    }

    public function hasFourOfAKind(): bool
    {
        $myFours = $this->getFourOfAKinds();
        return count($myFours) > 0;
    }

    public function hasAtLeastTwoPair(): bool
    {
        $myPairs = $this->getPairs();
        return count($myPairs) > 1;
    }

    public function hasExactlyOnePair(): bool
    {
        $myPairs = $this->getPairs();
        return count($myPairs) === 1;
    }

    public function isARoyalFlush() {
        return $this->isSequential() && $this->isOneSuit()
            && $this->getHighest() === 'A';
    }

    public function isAStraightFlush() {
        return $this->isSequential() && $this->isOneSuit()
            && $this->getHighest() !== 'A';
    }

    public function isAStraight() {
        return $this->isSequential() && !$this->isOneSuit();
    }

    public function isAFlush() {
        return !$this->isSequential() && $this->isOneSuit();
    }

    public function isHighCard() {
        return !$this->isOneSuit()
            && !$this->isSequential()
            && $this->isAllSingles();
    }
}