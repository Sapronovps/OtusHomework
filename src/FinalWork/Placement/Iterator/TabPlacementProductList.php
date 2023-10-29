<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Placement\Iterator;

use Countable;
use Iterator;
use Sapronovps\OtusHomework\FinalWork\Placement\TablePartDocument\TabPlacementProduct;

/**
 * Итератор для табличной части "Товары" документа "Поступление".
 */
final class TabPlacementProductList implements Countable, Iterator
{
    /** @var TabPlacementProduct[] */
    private array $tabPlacementProducts = [];
    private int $currentIndex = 0;

    public function add(TabPlacementProduct $tabPurchaseProduct): void
    {
        $this->tabPlacementProducts[] = $tabPurchaseProduct;
    }

    public function count(): int
    {
        return count($this->tabPlacementProducts);
    }

    public function current(): TabPlacementProduct
    {
        return $this->tabPlacementProducts[$this->currentIndex];
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
        return isset($this->tabPlacementProducts[$this->currentIndex]);
    }
}