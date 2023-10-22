<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\Enum;

/**
 * Статусы документов.
 */
enum EnumDocumentStatus: int
{
    case ACTIVE = 1;
    case DRAFT = 2;
}