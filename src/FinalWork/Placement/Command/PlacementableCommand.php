<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Placement\Command;

use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumCellType;
use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumDocumentStatus;
use Sapronovps\OtusHomework\FinalWork\Core\Interface\CommandInterface;
use Sapronovps\OtusHomework\FinalWork\Core\Iterator\RegWarehouseProductList;
use Sapronovps\OtusHomework\FinalWork\Core\Service\DocumentSaverService;
use Sapronovps\OtusHomework\FinalWork\Core\Strategy\CellCalculatorContext;
use Sapronovps\OtusHomework\FinalWork\Placement\Document\DocPlacement;
use Sapronovps\OtusHomework\FinalWork\Placement\Dto\PlacementDto;
use Sapronovps\OtusHomework\FinalWork\Placement\Iterator\TabPlacementProductList;
use Sapronovps\OtusHomework\FinalWork\Placement\TablePartDocument\TabPlacementProduct;

class PlacementableCommand implements CommandInterface
{
    private RegWarehouseProductList $regWarehouseProductList;

    public function __construct(
        private readonly PlacementDto $placementDto
    )
    {
    }

    public function getRegWarehouseProductList(): RegWarehouseProductList
    {
        return $this->regWarehouseProductList;
    }

    public function execute(): void
    {
        $cellCalculator = new CellCalculatorContext($this->placementDto->warehouse->type, EnumCellType::PLACEMENT);
        $placementCell = $cellCalculator->calculateCell();

        $tabPlacementProductList = new TabPlacementProductList();

        $tabPlacementProduct = new TabPlacementProduct(
            1,
            $this->placementDto->sourceCellId,
            $placementCell->id,
            $this->placementDto->product->id,
            $this->placementDto->quantity
        );

        $tabPlacementProductList->add($tabPlacementProduct);

        $docPlacement = new DocPlacement(
            1,
            EnumDocumentStatus::ACTIVE,
            $this->placementDto->warehouse->id,
            $tabPlacementProductList
        );

        $this->regWarehouseProductList = (new DocumentSaverService())->save($docPlacement);
    }
}