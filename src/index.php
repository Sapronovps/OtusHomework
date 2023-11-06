<?php


use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumDocumentType;
use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumWarehouseType;
use Sapronovps\OtusHomework\FinalWork\Core\Iterator\RegWarehouseProductList;
use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefProduct;
use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefWarehouse;
use Sapronovps\OtusHomework\FinalWork\Core\Service\DocumentSaverService;
use Sapronovps\OtusHomework\FinalWork\Placement\Command\PlacementableCommand;
use Sapronovps\OtusHomework\FinalWork\Placement\Dto\PlacementDto;
use Sapronovps\OtusHomework\FinalWork\Purchase\Command\PurchasableCommand;
use Sapronovps\OtusHomework\FinalWork\Purchase\Dto\PurchaseDto;
use Sapronovps\OtusHomework\FinalWork\Reserve\Command\ReservableCommand;
use Sapronovps\OtusHomework\FinalWork\Reserve\Dto\ReserveDto;
use Sapronovps\OtusHomework\FinalWork\Shipment\Command\ShipmentableCommand;
use Sapronovps\OtusHomework\FinalWork\Shipment\Dto\ShipmentDto;

require '../vendor/autoload.php';


$warehouse = new RefWarehouse(1, 'Обычный склад', EnumWarehouseType::REGULAR_WAREHOUSE);
$product = new RefProduct(1, 'Лопата совковая');

// Выполним поступление товара.
$purchaseDto = new PurchaseDto($warehouse, $product, 10);

$purchasableCommand = new PurchasableCommand($purchaseDto);
$purchasableCommand->execute();

sleep(1);

// Выполним размещение товара.
$placementDto = new PlacementDto($warehouse, $product, 1, 10);

$placementableCommmand = new PlacementableCommand($placementDto);
$placementableCommmand->execute();

sleep(1);

// Выполним резервирование товара.
$reserveDto = new ReserveDto($warehouse, $product, 5);

$reservableCommand = new ReservableCommand($reserveDto);
$reservableCommand->execute();

sleep(1);

// Выполним отгрузку товара.
$shipmentDto = new ShipmentDto($warehouse, $product, 1, 5);

$shipmentableCommand = new ShipmentableCommand($shipmentDto);
$shipmentableCommand->execute();


// Отобразим историю проведения по регистрам.
$list = DocumentSaverService::getRegWarehouseProductListHistory();

/** @var RegWarehouseProductList $regHistory */
foreach ($list as $regHistory) {
    foreach ($regHistory as $row) {
        echo 'Дата: ' . $row->dateTime->format('Y-m-d h:i:s') .
            '; Тип документа: ' . EnumDocumentType::tryFrom($row->documentBasisTypeId)->name .
            '; Товар: '.  $row->productId . '; Ячейка: ' . $row->cellId .
            '; Склад: ' . $row->warehouseId . '; Резерв: ' . $row->docReserveId .
            '; Количество: ' . $row->quantity . ';<br><br>';
    }
}
