<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Placement\Dto;

use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefProduct;
use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefWarehouse;

class PlacementDto
{
    public function __construct(
        public RefWarehouse $warehouse,
        public RefProduct $product,
        public int $sourceCellId,
        public int $quantity
    )
    {
    }
}