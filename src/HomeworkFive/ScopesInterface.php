<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkFive;

/**
 * Интерфейс scopes.
 */
interface ScopesInterface
{
    /** Создание scope */
    public function createScope(string $scopeName): void;

    /** Возвращает текущий scope */
    public function getCurrentScope(): ScopeInterface;

    /** Установление текущего scope */
    public function setCurrentScope(string $scopeName): void;
}