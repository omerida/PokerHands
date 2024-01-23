<?php

use Puzzles\Cards\{Hearts, Diamonds, Clubs, Spades};
use Puzzles\Hand;
use Puzzles\HandAnalyzer;

use PHPUnit\Framework\TestCase;

class TripleTest extends TestCase
{
    public function testHandHasTriple()
    {
        $hand = new \Puzzles\Hand(
            new Hearts('K'),
            new Clubs('K'),
            new Diamonds('K'),
            new Clubs(3),
            new Spades(5),
        );

        $judge = new HandAnalyzer($hand);

        $this->assertTrue($judge->hasTriple());
    }

    public function testHandHasNoTriple()
    {
        $hand = new Hand(
            new Hearts('K'),
            new Clubs('K'),
            new Diamonds(10),
            new Spades(7),
            new Hearts(3),
        );

        $judge = new HandAnalyzer($hand);

        $this->assertFalse($judge->hasTriple());
    }
}