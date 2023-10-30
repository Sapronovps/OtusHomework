<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Shipment\Command;

use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumCellType;
use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumDocumentStatus;
use Sapronovps\OtusHomework\FinalWork\Core\Interface\CommandInterface;
use Sapronovps\OtusHomework\FinalWork\Core\Iterator\RegWarehouseProductList;
use Sapronovps\OtusHomework\FinalWork\Core\Service\DocumentSaverService;
use Sapronovps\OtusHomework\FinalWork\Core\Strategy\CellCalculatorContext;
use Sapronovps\OtusHomework\FinalWork\Shipment\Document\DocShipment;
use Sapronovps\OtusHomework\FinalWork\Shipment\Dto\ShipmentDto;
use Sapronovps\OtusHomework\FinalWork\Shipment\Iterator\TabShipmentProductList;
use Sapronovps\OtusHomework\FinalWork\Shipment\TablePartDocument\TabShipmentProduct;

class ShipmentableCommand implements CommandInterface
{
    private RegWarehouseProductList $regWarehouseProductList;

    public function __construct(
        private readonly ShipmentDto $shipmentDto
    )
    {
    }

    public function getRegWarehouseProductList(): RegWarehouseProductList
    {
        return $this->regWarehouseProductList;
    }

    public function execute(): void
    {
        $cellCalculator = new CellCalculatorContext($this->shipmentDto->warehouse->type, EnumCellType::SHIPMENT);
        $shipmentCell = $cellCalculator->calculateCell();

        $tabShipmentProductList = new TabShipmentProductList();

        $tabShipmentProduct = new TabShipmentProduct(
            1,
            $shipmentCell->id,
            $this->shipmentDto->product->id,
            $this->shipmentDto->docReserveId,
            $this->shipmentDto->quantity
        );

        $tabShipmentProductList->add($tabShipmentProduct);

        $docShipment = new DocShipment(
            1,
            EnumDocumentStatus::ACTIVE,
            $this->shipmentDto->warehouse->id,
            $tabShipmentProductList
        );

        $this->regWarehouseProductList = (new DocumentSaverService())->save($docShipment);
    }
}