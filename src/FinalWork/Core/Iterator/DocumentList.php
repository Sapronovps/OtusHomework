<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\Iterator;

use Countable;
use Iterator;
use Sapronovps\OtusHomework\FinalWork\Core\Interface\DocumentInterface;

/**
 * Итератор для регистра накопления "Товары на складах".tr
 *
 */
final class DocumentList implements Countable, Iterator
{
    /** @var DocumentInterface[] */
    private array $documents = [];
    private int $currentIndex = 0;

    public function add(DocumentInterface $document): void
    {
        $this->documents[] = $document;
    }

    public function count(): int
    {
        return count($this->documents);
    }

    public function current(): DocumentInterface
    {
        return $this->documents[$this->currentIndex];
    }

    public function key(): int
    {
        return $this->currentIndex;
    }

    public function next(): void
    {
        $this->currentIndex++;
    }

    public function rewind(): void
    {
        $this->currentIndex = 0;
    }

    public function valid(): bool
    {
        return isset($this->documents[$this->currentIndex]);
    }
}