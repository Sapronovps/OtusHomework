<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkTwo\Command;

interface CommandInterface
{
    /**
     * Самый важный метод паттерна "Команда",
     * Получатель "Receiver" передается в конструктор.
     *
     * @return void
     */
    public function execute(): void;
}