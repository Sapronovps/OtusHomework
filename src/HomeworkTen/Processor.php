<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkTen;

use Sapronovps\OtusHomework\HomeworkSeven\BlockingCollection;

/**
 * Главный процесс запуска очереди обработки команд.
 */
class Processor implements ProcessorInterface
{
    private int $countExecutedCommandInRunState = 0;

    private int $countExecutedCommandInMoveToState = 0;

    public function __construct(private readonly BlockingCollection $queue, private ?ProcessorStateInterface $state)
    {
    }

    /**
     * Запуск очереди команд.
     *
     * @return void
     */
    public function run(): void
    {
        while (null !== $this->state->next($this)) {}
    }

    /**
     * Смена состояния процессора.
     *
     * @param ProcessorStateInterface|null $state
     * @return void
     */
    public function changeState(?ProcessorStateInterface $state): void
    {
        $this->state = $state;
    }

    /**
     * Получение очереди.
     *
     * @return BlockingCollection
     */
    public function gerQueue(): BlockingCollection
    {
        return $this->queue;
    }

    public function getCountExecutedCommandInRunState(): int
    {
        return $this->countExecutedCommandInRunState;
    }

    public function getCountExecutedCommandInMoveToState(): int
    {
        return $this->countExecutedCommandInMoveToState;
    }

    public function incrementExecutedCommandInRunState(): void
    {
        $this->countExecutedCommandInRunState++;
    }

    public function incrementExecutedCommandInMoveToState(): void
    {
        $this->countExecutedCommandInMoveToState++;
    }
}