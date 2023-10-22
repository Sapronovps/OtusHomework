<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\Enum;

/**
 * Типы документов.
 */
enum EnumDocumentType: int
{
    case PURCHASE = 1;
    case PLACEMENT = 2;
    case RESERVE = 3;
    case SHIPMENT = 4;
}