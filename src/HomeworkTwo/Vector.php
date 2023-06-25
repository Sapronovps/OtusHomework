<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkTwo;

final class Vector
{
    public function __construct(
        public readonly float $x = 0,
        public readonly float $y = 0,
    )
    {
    }

    public function add(self $vector): self
    {
        return new self(
            x: $this->x + $vector->x,
            y: $this->y + $vector->y
        );
    }
}