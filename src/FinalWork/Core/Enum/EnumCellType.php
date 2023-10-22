<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\Enum;

enum EnumCellType: int
{
    case PURCHASE = 1;
    case PLACEMENT = 2;
    case SHIPMENT = 3;
}