<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\Reference;

use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumCellType;

/**
 * Справочник "Ячейка".
 */
final class RefCell
{
    public function __construct(
        public int $id,
        public string $name,
        public int $warehouseId,
        public EnumCellType $type
    )
    {
    }
}