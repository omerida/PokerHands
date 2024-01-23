<?php

use Puzzles\Cards\{Hearts, Diamonds, Clubs, Spades};
use Puzzles\Hand;
use Puzzles\HandAnalyzer;

use PHPUnit\Framework\TestCase;

class TwoPairTest extends TestCase
{
    public function testHandIsFlush()
    {
        $hand = new \Puzzles\Hand(
            new Hearts('K'),
            new Clubs('K'),
            new Diamonds('J'),
            new Clubs('J'),
            new Hearts(7),
        );

        $judge = new HandAnalyzer($hand);

        $this->assertTrue($judge->hasAtLeastTwoPair());
    }

    public function testHandIsNotFlush()
    {
        $hand = new Hand(
            new Hearts('K'),
            new Clubs('K'),
            new Diamonds(8),
            new Spades(7),
            new Hearts(3),
        );

        $judge = new HandAnalyzer($hand);

        $this->assertFalse($judge->hasAtLeastTwoPair());
    }
}