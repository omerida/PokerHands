<?php

use Puzzles\Cards\{Hearts, Diamonds, Clubs, Spades};
use Puzzles\Hand;
use Puzzles\HandAnalyzer;

use PHPUnit\Framework\TestCase;

class FlushTest extends TestCase
{
    public function testHandIsFlush()
    {
        $hand = new \Puzzles\Hand(
            new Hearts('Q'),
            new Hearts('A'),
            new Hearts(4),
            new Hearts(8),
            new Hearts(2),
        );

        $judge = new HandAnalyzer($hand);

        $this->assertTrue($judge->isAFlush());
    }

    public function testHandIsNotStraightFlush()
    {
        $hand = new Hand(
            new Hearts('K'),
            new Clubs('Q'),
            new Diamonds('J'),
            new Spades(10),
            new Hearts(9),
        );

        $judge = new HandAnalyzer($hand);

        $this->assertFalse($judge->isAFlush());
    }
}