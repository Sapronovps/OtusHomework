<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkTwelve\Command;

/**
 * Команда для стопа движения объекта.
 */
class StopMoveCommand implements CommandInterface
{
    public function __construct(
        private object $object
    )
    {
    }

    public function execute(): void
    {
        $this->object->velocity = 0;
    }
}