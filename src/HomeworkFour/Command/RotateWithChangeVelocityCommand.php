<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkFour\Command;

use Sapronovps\OtusHomework\HomeworkFour\Adapter\VelocityChangeableAdapter;
use Sapronovps\OtusHomework\HomeworkTwo\Adapter\RotatableAdapter;
use Sapronovps\OtusHomework\HomeworkTwo\Command\CommandInterface;
use Sapronovps\OtusHomework\HomeworkTwo\Command\RotateCommand;
use Sapronovps\OtusHomework\HomeworkTwo\Vector;

/**
 * Команда для изменения поворта с измененным вектором мгновенной скорости.
 */
final class RotateWithChangeVelocityCommand implements CommandInterface
{
    public function __construct(private readonly object $object, private readonly Vector $newVelocity)
    {
    }

    public function execute(): void
    {
        $velocityChangeableAdapter = new VelocityChangeableAdapter($this->object);
        $changeVelocityCommand = new ChangeVelocityCommand($velocityChangeableAdapter, $this->newVelocity);
        $rotatableAdapter = new RotatableAdapter($this->object);
        $rotateCommand = new RotateCommand($rotatableAdapter);

        $macroCommand = new MacroCommand([$changeVelocityCommand, $rotateCommand]);
        $macroCommand->execute();
    }
}