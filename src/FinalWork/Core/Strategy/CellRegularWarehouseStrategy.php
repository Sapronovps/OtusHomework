<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\Strategy;

use PHPUnit\Util\Exception;
use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumCellType;
use Sapronovps\OtusHomework\FinalWork\Core\Interface\CellCalculatorInterface;
use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefCell;
use Sapronovps\OtusHomework\FinalWork\Core\State\CellRegularWarehousePlacementState;
use Sapronovps\OtusHomework\FinalWork\Core\State\CellRegularWarehousePurchaseState;
use Sapronovps\OtusHomework\FinalWork\Core\State\CellStoreWarehouseShipmentState;

/**
 * Стратегия получения ячейки для обычного склада.
 */
class CellRegularWarehouseStrategy implements CellCalculatorInterface
{
    public function __construct(
        private readonly EnumCellType $cellType
    )
    {
    }

    public function calculateCell(): RefCell
    {
        $state = match ($this->cellType->value) {
            EnumCellType::PURCHASE->value => new CellRegularWarehousePurchaseState(),
            EnumCellType::PLACEMENT->value => new CellRegularWarehousePlacementState(),
            EnumCellType::SHIPMENT->value => new CellStoreWarehouseShipmentState(),
            default => throw new Exception('Обычный склад не поддерживает тип ячеек: ' . $this->cellType->name),
        };

       return $state->calculateCell();
    }
}