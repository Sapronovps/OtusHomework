<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkTen;

use Sapronovps\OtusHomework\HomeworkSeven\CommandInterface;

/**
 * Команда изменения состояния главного процессора на MoveToState.
 */
class MoveToCommand implements CommandInterface, ProcessorStateInterface
{
    public function execute(): void
    {
        // Дополнительная логика команды, например логирование
    }

    public function next(ProcessorInterface $processor): ?ProcessorStateInterface
    {
        $moveToState = new MoveToState();
        $this->changeState($processor, $moveToState);

        return $moveToState;
    }

    public function changeState(ProcessorInterface $processor, ?ProcessorStateInterface $state): void
    {
        $processor->changeState($state);
    }
}