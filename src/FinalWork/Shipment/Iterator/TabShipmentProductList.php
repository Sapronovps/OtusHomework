<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Shipment\Iterator;

use Countable;
use Iterator;
use Sapronovps\OtusHomework\FinalWork\Shipment\TablePartDocument\TabShipmentProduct;

/**
 * Итератор для табличной части "Товары" документа "Отгрузка".
 */
final class TabShipmentProductList implements Countable, Iterator
{
    /** @var TabShipmentProduct[] */
    private array $tabShipmentProducts = [];
    private int $currentIndex = 0;

    public function add(TabShipmentProduct $tabShipmentProduct): void
    {
        $this->tabShipmentProducts[] = $tabShipmentProduct;
    }

    public function count(): int
    {
        return count($this->tabShipmentProducts);
    }

    public function current(): TabShipmentProduct
    {
        return $this->tabShipmentProducts[$this->currentIndex];
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
        return isset($this->tabShipmentProducts[$this->currentIndex]);
    }
}