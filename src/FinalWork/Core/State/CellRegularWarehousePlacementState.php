<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\State;

use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumCellType;
use Sapronovps\OtusHomework\FinalWork\Core\Interface\CellCalculatorInterface;
use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefCell;

/**
 * Состояние "Обычный склад - Размещение" для расчета ячейки размещения.
 */
class CellRegularWarehousePlacementState implements CellCalculatorInterface
{
    public function calculateCell(): RefCell
    {
        return new RefCell(1, 'AA-01-02-03', 1, EnumCellType::PURCHASE);
    }
}