<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkTwo\Command;

use Sapronovps\OtusHomework\HomeworkTwo\Adapter\RotatableInterface;

/**
 * Команда для поворота вокруг оси.
 */
final class RotateCommand implements CommandInterface
{
    public function __construct(private readonly RotatableInterface $rotatable)
    {
    }

    public function execute(): void
    {
        $this->rotatable->setDirection(ceil(
            ($this->rotatable->getDirection() + $this->rotatable->getAngularVelocity()) % $this->rotatable->getDirectionsNumber()
        ));
    }
}