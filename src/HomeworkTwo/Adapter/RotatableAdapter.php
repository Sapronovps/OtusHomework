<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkTwo\Adapter;

/**
 * Адаптер для вращения объекта вокруг оси.
 */
final class RotatableAdapter implements RotatableInterface
{
    private const DIRECTION_PROPERTY = 'direction';
    private const ANGULAR_VELOCITY_PROPERTY = 'angularVelocity';
    private const DIRECTIONS_NUMBER_PROPERTY = 'directionsNumber';

    public function __construct(private readonly object $object)
    {
    }

    public function getDirection(): int
    {
        return $this->object->{self::DIRECTION_PROPERTY};
    }

    public function setDirection(float $direction): void
    {
        $this->object->{self::DIRECTION_PROPERTY} = $direction;
    }

    public function getAngularVelocity(): int
    {
        return $this->object->{self::ANGULAR_VELOCITY_PROPERTY};
    }

    public function getDirectionsNumber(): int
    {
        return $this->object->{self::DIRECTIONS_NUMBER_PROPERTY};
    }
}