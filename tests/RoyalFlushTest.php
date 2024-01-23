<?php

use Puzzles\Cards\{Hearts, Diamonds, Clubs, Spades};
use Puzzles\Hand;
use Puzzles\HandAnalyzer;

use PHPUnit\Framework\TestCase;

class RoyalFlushTest extends TestCase
{
    public function testHandIsRoyalFlush()
    {
        $hand = new \Puzzles\Hand(
            new Clubs('A'),
            new Clubs('K'),
            new Clubs('Q'),
            new Clubs('J'),
            new Clubs(10),
        );

        $judge = new HandAnalyzer($hand);
        $this->assertTrue($judge->isARoyalFlush());
    }

    public function testHandIsNotRoyalFlush()
    {
        $hand = new \Puzzles\Hand(
            new Clubs('Q'),
            new Clubs('J'),
            new Clubs(8),
            new Clubs(9),
            new Clubs(10),
        );
        $judge = new HandAnalyzer($hand);

        $this->assertFalse($judge->isARoyalFlush());
    }

    public function testHandIsNotRoyalFlushSuits()
    {
        $hand = new \Puzzles\Hand(
            new Clubs('Q'),
            new Clubs('J'),
            new Hearts(8),
            new Clubs(9),
            new Clubs(10),
        );

        $judge = new HandAnalyzer($hand);

        $this->assertFalse($judge->isARoyalFlush());
    }
}