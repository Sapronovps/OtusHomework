<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkSix;

/**
 * Интерфейс генерации классов PHP динамически.
 */
interface AutoGenerateClassInterface
{
    /**
     * Генерация PHP класса на основании существующего класса или контракта.
     *
     * @return string
     */
    public function generateClassStr(): string;
}