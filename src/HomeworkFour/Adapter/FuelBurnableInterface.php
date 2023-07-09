<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkFour\Adapter;

interface FuelBurnableInterface
{
    public function getFuelLevel(): int;

    public function setFuelLevel(int $fuelLevel): void;

    public function getFuelConsumption(): int;
}