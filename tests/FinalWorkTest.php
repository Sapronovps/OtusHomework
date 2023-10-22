<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumWarehouseType;
use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefProduct;
use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefWarehouse;
use Sapronovps\OtusHomework\FinalWork\Purchase\PurchasableCommand;
use Sapronovps\OtusHomework\FinalWork\Purchase\PurchaseDto;

class FinalWorkTest extends TestCase
{
    /**
     * Тестирования процесса "Поступление".
     *
     * @return void
     */
    public function testPurchase(): void
    {
        $warehouse = new RefWarehouse(1, 'Обычный склад', EnumWarehouseType::REGULAR_WAREHOUSE);
        $product = new RefProduct(1, 'Лопата совковая');

        $purchaseDto = new PurchaseDto($warehouse, $product, 10);

        $purchasableCommand = new PurchasableCommand($purchaseDto);
        $purchasableCommand->execute();

        $regWarehouseProductList = $purchasableCommand->getRegWarehouseProductList();

        $this->assertNotEmpty($regWarehouseProductList);
    }
}