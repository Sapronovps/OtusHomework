<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkFour\Adapter;

use Sapronovps\OtusHomework\HomeworkTwo\Vector;

final class VelocityChangeableAdapter implements VelocityChangeableInterface
{
    private const VELOCITY_PROPERTY = 'velocity';

    public function __construct(private readonly object $object)
    {
    }

    public function getVelocity(): ?Vector
    {
        return $this->object->{self::VELOCITY_PROPERTY};
    }

    public function setVelocity(Vector $velocity): void
    {
        $this->object->{self::VELOCITY_PROPERTY} = $velocity;
    }
}