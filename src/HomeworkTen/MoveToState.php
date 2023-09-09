<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkTen;

use Sapronovps\OtusHomework\HomeworkSeven\CommandInterface;

/**
 * Состояние процессора, при котором извлекаемые команды из очереди передаются в другую очередь.
 */
class MoveToState implements ProcessorStateInterface
{
    /**
     * Обрабатывает и возвращает следующее состояние.
     *
     * @param ProcessorInterface $processor
     * @return ProcessorStateInterface|null
     */
    public function next(ProcessorInterface $processor): ?ProcessorStateInterface
    {
        $cmd = $processor->gerQueue()->take();

        if (null === $cmd) {
            $this->changeState($processor, null);

            return null;
        }

        $processor->incrementExecutedCommandInMoveToState();

        if ($cmd instanceof ProcessorStateInterface) {
            $cmd->next($processor);
        }

        $this->sendToAnotherQueue($cmd);

        return $this;
    }

    /**
     * Изменение состояния главного процессора обработки очереди.
     *
     * @param ProcessorInterface           $processor
     * @param ProcessorStateInterface|null $state
     * @return void
     */
    public function changeState(ProcessorInterface $processor, ?ProcessorStateInterface $state): void
    {
        $processor->changeState($state);
    }

    /**
     * Отправка команд в другую очередь.
     *
     * @param CommandInterface $command
     * @return void
     */
    private function sendToAnotherQueue(CommandInterface $command) : void
    {
        // Реализация логики отправки в другую очередь
        $command->execute();
    }
}