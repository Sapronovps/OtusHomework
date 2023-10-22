<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\Reference;

use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumWarehouseType;

/**
 * Справочник "Склад".
 */
final class RefWarehouse
{
    public function __construct(
        public int $id,
        public string $name,
        public EnumWarehouseType $type
    )
    {
    }
}