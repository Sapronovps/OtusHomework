<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkTen;

use Sapronovps\OtusHomework\HomeworkSeven\BlockingCollection;

/**
 * Интерфейс главного процесса запуска очереди команд.
 */
interface ProcessorInterface
{
    /**
     * Запуск очереди команд.
     *
     * @return void
     */
    public function run(): void;

    /**
     * Смена состояния процессора.
     *
     * @param ProcessorStateInterface|null $state
     * @return void
     */
    public function changeState(?ProcessorStateInterface $state): void;

    /**
     * Получение очереди.
     *
     * @return BlockingCollection
     */
    public function gerQueue(): BlockingCollection;

    /**
     * Увеличение счетчика запуска команд в RunState.
     *
     * @return void
     */
    public function incrementExecutedCommandInRunState(): void;

    /**
     * Увеличение счетчика запуска команд в MoveToState.
     *
     * @return void
     */
    public function incrementExecutedCommandInMoveToState(): void;
}