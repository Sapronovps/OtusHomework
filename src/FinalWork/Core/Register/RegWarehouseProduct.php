<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\Register;

use DateTime;

final class RegWarehouseProduct
{
    public const WAREHOUSE_ID_FIELD = 'warehouseId';
    public const CELL_ID_FIELD = 'cellId';
    public const PRODUCT_ID_FIELD = 'productId';
    public const QUANTITY_FIELD = 'quantity';

    public function __construct(
        public int $id,
        public int $documentBasisId,
        public int $documentBasisTypeId,
        public DateTime $dateTime,
        public int $warehouseId,
        public int $cellId,
        public int $productId,
        public int $quantity
    )
    {
    }
}