<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkTen;

/**
 * Интерфейс состояний процессора.
 */
interface ProcessorStateInterface
{
    /**
     * Обрабатывает и возвращает следующее состояние.
     *
     * @param ProcessorInterface $processor
     * @return ProcessorStateInterface|null
     */
    public function next(ProcessorInterface $processor): ?ProcessorStateInterface;

    /**
     * Изменение состояния главного процессора обработки очереди.
     *
     * @param ProcessorInterface           $processor
     * @param ProcessorStateInterface|null $state
     * @return void
     */
    public function changeState(ProcessorInterface $processor, ?ProcessorStateInterface $state): void;
}