<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\Reference;

/**
 * Справочник "Товар".
 */
final class RefProduct
{
    public function __construct(
        public int $id,
        public string $name
    )
    {
    }
}