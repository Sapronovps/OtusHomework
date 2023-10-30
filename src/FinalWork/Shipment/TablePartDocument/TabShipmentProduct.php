<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Shipment\TablePartDocument;

/**
 * Табличная часть документа "Отгрузка".
 */
final class TabShipmentProduct
{
    public function __construct(
        public int $id,
        public int $cellId,
        public int $productId,
        public int $docReserveId,
        public int $quantity
    )
    {
    }
}