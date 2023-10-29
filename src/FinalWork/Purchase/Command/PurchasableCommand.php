<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Purchase\Command;

use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumCellType;
use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumDocumentStatus;
use Sapronovps\OtusHomework\FinalWork\Core\Interface\CommandInterface;
use Sapronovps\OtusHomework\FinalWork\Core\Iterator\RegWarehouseProductList;
use Sapronovps\OtusHomework\FinalWork\Core\Service\DocumentSaverService;
use Sapronovps\OtusHomework\FinalWork\Core\Strategy\CellCalculatorContext;
use Sapronovps\OtusHomework\FinalWork\Purchase\Document\DocPurchase;
use Sapronovps\OtusHomework\FinalWork\Purchase\Dto\PurchaseDto;
use Sapronovps\OtusHomework\FinalWork\Purchase\Iterator\TabPurchaseProductList;
use Sapronovps\OtusHomework\FinalWork\Purchase\TablePartDocument\TabPurchaseProduct;

/**
 * Команда для выполнения процесса "Поступление".
 */
class PurchasableCommand implements CommandInterface
{
    private RegWarehouseProductList $regWarehouseProductList;

    public function __construct(
        private readonly PurchaseDto $purchaseDto
    )
    {
    }

    public function getRegWarehouseProductList(): RegWarehouseProductList
    {
        return $this->regWarehouseProductList;
    }

    public function execute(): void
    {
        $cellCalculator = new CellCalculatorContext($this->purchaseDto->warehouse->type, EnumCellType::PURCHASE);
        $purchaseCell = $cellCalculator->calculateCell();

        $tabPurchaseProductList = new TabPurchaseProductList();

        $tabPurchaseProduct = new TabPurchaseProduct(
            1,
            $purchaseCell->id,
            $this->purchaseDto->product->id,
            $this->purchaseDto->quantity
        );

        $tabPurchaseProductList->add($tabPurchaseProduct);

        $docPurchase = new DocPurchase(
            1,
            EnumDocumentStatus::ACTIVE,
            1,
            $tabPurchaseProductList
        );

        $this->regWarehouseProductList = (new DocumentSaverService())->save($docPurchase);
    }
}