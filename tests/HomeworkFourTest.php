<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sapronovps\OtusHomework\HomeworkFour\Adapter\FuelBurnableAdapter;
use Sapronovps\OtusHomework\HomeworkFour\Adapter\VelocityChangeableAdapter;
use Sapronovps\OtusHomework\HomeworkFour\Command\BurnFuelCommand;
use Sapronovps\OtusHomework\HomeworkFour\Command\ChangeVelocityCommand;
use Sapronovps\OtusHomework\HomeworkFour\Command\CheckFuelCommand;
use Sapronovps\OtusHomework\HomeworkFour\Command\MacroCommand;
use Sapronovps\OtusHomework\HomeworkFour\Command\MoveWithFuelCommand;
use Sapronovps\OtusHomework\HomeworkFour\Command\RotateWithChangeVelocityCommand;
use Sapronovps\OtusHomework\HomeworkTwo\Adapter\MovableAdapter;
use Sapronovps\OtusHomework\HomeworkTwo\Command\MoveCommand;
use Sapronovps\OtusHomework\HomeworkTwo\Spaceship;
use Sapronovps\OtusHomework\HomeworkTwo\Vector;

class HomeworkFourTest extends TestCase
{
    /**
     * Тест - проверка команды проверки топлива (CheckFuelCommand).
     *
     * @return void
     */
    public function testOne(): void
    {
        try {
            $position = new Vector(12, 5);
            $velocity = new Vector(-7, 3);

            $spaceship = new Spaceship(
                position: $position,
                velocity: $velocity,
                fuelLevel: 0,
                fuelConsumption: 1
            );

            $fuelBurnableAdapter = new FuelBurnableAdapter($spaceship);
            $checkFuelCommand = new CheckFuelCommand($fuelBurnableAdapter);
            $checkFuelCommand->execute();
        } catch (Throwable $exception) {
            $exceptionMessage = 'Недостаточно топлива.';
            $this->assertEquals($exceptionMessage, $exception->getMessage(), 'Тест проверки команды проверки топлива (CheckFuelCommand) провален.');
        }
    }

    /**
     * Тест - проверка команды работы с топливом (BurnFuelCommand).
     *
     * @return void
     */
    public function testTwo(): void
    {
        $position = new Vector(12, 5);
        $velocity = new Vector(-7, 3);

        $spaceship = new Spaceship(
            position: $position,
            velocity: $velocity,
            fuelLevel: 1,
            fuelConsumption: 1
        );

        $fuelBurnableAdapter = new FuelBurnableAdapter($spaceship);
        $burnFuelCommand = new BurnFuelCommand($fuelBurnableAdapter);
        $burnFuelCommand->execute();

        $this->assertEquals(0, $spaceship->fuelLevel, 'Тест проверки команлы работы с топливом (BurnFuelCommand) провален.');
    }

    /**
     * Тест - простейшая проверка работы макрокоманды (MacroCommand) когда не хватает топлива (CommandException).
     *
     * @return void
     */
    public function testThree(): void
    {
        try {
            $position = new Vector(12, 5);
            $velocity = new Vector(-7, 3);

            $spaceship = new Spaceship(
                position: $position,
                velocity: $velocity,
                fuelLevel: 0,
                fuelConsumption: 1
            );

            $fuelBurnableAdapter = new FuelBurnableAdapter($spaceship);
            $checkFuelCommand = new CheckFuelCommand($fuelBurnableAdapter);
            $burnFuelCommand = new BurnFuelCommand($fuelBurnableAdapter);
            $movableAdapter = new MovableAdapter($spaceship);
            $moveCommand = new MoveCommand($movableAdapter);

            $macroCommand = new MacroCommand([$checkFuelCommand, $burnFuelCommand, $moveCommand]);
            $macroCommand->execute();
        } catch (Throwable $exception) {
            $exceptionMessage = 'Недостаточно топлива.';
            $this->assertEquals($exceptionMessage, $exception->getMessage(), 'Тест простейшей проверки работы макрокоманды (MacroCommand) провален.');
        }
    }

    /**
     * Тест - простейшая проверка работы макрокоманды (MacroCommand) когда хватает топлива.
     *
     * @return void
     */
    public function testFour(): void
    {
        $position = new Vector(12, 5);
        $velocity = new Vector(-7, 3);

        $spaceship = new Spaceship(
            position: $position,
            velocity: $velocity,
            fuelLevel: 1,
            fuelConsumption: 1
        );

        $fuelBurnableAdapter = new FuelBurnableAdapter($spaceship);
        $checkFuelCommand = new CheckFuelCommand($fuelBurnableAdapter);
        $burnFuelCommand = new BurnFuelCommand($fuelBurnableAdapter);
        $movableAdapter = new MovableAdapter($spaceship);
        $moveCommand = new MoveCommand($movableAdapter);

        $macroCommand = new MacroCommand([$checkFuelCommand, $burnFuelCommand, $moveCommand]);
        $macroCommand->execute();

        $this->assertEquals(0, $spaceship->fuelLevel, 'Тест проверки команлы работы с топливом (BurnFuelCommand) провален.');
    }

