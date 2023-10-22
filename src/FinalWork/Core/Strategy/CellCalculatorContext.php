<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\Strategy;

use PHPUnit\Util\Exception;
use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumCellType;
use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumWarehouseType;
use Sapronovps\OtusHomework\FinalWork\Core\Interface\CellCalculatorInterface;
use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefCell;

final class CellCalculatorContext implements CellCalculatorInterface
{
    public function __construct(
        public EnumWarehouseType $warehouseType,
        public EnumCellType $cellType
    )
    {
    }

    public function calculateCell(): RefCell
    {
        $strategy = match ($this->warehouseType->value) {
          EnumWarehouseType::REGULAR_WAREHOUSE->value => new CellRegularWarehouseStrategy($this->cellType),
          EnumWarehouseType::SECTOR_WAREHOUSE->value => new CellSectorWarehouseStrategy($this->cellType),
          EnumWarehouseType::STORE_WAREHOUSE->value => new CellStoreWarehouseStrategy($this->cellType),
          default => throw new Exception('Стратегия ' . $this->warehouseType->name . ' еще не определена.'),
        };

        return $strategy->calculateCell();
    }
}