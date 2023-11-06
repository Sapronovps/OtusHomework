<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\Service;

use DateTime;
use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumDocumentStatus;
use Sapronovps\OtusHomework\FinalWork\Core\Interface\DocumentInterface;
use Sapronovps\OtusHomework\FinalWork\Core\Iterator\RegWarehouseProductList;
use Sapronovps\OtusHomework\FinalWork\Core\Register\RegWarehouseProduct;
use Throwable;

/**
 * Сервис для проведения документов.
 */
final class DocumentSaverService
{
    private static array $regWarehouseProductListHistory = [];

    public function save(DocumentInterface $document): ?RegWarehouseProductList
    {
        // Удалим старые проводки по документу, если такие есть
        if ($document->getStatus()->value === EnumDocumentStatus::DRAFT->value) {
            $this->deleteOldData();
        }

        $regWarehouseProductList = $this->createRegWarehouseProducts($document);

        // Создаем транзакцию (чтобы либо все данные сохранить в БД или ничего)
        // BEGIN TRANSACTION

        try {
            $this->saveToDbDocument();
            $this->saveToDbTablePart();
            $this->saveToDbRegWarehouseProduct();

            // ДЕЛАЕМ COMMIT

            self::$regWarehouseProductListHistory[] = $regWarehouseProductList;

            return $regWarehouseProductList;
        } catch (Throwable $ex) {
            // ДЕЛАЕМ ROLLBACK и логируем ошибку

            return null;
        }
    }

    public static function getRegWarehouseProductListHistory(): array
    {
        return self::$regWarehouseProductListHistory;
    }

    private function deleteOldData(): void
    {
        // Реализация логики удаления данных по документу.
    }

    private function createRegWarehouseProducts(DocumentInterface $document): RegWarehouseProductList
    {
        $regWarehouseProductList = new RegWarehouseProductList();
        $dataForRegWarehouseProduct = $document->getDataForRegWarehouseProduct();
        $i = 0;

        foreach ($dataForRegWarehouseProduct as $row) {
            $i++;
            $regWarehouseProduct = new RegWarehouseProduct(
                $i,
                $document->getId(),
                $document->getType()->value,
                new DateTime(),
                $row[RegWarehouseProduct::WAREHOUSE_ID_FIELD],
                $row[RegWarehouseProduct::CELL_ID_FIELD],
                $row[RegWarehouseProduct::PRODUCT_ID_FIELD],
                $row[RegWarehouseProduct::QUANTITY_FIELD],
                $row[RegWarehouseProduct::DOC_RESERVE_ID_FIELD]
            );

            $regWarehouseProductList->add($regWarehouseProduct);
        }

        return $regWarehouseProductList;
    }

    private function saveToDbDocument(): void
    {
        // Реализация логики сохранения в БД
    }

    private function saveToDbTablePart(): void
    {
        // Реализация логики сохранения в БД
    }

    private function saveToDbRegWarehouseProduct(): void
    {
        // Реализация логики сохранения в БД
    }
}