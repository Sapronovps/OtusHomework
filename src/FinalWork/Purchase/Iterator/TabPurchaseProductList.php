<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Purchase\Iterator;

use Countable;
use Iterator;
use Sapronovps\OtusHomework\FinalWork\Purchase\TablePartDocument\TabPurchaseProduct;

/**
 * Итератор для табличной части "Товары" документа "Поступление".
 */
final class TabPurchaseProductList implements Countable, Iterator
{
    /** @var TabPurchaseProduct[] */
    private array $tabPurchaseProducts = [];
    private int $currentIndex = 0;

    public function add(TabPurchaseProduct $tabPurchaseProduct): void
    {
        $this->tabPurchaseProducts[] = $tabPurchaseProduct;
    }

    public function count(): int
    {
        return count($this->tabPurchaseProducts);
    }

    public function current(): TabPurchaseProduct
    {
        return $this->tabPurchaseProducts[$this->currentIndex];
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
        return isset($this->tabPurchaseProducts[$this->currentIndex]);
    }
}