    /**
     * Тест - проверка работы команды перемещения с расходом топлива (MoveWithFuelCommand) когда не хватает топлива (CommandException).
     *
     * @return void
     */
    public function testFive(): void
    {
        try {
            $position = new Vector(12, 5);
            $velocity = new Vector(-7, 3);

            $spaceship = new Spaceship(
                position: $position,
                velocity: $velocity,
                fuelLevel: 0,
                fuelConsumption: 1
            );

            $moveWithFuelCommand = new MoveWithFuelCommand($spaceship);
            $moveWithFuelCommand->execute();
        } catch (Throwable $exception) {
            $exceptionMessage = 'Недостаточно топлива.';
            $this->assertEquals($exceptionMessage, $exception->getMessage(), 'Тест работы команды перемещения с расходом топлива (MoveWithFuelCommand) провален.');
        }
    }

    /**
     * Тест - проверка работы команды перемещения с расходом топлива (MoveWithFuelCommand) когда хватает топлива.
     *
     * @return void
     */
    public function testSix(): void
    {
        $position = new Vector(12, 5);
        $velocity = new Vector(-7, 3);

        $spaceship = new Spaceship(
            position: $position,
            velocity: $velocity,
            fuelLevel: 1,
            fuelConsumption: 1
        );

        $moveWithFuelCommand = new MoveWithFuelCommand($spaceship);
        $moveWithFuelCommand->execute();

        $this->assertEquals(0, $spaceship->fuelLevel, 'Тест работы команды перемещения с расходом топлива (MoveWithFuelCommand) провален.');
    }

    /**
     * Тест - проверка команды изменения вектора мгновенной скорости (ChangeVelocityCommand) - когда объект не может двигаться.
     *
     * @return void
     */
    public function testSeven(): void
    {
        try {
            $position = new Vector(12, 5);
            $velocity = null;

            $spaceship = new Spaceship(
                position: $position,
                velocity: $velocity,
            );

            $velocityChangeableAdapter = new VelocityChangeableAdapter($spaceship);
            $newVelocity = new Vector(5, 3);

            $changeVelocityCommand = new ChangeVelocityCommand($velocityChangeableAdapter, $newVelocity);
            $changeVelocityCommand->execute();
        } catch (Throwable $exception) {
            $exceptionMessage = 'Данный  объект не может двигаться.';
            $this->assertEquals($exceptionMessage, $exception->getMessage(), 'Тест проверки команды изменения вектора мгновенной скорости, когда объект не может двигаться провален.');
        }
    }

    /**
     * Тест - проверка команды изменения вектора мгновенной скорости (ChangeVelocityCommand) - когда объект может двигаться.
     *
     * @return void
     * @throws \Sapronovps\OtusHomework\HomeworkFour\Exception\CommandException
     */
    public function testEight(): void
    {
        $position = new Vector(12, 5);
        $velocity = new Vector(-7, 3);

        $spaceship = new Spaceship(
            position: $position,
            velocity: $velocity,
        );

        $velocityChangeableAdapter = new VelocityChangeableAdapter($spaceship);
        $newVelocity = new Vector(5, 3);

        $changeVelocityCommand = new ChangeVelocityCommand($velocityChangeableAdapter, $newVelocity);
        $changeVelocityCommand->execute();

        $messageIfTestFail = 'Тест проверки команды изменения вектора мгновенной скорости, когда объект может двигаться провален.';
        $this->assertEquals(5, $spaceship->velocity->x, $messageIfTestFail);
        $this->assertEquals(3, $spaceship->velocity->y, $messageIfTestFail);
    }

    /**
     * Тест - проверка команды изменения поворота и изменения вектора мгновенной скорости (RotateWithChangeVelocityCommand) - когда невозможно изменить скорость.
     *
     * @return void
     */
    public function testNine(): void
    {
        try {
            $position = new Vector(12, 5);
            $velocity = null;

            $spaceship = new Spaceship(
                position: $position,
                velocity: $velocity,
            );
            $newVelocity = new Vector(5, 3);

            $rotateWithChangeVelocityCommand = new RotateWithChangeVelocityCommand($spaceship, $newVelocity);
            $rotateWithChangeVelocityCommand->execute();
        } catch (Throwable $exception) {
            $exceptionMessage = 'Данный  объект не может двигаться.';
            $this->assertEquals($exceptionMessage, $exception->getMessage(), 'Тест проверки команды изменения вектора мгновенной скорости, когда невозможно изменить скорость провален.');
        }
    }

    /**
     * Тест - проверка команды изменения поворота и изменения вектора мгновенной скорости (RotateWithChangeVelocityCommand) - когда возможно изменить скорость.
     *
     * @return void
     */
    public function testTen(): void
    {
        $position = new Vector(12, 5);
        $velocity = new Vector(-7, 3);

        $spaceship = new Spaceship(
            position: $position,
            velocity: $velocity,
            direction: 100,
            angularVelocity: 12,
            directionsNumber: 2
        );
        $newVelocity = new Vector(5, 3);

        $rotateWithChangeVelocityCommand = new RotateWithChangeVelocityCommand($spaceship, $newVelocity);
        $rotateWithChangeVelocityCommand->execute();

        $messageIfTestFail = 'Тест проверки команды изменения вектора мгновенной скорости, когда возможно изменить скорость провален.';
        $this->assertEquals(5, $spaceship->velocity->x, $messageIfTestFail);
        $this->assertEquals(3, $spaceship->velocity->y, $messageIfTestFail);
    }
}