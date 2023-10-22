<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\Strategy;

use PHPUnit\Util\Exception;
use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumCellType;
use Sapronovps\OtusHomework\FinalWork\Core\Interface\CellCalculatorInterface;
use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefCell;
use Sapronovps\OtusHomework\FinalWork\Core\State\CellSectorWarehousePlacementState;
use Sapronovps\OtusHomework\FinalWork\Core\State\CellSectorWarehousePurchaseState;
use Sapronovps\OtusHomework\FinalWork\Core\State\CellSectorWarehouseShipmentState;

/**
 * Стратегия получения ячейки для секторного склада.
 */
class CellSectorWarehouseStrategy implements CellCalculatorInterface
{
    public function __construct(
        private readonly EnumCellType $cellType
    )
    {
    }

    public function calculateCell(): RefCell
    {
        $state = match ($this->cellType->value) {
            EnumCellType::PURCHASE->value => new CellSectorWarehousePurchaseState(),
            EnumCellType::PLACEMENT->value => new CellSectorWarehousePlacementState(),
            EnumCellType::SHIPMENT->value => new CellSectorWarehouseShipmentState(),
            default => throw new Exception('Секторный склад не поддерживает тип ячеек: ' . $this->cellType->name),
        };

        return $state->calculateCell();
    }
}