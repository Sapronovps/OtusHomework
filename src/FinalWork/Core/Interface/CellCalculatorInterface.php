<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\Interface;

use Sapronovps\OtusHomework\FinalWork\Core\Reference\RefCell;

interface CellCalculatorInterface
{
    public function calculateCell(): RefCell;
}