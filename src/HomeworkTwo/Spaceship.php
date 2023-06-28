<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkTwo;

/**
 * Космический корабль.
 */
final class Spaceship
{
    public function __construct(
        public ?Vector $position = null,
        public ?Vector $velocity = null,
        public ?float $direction = null,
        public ?float $angularVelocity = null,
        public ?float $directionsNumber = null
    )
    {
    }
}