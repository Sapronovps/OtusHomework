<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkFour\Command;

use Sapronovps\OtusHomework\HomeworkFour\Adapter\VelocityChangeableInterface;
use Sapronovps\OtusHomework\HomeworkFour\Exception\CommandException;
use Sapronovps\OtusHomework\HomeworkTwo\Command\CommandInterface;
use Sapronovps\OtusHomework\HomeworkTwo\Vector;

/**
 * Команда для изменения мгновенной скорости.
 */
final class ChangeVelocityCommand implements CommandInterface
{
    public function __construct(private readonly VelocityChangeableInterface $velocityChangeable, private readonly Vector $newVelocity)
    {
    }

    public function execute(): void
    {
        $currentVelocity = $this->velocityChangeable->getVelocity();

        if (null === $currentVelocity) {
            throw new CommandException('Данный  объект не может двигаться.');
        }

        $this->velocityChangeable->setVelocity($this->newVelocity);
    }
}