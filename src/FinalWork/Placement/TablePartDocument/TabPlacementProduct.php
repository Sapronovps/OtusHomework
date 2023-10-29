<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Placement\TablePartDocument;

/**
 * Табличная часть документа "Размещение".
 */
final class TabPlacementProduct
{
    public function __construct(
        public int $id,
        public int $sourceCellId,
        public int $targetCellId,
        public int $productId,
        public $quantity
    )
    {
    }
}