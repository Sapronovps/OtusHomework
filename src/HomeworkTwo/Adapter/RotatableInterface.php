<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkTwo\Adapter;

interface RotatableInterface
{
    public function getDirection(): int;

    public function setDirection(float $direction): void;

    public function getAngularVelocity(): int;

    public function getDirectionsNumber(): int;
}