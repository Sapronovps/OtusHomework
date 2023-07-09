<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkFour\Command;

use Sapronovps\OtusHomework\HomeworkFour\Adapter\FuelBurnableInterface;
use Sapronovps\OtusHomework\HomeworkTwo\Command\CommandInterface;

/**
 * Команда для работы с топливом.
 */
final class BurnFuelCommand implements CommandInterface
{
    public function __construct(private readonly FuelBurnableInterface $fuelBurnable)
    {
    }

    public function execute(): void
    {
        $nextFuelLevel = $this->fuelBurnable->getFuelLevel() - $this->fuelBurnable->getFuelConsumption();
        $this->fuelBurnable->setFuelLevel($nextFuelLevel);
    }
}