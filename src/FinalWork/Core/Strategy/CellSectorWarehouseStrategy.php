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
    private ?RefCell $cell = null;

    public function __construct(
        private readonly EnumCellType $cellType
    )
    {
    }

    public function calculateCell(): RefCell
    {
        $state = match ($this->cellType->value) {
            EnumCellType::PURCHASE->value => new CellSectorWarehousePurchaseState($this),
            EnumCellType::PLACEMENT->value => new CellSectorWarehousePlacementState($this),
            EnumCellType::SHIPMENT->value => new CellSectorWarehouseShipmentState($this),
            default => throw new Exception('Секторный склад не поддерживает тип ячеек: ' . $this->cellType->name),
        };

        $state->calculateCell();

        return $this->getCell();
    }

    public function setCell(RefCell $cell): void
    {
        $this->cell = $cell;
    }

    public function getCell(): RefCell
    {
        return $this->cell;
    }
}