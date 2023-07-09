<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkFour\Command;

use Sapronovps\OtusHomework\HomeworkFour\Adapter\FuelBurnableInterface;
use Sapronovps\OtusHomework\HomeworkFour\Exception\CommandException;
use Sapronovps\OtusHomework\HomeworkTwo\Command\CommandInterface;

/**
 * Команда для проверки топлива.
 */
final class CheckFuelCommand implements CommandInterface
{
    public function __construct(private readonly FuelBurnableInterface $fuelBurnable)
    {
    }

    public function execute(): void
    {
        $nextFuelLevel = $this->fuelBurnable->getFuelLevel() - $this->fuelBurnable->getFuelConsumption();

        if ($nextFuelLevel < 0) {
            throw new CommandException('Недостаточно топлива.');
        }
    }
}