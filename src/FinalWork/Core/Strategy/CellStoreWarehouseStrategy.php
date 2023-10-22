<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\Strategy;

use PHPUnit\Util\Exception;
use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumCellType;
use Sapronovps\OtusHomework\FinalWork\Core\Interface\CellCalculatorInterface;
use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefCell;
use Sapronovps\OtusHomework\FinalWork\Core\State\CellStoreWarehousePurchaseState;
use Sapronovps\OtusHomework\FinalWork\Core\State\CellStoreWarehouseShipmentState;

/**
 * Стратегия получения ячейки для магазина-склада.
 */
class CellStoreWarehouseStrategy implements CellCalculatorInterface
{
    public function __construct(
        private readonly EnumCellType $cellType
    )
    {
    }

    public function calculateCell(): RefCell
    {
        $state = match ($this->cellType->value) {
            EnumCellType::PURCHASE->value => new CellStoreWarehousePurchaseState(),
            EnumCellType::SHIPMENT->value => new CellStoreWarehouseShipmentState(),
            default => throw new Exception('Магазин-склад не поддерживает тип ячеек: ' . $this->cellType->name),
        };

        return $state->calculateCell();
    }
}