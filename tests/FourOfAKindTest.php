<?php

use Puzzles\Cards\{Hearts, Diamonds, Clubs, Spades};
use Puzzles\Hand;
use Puzzles\HandAnalyzer;

use PHPUnit\Framework\TestCase;

class FourOfAKindTest extends TestCase
{
    public function testHandIsFlush()
    {
        $hand = new \Puzzles\Hand(
            new Hearts('K'),
            new Clubs('K'),
            new Diamonds('K'),
            new Clubs('K'),
            new Hearts(3),
        );

        $judge = new HandAnalyzer($hand);

        $this->assertTrue($judge->hasFourOfAKind());
    }

    public function testHandIsNotFlush()
    {
        $hand = new Hand(
            new Hearts('A'),
            new Clubs('J'),
            new Diamonds(8),
            new Spades(5),
            new Hearts(2),
        );

        $judge = new HandAnalyzer($hand);

        $this->assertFalse($judge->hasFourOfAKind());
    }
}