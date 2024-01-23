<?php

use Puzzles\Cards\Hearts;
use Puzzles\Cards\Diamonds;
use Puzzles\Cards\Clubs;
use Puzzles\Cards\Spades;
use Puzzles\Hand;
use Puzzles\HandAnalyzer;

use PHPUnit\Framework\TestCase;

class FullHouseTest extends TestCase
{
    public function testHandIsFlush()
    {
        $hand = new \Puzzles\Hand(
            new Hearts('K'),
            new Clubs('K'),
            new Diamonds('K'),
            new Clubs(3),
            new Hearts(3),
        );

        $judge = new HandAnalyzer($hand);

        $this->assertTrue($judge->isFullHouse());
    }

    public function testHandIsNotFlush()
    {
        $hand = new Hand(
            new Hearts('K'),
            new Clubs('K'),
            new Diamonds('K'),
            new Spades(7),
            new Hearts(3),
        );

        $judge = new HandAnalyzer($hand);

        $this->assertFalse($judge->isFullHouse());
    }
}