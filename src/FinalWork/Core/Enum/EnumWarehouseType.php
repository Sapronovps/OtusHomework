<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\Enum;

enum EnumWarehouseType: int
{
    case REGULAR_WAREHOUSE = 1;

    case SECTOR_WAREHOUSE = 2;

    case STORE_WAREHOUSE = 3;
}