<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\Interface;

use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumDocumentStatus;
use Sapronovps\OtusHomework\FinalWork\Core\Enum\EnumDocumentType;

/**
 * Интерфейс для документов.
 */
interface DocumentInterface
{
    public function getId(): int;

    public function getType(): EnumDocumentType;

    public function getStatus(): EnumDocumentStatus;

    public function getWarehouseId(): int;

    /**
     * Возвращает проводки по регистру "Остатки на складах".
     *
     * @return array
     */
    public function getDataForRegWarehouseProduct(): array;
}