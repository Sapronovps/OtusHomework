<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\Iterator;

use Countable;
use Iterator;
use Sapronovps\OtusHomework\FinalWork\Core\Register\RegWarehouseProduct;

/**
 * Итератор для регистра накопления "Товары на складах".
 */
final class RegWarehouseProductList implements Countable, Iterator
{
    /** @var RegWarehouseProduct[] */
    private array $regWarehouseProducts = [];
    private int $currentIndex = 0;

    public function add(RegWarehouseProduct $regWarehouseProduct): void
    {
        $this->regWarehouseProducts[] = $regWarehouseProduct;
    }

    public function count(): int
    {
        return count($this->regWarehouseProducts);
    }

    public function current(): RegWarehouseProduct
    {
        return $this->regWarehouseProducts[$this->currentIndex];
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
        return isset($this->regWarehouseProducts[$this->currentIndex]);
    }
}