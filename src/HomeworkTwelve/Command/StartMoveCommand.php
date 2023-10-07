<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkTwelve\Command;

/**
 * Команда для старта движения объекта.
 */
class StartMoveCommand implements CommandInterface
{
    public function __construct(
        private object $object,
        private int $initialVelocity
    )
    {
    }

    public function execute(): void
    {
        $this->object->initialVelocity = $this->initialVelocity;
    }
}