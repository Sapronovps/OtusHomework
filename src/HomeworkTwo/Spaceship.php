<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkTwo;

final class Spaceship
{
    public function __construct(
        public Vector $position,
        public Vector $velocity,
        public ?float $direction = null,
        public ?float $angularVelocity = null,
        public ?float $directionsNumber = null
    )
    {
    }
}