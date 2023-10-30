<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Reserve\Iterator;

use Countable;
use Iterator;
use Sapronovps\OtusHomework\FinalWork\Reserve\TablePartDocument\TabReserveProduct;

/**
 * Итератор для табличной части "Товары" документа "Поступление".
 */
final class TabReserveProductList implements Countable, Iterator
{
    /** @var TabReserveProduct[] */
    private array $tabReserveProducts = [];
    private int $currentIndex = 0;

    public function add(TabReserveProduct $tabReserveProduct): void
    {
        $this->tabReserveProducts[] = $tabReserveProduct;
    }

    public function count(): int
    {
        return count($this->tabReserveProducts);
    }

    public function current(): TabReserveProduct
    {
        return $this->tabReserveProducts[$this->currentIndex];
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
        return isset($this->tabReserveProducts[$this->currentIndex]);
    }
}