<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Reserve\Dto;

use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefProduct;
use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefWarehouse;

class ReserveDto
{
    public function __construct(
        public RefWarehouse $warehouse,
        public RefProduct $product,
        public int $quantity
    )
    {
    }
}