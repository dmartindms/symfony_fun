<?php declare(strict_types=1);

namespace App\Contracts;

interface NumberGeneratorInterface
{
    public function randomInt(): int;
}