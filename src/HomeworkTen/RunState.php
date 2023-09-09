<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkTen;

/**
 * Состояние процессора, при котором происходит обычная обработка команд.
 */
class RunState implements ProcessorStateInterface
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

        $processor->incrementExecutedCommandInRunState();

        if ($cmd instanceof ProcessorStateInterface) {
            $cmd->next($processor);
        }

        $cmd->execute();

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
}