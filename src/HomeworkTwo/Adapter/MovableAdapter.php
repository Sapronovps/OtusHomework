<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkTwo\Adapter;

use Exception;
use Sapronovps\OtusHomework\HomeworkThree\Exception\MoveIncorrectPositionException;
use Sapronovps\OtusHomework\HomeworkThree\Exception\MoveIncorrectVelocityException;
use Sapronovps\OtusHomework\HomeworkTwo\Vector;

/**
 * Адаптер для перемещения(движения) объекта.
 */
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
        $position = $this->object->{self::POSITION_PROPERTY};

        if (null === $position) {
            throw new MoveIncorrectPositionException('Невозможно сдвинуть объект, неккоретная позиция.');
        }

        return $this->object->{self::POSITION_PROPERTY};
    }

    public function setPosition(Vector $position): void
    {
        if (true === is_nan($position->x)) {
            throw new Exception('Координата x не число');
        }
        if (true === is_nan($position->y)) {
            throw new Exception('Координата y не число');
        }

        $this->object->{self::POSITION_PROPERTY} = $position;
    }

    public function getVelocity(): Vector
    {
        $direction = $this->object->{self::DIRECTION_PROPERTY};
        $directionsNumber = $this->object->{self::DIRECTIONS_NUMBER_PROPERTY};
        $velocity = $this->object->{self::VELOCITY_PROPERTY};

        if (null === $velocity) {
            throw new MoveIncorrectVelocityException('Невозможно сдвинуть объект, неккоретная мгновенная скорость.');
        }

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