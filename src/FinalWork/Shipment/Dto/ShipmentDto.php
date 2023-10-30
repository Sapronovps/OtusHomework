<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Shipment\Dto;

use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefProduct;
use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefWarehouse;

class ShipmentDto
{
    public function __construct(
        public RefWarehouse $warehouse,
        public RefProduct $product,
        public $docReserveId,
        public int $quantity
    )
    {
    }
}