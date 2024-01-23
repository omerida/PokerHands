<?php

use Puzzles\Cards\{Hearts, Diamonds, Clubs, Spades};
use Puzzles\Hand;
use Puzzles\HandAnalyzer;

use PHPUnit\Framework\TestCase;

class StraightTest extends TestCase
{
    public function testHandIsStraight()
    {
        $hand = new \Puzzles\Hand(
            new Hearts('Q'),
            new Clubs('J'),
            new Diamonds(8),
            new Clubs(9),
            new Hearts(10),
        );

        $judge = new HandAnalyzer($hand);

        $this->assertTrue($judge->isAStraight());
    }

    public function testHandIsNotStraightFlush()
    {
        $hand = new Hand(
            new Hearts('K'),
            new Clubs('K'),
            new Diamonds(8),
            new Spades(7),
            new Hearts(3),
        );

        $judge = new HandAnalyzer($hand);

        $this->assertFalse($judge->isAStraight());
    }
}