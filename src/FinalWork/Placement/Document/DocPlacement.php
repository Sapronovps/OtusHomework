<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Placement\Document;

use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumDocumentStatus;
use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumDocumentType;
use Sapronovps\OtusHomework\FinalWork\Core\Exception\DocumentException;
use Sapronovps\OtusHomework\FinalWork\Core\Interface\DocumentInterface;
use Sapronovps\OtusHomework\FinalWork\Core\Register\RegWarehouseProduct;
use Sapronovps\OtusHomework\FinalWork\Placement\Iterator\TabPlacementProductList;

final class DocPlacement implements DocumentInterface
{
    public function __construct(
        public int $id,
        public EnumDocumentStatus $status,
        public int $warehouseId,
        public TabPlacementProductList $products
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getStatus(): EnumDocumentStatus
    {
        return $this->status;
    }

    public function getType(): EnumDocumentType
    {
        return EnumDocumentType::PLACEMENT;
    }

    public function getWarehouseId(): int
    {
        return $this->warehouseId;
    }

    /**
     * Возвращает проводки по регистру "Остатки на складах".
     *
     * @return array
     * @throws DocumentException
     */
    public function getDataForRegWarehouseProduct(): array
    {
        $data = [];

        foreach ($this->products as $product) {
            if ($product->quantity < 0) {
                throw new DocumentException('Для документа "Поступление" - количество должно быть > 0.');
            }

            $data[] = [
                RegWarehouseProduct::WAREHOUSE_ID_FIELD => $this->warehouseId,
                RegWarehouseProduct::CELL_ID_FIELD => $product->sourceCellId,
                RegWarehouseProduct::PRODUCT_ID_FIELD => $product->productId,
                RegWarehouseProduct::QUANTITY_FIELD => -1 * $product->quantity,
                RegWarehouseProduct::DOC_RESERVE_ID_FIELD => null,
            ];

            $data[] = [
                RegWarehouseProduct::WAREHOUSE_ID_FIELD => $this->warehouseId,
                RegWarehouseProduct::CELL_ID_FIELD => $product->targetCellId,
                RegWarehouseProduct::PRODUCT_ID_FIELD => $product->productId,
                RegWarehouseProduct::QUANTITY_FIELD => $product->quantity,
                RegWarehouseProduct::DOC_RESERVE_ID_FIELD => null,
            ];
        }

        return $data;
    }
}