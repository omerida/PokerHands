<?php

use Puzzles\Cards\{Hearts, Diamonds, Clubs, Spades};
use Puzzles\Hand;
use Puzzles\HandAnalyzer;

use PHPUnit\Framework\TestCase;

class HighCardTest extends TestCase
{
    public function testHandIsHighCard()
    {
        $hand = new \Puzzles\Hand(
            new Hearts('Q'),
            new Diamonds('A'),
            new Clubs(4),
            new Clubs(5),
            new Hearts(2),
        );

        $judge = new HandAnalyzer($hand);

        $this->assertTrue($judge->isHighCard());
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

        $this->assertFalse($judge->isHighCard());
    }
}