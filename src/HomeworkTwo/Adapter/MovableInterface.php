<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkTwo\Adapter;

use Sapronovps\OtusHomework\HomeworkTwo\Vector;

interface MovableInterface
{
    public function getPosition(): Vector;

    public function setPosition(Vector $position): void;

    public function getVelocity(): Vector;
}