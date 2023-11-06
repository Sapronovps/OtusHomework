<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\State;

use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumCellType;
use Sapronovps\OtusHomework\FinalWork\Core\Interface\CellCalculatorInterface;
use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefCell;
use Sapronovps\OtusHomework\FinalWork\Core\Strategy\CellStoreWarehouseStrategy;

/**
 * Состояние "Магазин-склад - Отгрузка" для расчета ячейки отгрузки.
 */
class CellStoreWarehouseShipmentState implements CellCalculatorInterface
{
    public function __construct(public CellStoreWarehouseStrategy $stateStrategy)
    {
    }

    public function calculateCell(): RefCell
    {
        $shipmentCell = new RefCell(2, 'AA-01-02-03', 1, EnumCellType::SHIPMENT);

        $this->stateStrategy->setCell($shipmentCell);

        return $shipmentCell;
    }
}