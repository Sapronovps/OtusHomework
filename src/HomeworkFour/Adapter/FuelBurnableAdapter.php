<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkFour\Adapter;

/**
 * Адаптер для работы с топливом.
 */
final class FuelBurnableAdapter implements FuelBurnableInterface
{
    private const FUEL_LEVEL_PROPERTY = 'fuelLevel';
    private const FUEL_CONSUMPTION_PROPERTY = 'fuelConsumption';

    public function __construct(private readonly object $object)
    {
    }

    public function getFuelLevel(): int
    {
        return $this->object->{self::FUEL_LEVEL_PROPERTY};
    }

    public function setFuelLevel(int $fuelLevel): void
    {
        $this->object->{self::FUEL_LEVEL_PROPERTY} = $fuelLevel;
    }

    public function getFuelConsumption(): int
    {
        return $this->object->{self::FUEL_CONSUMPTION_PROPERTY};
    }
}