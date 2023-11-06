<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\Strategy;

use PHPUnit\Util\Exception;
use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumCellType;
use Sapronovps\OtusHomework\FinalWork\Core\Interface\CellCalculatorInterface;
use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefCell;
use Sapronovps\OtusHomework\FinalWork\Core\State\CellRegularWarehousePlacementState;
use Sapronovps\OtusHomework\FinalWork\Core\State\CellRegularWarehousePurchaseState;
use Sapronovps\OtusHomework\FinalWork\Core\State\CellRegularWarehouseShipmentState;

/**
 * Стратегия получения ячейки для обычного склада.
 */
class CellRegularWarehouseStrategy implements CellCalculatorInterface
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
            EnumCellType::PURCHASE->value => new CellRegularWarehousePurchaseState($this),
            EnumCellType::PLACEMENT->value => new CellRegularWarehousePlacementState($this),
            EnumCellType::SHIPMENT->value => new CellRegularWarehouseShipmentState($this),
            default => throw new Exception('Обычный склад не поддерживает тип ячеек: ' . $this->cellType->name),
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