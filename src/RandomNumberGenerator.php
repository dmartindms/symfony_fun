<?php

namespace App;

use App\Contracts\NumberGeneratorInterface;
use Exception;

class RandomNumberGenerator implements NumberGeneratorInterface
{
    public function __construct(private readonly int $start = 0, private readonly int $end = 100)
    {
    }

    /** @throws Exception */
    public function randomInt(): int
    {
        return random_int($this->start, $this->end);
    }
}