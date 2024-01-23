<?php

use Puzzles\Cards\{Hearts, Diamonds, Clubs, Spades};
use Puzzles\Hand;
use Puzzles\HandAnalyzer;

use PHPUnit\Framework\TestCase;

class SinglePairTest extends TestCase
{
    public function testHandIsFlush()
    {
        $hand = new \Puzzles\Hand(
            new Hearts('K'),
            new Clubs('K'),
            new Diamonds('J'),
            new Clubs(8),
            new Hearts(3),
        );

        $judge = new HandAnalyzer($hand);

        $this->assertTrue($judge->hasExactlyOnePair());
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

        $this->assertFalse($judge->hasExactlyOnePair());
    }
}