<?php


use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumWarehouseType;
use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefProduct;
use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefWarehouse;
use Sapronovps\OtusHomework\FinalWork\Purchase\Command\PurchasableCommand;
use Sapronovps\OtusHomework\FinalWork\Purchase\Dto\PurchaseDto;

require '../vendor/autoload.php';


$warehouse = new RefWarehouse(1, 'Обычный склад', EnumWarehouseType::REGULAR_WAREHOUSE);
$product = new RefProduct(1, 'Лопата совковая');

$purchaseDto = new PurchaseDto($warehouse, $product, 10);

$purchasableCommand = new PurchasableCommand($purchaseDto);
$purchasableCommand->execute();

$regWarehouseProductList = $purchasableCommand->getRegWarehouseProductList();

var_dump($regWarehouseProductList);