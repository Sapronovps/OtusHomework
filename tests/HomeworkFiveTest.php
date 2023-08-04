<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sapronovps\OtusHomework\HomeworkFive\IoC;
use Sapronovps\OtusHomework\HomeworkFour\Adapter\FuelBurnableAdapter;
use Sapronovps\OtusHomework\HomeworkFour\Command\BurnFuelCommand;
use Sapronovps\OtusHomework\HomeworkFour\Command\ChangeVelocityCommand;
use Sapronovps\OtusHomework\HomeworkTwo\Spaceship;
use Sapronovps\OtusHomework\HomeworkTwo\Vector;

class HomeworkFiveTest extends TestCase
{
    private Spaceship $spaceship;

    /**
     * Тест регистрации зависимости в IoC контейнере.
     *
     * @return void
     */
    public function testOne(): void
    {
        $ioC = new IoC();
        $ioC = $this->registerDependencyAndGetIoC($ioC);

        $burnFuelCommand = $ioC->resolve(BurnFuelCommand::class);

        $this->assertEquals(BurnFuelCommand::class, $burnFuelCommand::class, 'Не удалось найти зависимость в IoC контейнере.');
    }

    /**
     * Тест когде не смогли найти зависимость в IoC контейнере.
     *
     * @return void
     */
    public function testTwo(): void
    {
        try {
            $ioC = new IoC();
            $ioC = $this->registerDependencyAndGetIoC($ioC);
            $ioC->resolve(ChangeVelocityCommand::class);
        } catch (Exception $ex) {
            $this->assertEquals('Зависимость Sapronovps\OtusHomework\HomeworkFour\Command\ChangeVelocityCommand не зарегистрирована.', $ex->getMessage(),
                'Текст ошибки не соответствует выполняемому тесту.'
            );
        }
    }

    /**
     * Тест получение зависимости в IoC контейнере.
     *
     * @return void
     */
    public function testThree(): void
    {
        $ioC = new IoC();
        $ioC = $this->registerDependencyAndGetIoC($ioC);

        /** @var BurnFuelCommand $burnFuelCommand */
        $burnFuelCommand = $ioC->resolve(BurnFuelCommand::class);
        $burnFuelCommand->execute();

        $this->assertEquals(0, $this->spaceship->fuelLevel, 'Команда для работы с топливом не выполнилась.');
    }

    /**
     * Тест создания новых scope.
     *
     * @return void
     */
    public function testFour(): void
    {
        $ioC = new IoC();

        // Создадим первый scope и добавим зависимость
        $ioC->resolve(IoC::SCOPES_NEW, 'scope1');
        $ioC->resolve(IoC::SCOPES_CURRENT, 'scope1');

        $ioC = $this->registerDependencyAndGetIoC($ioC);
        $burnFuelCommand = $ioC->resolve(BurnFuelCommand::class);

        $this->assertEquals(BurnFuelCommand::class, $burnFuelCommand::class, 'Не удалось найти зависимость в IoC контейнере.');

        // Создадим второй scope и получим зависимость по названию из первого scope
        $ioC->resolve(IoC::SCOPES_NEW, 'scope2');
        $ioC->resolve(IoC::SCOPES_CURRENT, 'scope2');

        try {
            $ioC->resolve(BurnFuelCommand::class);
        } catch (Exception $ex) {
            $this->assertEquals('Зависимость Sapronovps\OtusHomework\HomeworkFour\Command\BurnFuelCommand не зарегистрирована.', $ex->getMessage(),
                'Текст ошибки не соответствует выполняемому тесту.'
            );
        }
    }

    /**
     * Регистрация зависимости в IoC контейнере.
     *
     * @param IoC $ioC
     * @return IoC
     */
    private function registerDependencyAndGetIoC(IoC $ioC): IoC
    {
        $position = new Vector(12, 5);
        $velocity = new Vector(-7, 3);

        $this->spaceship = new Spaceship(
            position: $position,
            velocity: $velocity,
            fuelLevel: 1,
            fuelConsumption: 1
        );

        $fuelBurnableAdapter = new FuelBurnableAdapter($this->spaceship);

        $ioC->resolve(IoC::IOC_REGISTER, BurnFuelCommand::class, function () use ($fuelBurnableAdapter) {
            return new BurnFuelCommand($fuelBurnableAdapter);
        });

        return $ioC;
    }
}