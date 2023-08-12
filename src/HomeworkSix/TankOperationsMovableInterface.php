<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkSix;

use Sapronovps\OtusHomework\HomeworkTwo\Vector;

interface TankOperationsMovableInterface
{
    public function getPosition(): Vector;

    public function setPosition(Vector $vector): void;

    public function getVelocity(): Vector;
}