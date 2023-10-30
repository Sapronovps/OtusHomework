<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Reserve\Command;

use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumCellType;
use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumDocumentStatus;
use Sapronovps\OtusHomework\FinalWork\Core\Interface\CommandInterface;
use Sapronovps\OtusHomework\FinalWork\Core\Iterator\RegWarehouseProductList;
use Sapronovps\OtusHomework\FinalWork\Core\Service\DocumentSaverService;
use Sapronovps\OtusHomework\FinalWork\Core\Strategy\CellCalculatorContext;
use Sapronovps\OtusHomework\FinalWork\Reserve\Document\DocReserve;
use Sapronovps\OtusHomework\FinalWork\Reserve\Dto\ReserveDto;
use Sapronovps\OtusHomework\FinalWork\Reserve\Iterator\TabReserveProductList;
use Sapronovps\OtusHomework\FinalWork\Reserve\TablePartDocument\TabReserveProduct;

class ReservableCommand implements CommandInterface
{
    private RegWarehouseProductList $regWarehouseProductList;

    public function __construct(private readonly ReserveDto $reserveDto)
    {
    }

    public function getRegWarehouseProductList(): RegWarehouseProductList
    {
        return $this->regWarehouseProductList;
    }

    public function execute(): void
    {
        $cellCalculator = new CellCalculatorContext($this->reserveDto->warehouse->type, EnumCellType::PLACEMENT);
        $reserveCell = $cellCalculator->calculateCell();

        $tabReserveProductList = new TabReserveProductList();

        $tabReserveProduct = new TabReserveProduct(
            1,
            $reserveCell->id,
            $this->reserveDto->product->id,
            1,
            $this->reserveDto->quantity
        );

        $tabReserveProductList->add($tabReserveProduct);

        $docReserve = new DocReserve(
            1,
            EnumDocumentStatus::ACTIVE,
            $this->reserveDto->warehouse->id,
            $tabReserveProductList
        );

        $this->regWarehouseProductList = (new DocumentSaverService())->save($docReserve);
    }
}