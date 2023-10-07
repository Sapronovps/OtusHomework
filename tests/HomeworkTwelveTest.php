<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sapronovps\OtusHomework\HomeworkFive\IoC;
use Sapronovps\OtusHomework\HomeworkTwelve\Command\FireCommand;
use Sapronovps\OtusHomework\HomeworkTwelve\Command\StartMoveCommand;
use Sapronovps\OtusHomework\HomeworkTwelve\Command\StopMoveCommand;
use Sapronovps\OtusHomework\HomeworkTwelve\Exception\InterpretException;
use Sapronovps\OtusHomework\HomeworkTwelve\Interpreter\Interpreter;
use Sapronovps\OtusHomework\HomeworkTwelve\Command\CommandInterface;

class HomeworkTwelveTest extends TestCase
{
    /**
     * Тестирование интерпретатора (Проверка что интерпретатор корректно вернет команду для установки начальной скорости).
     *
     * StartMoveCommand
     *
     * @return void
     * @throws InterpretException
     */
    public function testOne(): void
    {
        $gameId = 1;
        $gameObjectId = 1;
        $actionName = 'StartMoveCommand';

        $ioC = new IoC();
        $ioC->resolve(IoC::IOC_REGISTER, $actionName . 'Types.Get', function () {
            return new StartMoveCommand(new stdClass(), 0);
        });

        $gameObject = new stdClass();
        $gameObject->id = $gameObjectId;
        $gameObject->initialVelocity = 0;

        $ioC->resolve(IoC::IOC_REGISTER, $gameObject->id . ':' . $gameId . ':Objects.Get', function () use ($gameObject) {
            return $gameObject;
        });

        $order = new stdClass();
        $order->id = $gameObjectId;
        $order->gameId = $gameId;
        $order->action = $actionName;
        $order->initialVelocity = 10;

        $interpreter = new Interpreter($gameId, $ioC);
        /** @var CommandInterface $command */
        $command = $interpreter->interpret($order);

        $this->assertSame(StartMoveCommand::class, $command::class, 'Тест провален - ожидалась команда StartMoveCommand.');

        $command->execute();

        $this->assertSame($order->initialVelocity, $gameObject->initialVelocity, 'Тест провален - ожидалась начальная скорость - 10.');
    }

    /**
     * Тестирование интерпретатора (Проверка что интерпретатор корректно вернет команду для
     * установки начальной скорости и остановки передвижения).
     *
     * StartMoveCommand, StopMoveCommand
     *
     * @return void
     * @throws InterpretException
     */
    public function testTwo(): void
    {
        $gameId = 1;
        $gameObjectId = 1;
        $actionStartMoveName = 'StartMoveCommand';
        $actionStopMoveName = 'StopMoveCommand';

        $ioC = new IoC();
        $ioC->resolve(IoC::IOC_REGISTER, $actionStartMoveName . 'Types.Get', function () {
            return new StartMoveCommand(new stdClass(), 0);
        });

        $ioC->resolve(IoC::IOC_REGISTER, $actionStopMoveName . 'Types.Get', function () {
            return new StopMoveCommand(new stdClass());
        });

        $gameObject = new stdClass();
        $gameObject->id = $gameObjectId;
        $gameObject->initialVelocity = 0;
        $gameObject->velocity = 21;

        $ioC->resolve(IoC::IOC_REGISTER, $gameObject->id . ':' . $gameId . ':Objects.Get', function () use ($gameObject) {
            return $gameObject;
        });

        $order = new stdClass();
        $order->id = $gameObjectId;
        $order->gameId = $gameId;
        $order->action = $actionStartMoveName;
        $order->initialVelocity = 10;

        $interpreter = new Interpreter($gameId, $ioC);
        /** @var CommandInterface $command */
        $command = $interpreter->interpret($order);

        $this->assertSame(StartMoveCommand::class, $command::class, 'Тест провален - ожидалась команда StartMoveCommand.');

        $command->execute();

        $this->assertSame($order->initialVelocity, $gameObject->initialVelocity, 'Тест провален - ожидалась начальная скорость - 10.');

        $order = new stdClass();
        $order->id = $gameObjectId;
        $order->gameId = $gameId;
        $order->action = $actionStartMoveName;
        $order->initialVelocity = 10;

        $interpreter = new Interpreter($gameId, $ioC);
        /** @var CommandInterface $command */
        $command = $interpreter->interpret($order);

        $this->assertSame(StartMoveCommand::class, $command::class, 'Тест провален - ожидалась команда StartMoveCommand.');

        $command->execute();

        $this->assertSame($order->initialVelocity, $gameObject->initialVelocity, 'Тест провален - ожидалась начальная скорость - 10.');

        $order2 = new stdClass();
        $order2->id = $gameObjectId;
        $order2->gameId = $gameId;
        $order2->action = $actionStopMoveName;

        $command = $interpreter->interpret($order2);

        $this->assertSame(StopMoveCommand::class, $command::class, 'Тест провален - ожидалась команда StopMoveCommand.');

        $command->execute();

        $this->assertSame(0, $gameObject->velocity, 'Тест провален - ожидалась скорость - 0.');
    }

    /**
     * Тестирование интерпретатора (Проверка что интерпретатор корректно вернет команду для стрельбы).
     *
     * FireCommand
     *
     * @return void
     * @throws InterpretException
     */
    public function testThree(): void
    {
        $gameId = 1;
        $gameObjectId = 1;
        $actionFireCommand = 'FireCommand';

        $ioC = new IoC();

        $ioC->resolve(IoC::IOC_REGISTER, $actionFireCommand . 'Types.Get', function () {
            return new FireCommand(new stdClass(), 0);
        });

        $gameObject = new stdClass();
        $gameObject->id = $gameObjectId;
        $gameObject->fireDirection = 0;

        $ioC->resolve(IoC::IOC_REGISTER, $gameObject->id . ':' . $gameId . ':Objects.Get', function () use ($gameObject) {
            return $gameObject;
        });

        $order = new stdClass();
        $order->id = $gameObjectId;
        $order->gameId = $gameId;
        $order->action = $actionFireCommand;
        $order->fireDirection = 2;

        $interpreter = new Interpreter($gameId, $ioC);
        /** @var CommandInterface $command */
        $command = $interpreter->interpret($order);

        $this->assertSame(FireCommand::class, $command::class, 'Тест провален - ожидалась команда FireCommand.');

        $command->execute();

        $this->assertSame($order->fireDirection, $gameObject->fireDirection, 'Тест провален - ожидалась стрельба - 2.');
    }
}