<?php

use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumDocumentStatus;
use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumWarehouseType;
use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefProduct;
use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefWarehouse;
use Sapronovps\OtusHomework\FinalWork\Core\Service\DocumentSaverService;
use Sapronovps\OtusHomework\FinalWork\Purchase\DocPurchase;
use Sapronovps\OtusHomework\FinalWork\Purchase\PurchasableCommand;
use Sapronovps\OtusHomework\FinalWork\Purchase\PurchaseDto;
use Sapronovps\OtusHomework\FinalWork\Purchase\TabPurchaseProduct;
use Sapronovps\OtusHomework\FinalWork\Purchase\TabPurchaseProductList;

require '../vendor/autoload.php';


$warehouse = new RefWarehouse(1, 'Обычный склад', EnumWarehouseType::REGULAR_WAREHOUSE);
$product = new RefProduct(1, 'Лопата совковая');

$purchaseDto = new PurchaseDto($warehouse, $product, 10);

$purchasableCommand = new PurchasableCommand($purchaseDto);
$purchasableCommand->execute();

$regWarehouseProductList = $purchasableCommand->getRegWarehouseProductList();

var_dump($regWarehouseProductList);