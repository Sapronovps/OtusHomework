<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkFour\Adapter;

use Sapronovps\OtusHomework\HomeworkTwo\Vector;

interface VelocityChangeableInterface
{
    public function getVelocity(): ?Vector;

    public function setVelocity(Vector $velocity): void;
}