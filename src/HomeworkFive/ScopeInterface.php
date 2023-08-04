<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkFive;

/**
 * Интерфейс scope.
 */
interface ScopeInterface
{
    /** Возвращает имя scope */
    public function getName(): string;

    /** Добавляет зависимость в scope  */
    public function addDependency(string $key, callable $dependencyCallable): void;

    /** Разрешает зависимости */
    public function resolve(string $key, ...$args): mixed;
}