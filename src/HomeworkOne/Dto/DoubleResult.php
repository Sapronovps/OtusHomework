<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkOne\Dto;

final class DoubleResult
{
    public function __construct(
        public readonly ?float $x1 = null,
        public readonly ?float $x2 = null,
    )
    {
    }
}