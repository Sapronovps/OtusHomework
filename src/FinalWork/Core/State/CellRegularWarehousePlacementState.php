<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\State;

use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumCellType;
use Sapronovps\OtusHomework\FinalWork\Core\Interface\CellCalculatorInterface;
use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefCell;
use Sapronovps\OtusHomework\FinalWork\Core\Strategy\CellRegularWarehouseStrategy;

/**
 * Состояние "Обычный склад - Размещение" для расчета ячейки размещения.
 */
class CellRegularWarehousePlacementState implements CellCalculatorInterface
{
    public function __construct(public CellRegularWarehouseStrategy $stateStrategy)
    {
    }

    public function calculateCell(): RefCell
    {
        $placementCell = new RefCell(2, 'AA-01-02-04', 1, EnumCellType::PLACEMENT);

        $this->stateStrategy->setCell($placementCell);

        return $placementCell;
    }
}