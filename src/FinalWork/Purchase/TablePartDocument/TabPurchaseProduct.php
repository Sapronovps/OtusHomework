<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Purchase\TablePartDocument;

/**
 * Табличная часть документа "Поступление".
 */
final class TabPurchaseProduct
{
    public function __construct(
        public int $id,
        public int $cellId,
        public int $productId,
        public int $quantity
    )
    {
    }
}