<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\State;

use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumCellType;
use Sapronovps\OtusHomework\FinalWork\Core\Interface\CellCalculatorInterface;
use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefCell;
use Sapronovps\OtusHomework\FinalWork\Core\Strategy\CellRegularWarehouseStrategy;

/**
 * Состояние "Обычный склад - Поступление" для расчета ячейки поступления.
 */
class CellRegularWarehousePurchaseState implements CellCalculatorInterface
{
    public function __construct(public CellRegularWarehouseStrategy $stateStrategy)
    {
    }

    public function calculateCell(): RefCell
    {
        // Рассчитываем ячейку поступления
        $purchaseCell = new RefCell(1, 'AA-01-02-03', 1, EnumCellType::PURCHASE);

        $this->stateStrategy->setCell($purchaseCell);

        return $purchaseCell;
    }
}