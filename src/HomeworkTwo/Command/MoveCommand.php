<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkTwo\Command;

use Sapronovps\OtusHomework\HomeworkTwo\Adapter\MovableInterface;

/**
 * Команда для движения (изменения положения объекта).
 */
final class MoveCommand implements CommandInterface
{
    public function __construct(private readonly MovableInterface $movable)
    {
    }

    public function execute(): void
    {
        $this->movable->setPosition($this->movable->getPosition()->add($this->movable->getVelocity()));
    }
}