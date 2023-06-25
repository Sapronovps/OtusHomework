<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkTwo\Adapter;

use Sapronovps\OtusHomework\HomeworkTwo\Vector;

final class MovableAdapter implements MovableInterface
{
    private const POSITION_PROPERTY = 'position';
    private const VELOCITY_PROPERTY = 'velocity';
    private const DIRECTION_PROPERTY = 'direction';
    private const DIRECTIONS_NUMBER_PROPERTY = 'directionsNumber';


    public function __construct(private readonly object $object)
    {
    }

    public function getPosition(): Vector
    {
        return $this->object->{self::POSITION_PROPERTY};
    }

    public function setPosition(Vector $position): void
    {
        $this->object->{self::POSITION_PROPERTY} = $position;
    }

    public function getVelocity(): Vector
    {
        $direction = $this->object->{self::DIRECTION_PROPERTY};
        $directionsNumber = $this->object->{self::DIRECTIONS_NUMBER_PROPERTY};
        $velocity = $this->object->{self::VELOCITY_PROPERTY};

        if (null === $direction || null === $directionsNumber) {
            return new Vector(
              x: $velocity->x,
              y: $velocity->y,
            );
        }

        return new Vector(
            x: $velocity->x * cos((float)$direction / 360 * (float)$directionsNumber),
            y: $velocity->y * sin((float)$direction / 360 * (float)$directionsNumber)
        );
    }
}