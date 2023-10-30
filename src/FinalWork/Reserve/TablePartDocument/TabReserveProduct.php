<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Reserve\TablePartDocument;

/**
 * Табличная часть документа "Резерв".
 */
final class TabReserveProduct
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