<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkFour\Command;

use Sapronovps\OtusHomework\HomeworkFour\Adapter\FuelBurnableAdapter;
use Sapronovps\OtusHomework\HomeworkTwo\Adapter\MovableAdapter;
use Sapronovps\OtusHomework\HomeworkTwo\Command\CommandInterface;
use Sapronovps\OtusHomework\HomeworkTwo\Command\MoveCommand;

/**
 * Команда для перемещения с расходом топлива.
 */
final class MoveWithFuelCommand implements CommandInterface
{
    public function __construct(private readonly object $object)
    {
    }

    public function execute(): void
    {
        $fuelBurnableAdapter = new FuelBurnableAdapter($this->object);
        $checkFuelCommand = new CheckFuelCommand($fuelBurnableAdapter);
        $burnFuelCommand = new BurnFuelCommand($fuelBurnableAdapter);
        $movableAdapter = new MovableAdapter($this->object);
        $moveCommand = new MoveCommand($movableAdapter);

        $macroCommand = new MacroCommand([$checkFuelCommand, $burnFuelCommand, $moveCommand]);
        $macroCommand->execute();
    }
}