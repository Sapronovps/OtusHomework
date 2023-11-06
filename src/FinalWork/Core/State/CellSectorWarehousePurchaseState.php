<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\State;

use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumCellType;
use Sapronovps\OtusHomework\FinalWork\Core\Interface\CellCalculatorInterface;
use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefCell;
use Sapronovps\OtusHomework\FinalWork\Core\Strategy\CellSectorWarehouseStrategy;

/**
 * Состояние "Секторный склад - Поступление" для расчета ячейки поступления.
 */
class CellSectorWarehousePurchaseState implements CellCalculatorInterface
{
    public function __construct(public CellSectorWarehouseStrategy $stateStrategy)
    {
    }

    public function calculateCell(): RefCell
    {
        $purchaseCell = new RefCell(1, 'AA-01-02-03', 1, EnumCellType::PURCHASE);

        $this->stateStrategy->setCell($purchaseCell);

        return $purchaseCell;
    }
}