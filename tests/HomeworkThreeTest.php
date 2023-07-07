<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sapronovps\OtusHomework\HomeworkThree\Command\LogCommand;
use Sapronovps\OtusHomework\HomeworkThree\Command\QueueCommand;
use Sapronovps\OtusHomework\HomeworkThree\Command\RepeatAgainCommand;
use Sapronovps\OtusHomework\HomeworkThree\Dto\CommandDto;
use Sapronovps\OtusHomework\HomeworkThree\Strategy\StrategyOneException;
use Sapronovps\OtusHomework\HomeworkThree\Strategy\StrategyTwoException;
use Sapronovps\OtusHomework\HomeworkTwo\Adapter\MovableAdapter;
use Sapronovps\OtusHomework\HomeworkTwo\Command\MoveCommand;
use Sapronovps\OtusHomework\HomeworkTwo\Spaceship;
use Sapronovps\OtusHomework\HomeworkTwo\Vector;

class HomeworkThreeTest extends TestCase
{
    /**
     * Тест - проверить, что команда записывает информацию о выброшенном исключении в лог.
     *
     * @return void
     */
    public function testOne(): void
    {
        $position = new Vector(12 ,5);
        $velocity = null;

        $spaceship = new Spaceship(
            position: $position,
            velocity: $velocity
        );

        $movableAdapter = new MovableAdapter($spaceship);
        $moveCommand = new MoveCommand($movableAdapter);

        $commandDto = new CommandDto(command: $moveCommand);
        QueueCommand::addCommand($commandDto);

        $strategyOneException = new StrategyOneException();

        $queue = new QueueCommand($strategyOneException);
        $queue->execute();

        $expectedLogs = [
          'Sapronovps\OtusHomework\HomeworkTwo\Command\MoveCommand - Sapronovps\OtusHomework\HomeworkThree\Exception\MoveIncorrectVelocityException: Невозможно сдвинуть объект, неккоретная мгновенная скорость.'
        ];
        $actualLogs = LogCommand::getLogs();

        $this->assertEquals($expectedLogs, $actualLogs, 'Тест проверки, что команда записывает исключени в лог - провален.');
    }

    /**
     * Тест - проверить, что команда (RepeatAgainCommand) ставит повторно команду в очередь.
     *
     * @return void
     */
    public function testTwo(): void
    {
        $this->clearStaticCache();

        $position = new Vector(12 ,5);
        $velocity = null;

        $spaceship = new Spaceship(
            position: $position,
            velocity: $velocity
        );

        $movableAdapter = new MovableAdapter($spaceship);
        $moveCommand = new MoveCommand($movableAdapter);

        $commandDto = new CommandDto(command: $moveCommand);
        QueueCommand::addCommand($commandDto);

        $strategyOneException = new StrategyOneException();

        $queue = new QueueCommand($strategyOneException);
        $queue->execute();

        $expectedRepeatedCommands = ['Sapronovps\OtusHomework\HomeworkTwo\Command\MoveCommand'];

        $actualRepeatedCommand = RepeatAgainCommand::getRepeatedCommands();

        $this->assertEquals($expectedRepeatedCommands[0], $actualRepeatedCommand[0],
            'Тест проверки, что команда ставит повторно команду в очередь - провален.'
        );
    }

    /**
     * Тест - проверяет первую стратегию обработки ошибок (повторение команды при первом исключении и запись
     * в лог при втором исключении).
     *
     * @return void
     */
    public function testThree(): void
    {
        $this->clearStaticCache();

        $position = new Vector(12 ,5);
        $velocity = null;

        $spaceship = new Spaceship(
            position: $position,
            velocity: $velocity
        );

        $movableAdapter = new MovableAdapter($spaceship);
        $moveCommand = new MoveCommand($movableAdapter);

        $commandDto = new CommandDto(command: $moveCommand);
        QueueCommand::addCommand($commandDto);

        $strategyOneException = new StrategyOneException();

        $queue = new QueueCommand($strategyOneException);
        $queue->execute();

        $expectedLogs = [
            'Sapronovps\OtusHomework\HomeworkTwo\Command\MoveCommand - Sapronovps\OtusHomework\HomeworkThree\Exception\MoveIncorrectVelocityException: Невозможно сдвинуть объект, неккоретная мгновенная скорость.'
        ];
        $actualLogs = LogCommand::getLogs();

        $this->assertEquals($expectedLogs, $actualLogs, 'Тест проверки, что команда записывает исключени в лог - провален.');

        $expectedRepeatedCommands = ['Sapronovps\OtusHomework\HomeworkTwo\Command\MoveCommand'];

        $actualRepeatedCommand = RepeatAgainCommand::getRepeatedCommands();

        $this->assertEquals($expectedRepeatedCommands[0], $actualRepeatedCommand[0],
            'Тест проверки, что команда ставит повторно команду в очередь - провален.'
        );
    }

    /**
     * Тест - проверяет вторую стратегию обработки ошибок (повторение команды 2 раза, затем запись в лог.
     *
     * @return void
     */
    public function testFour(): void
    {
        $this->clearStaticCache();

        $position = new Vector(12 ,5);
        $velocity = null;

        $spaceship = new Spaceship(
            position: $position,
            velocity: $velocity
        );

        $movableAdapter = new MovableAdapter($spaceship);
        $moveCommand = new MoveCommand($movableAdapter);

        $commandDto = new CommandDto(command: $moveCommand);
        QueueCommand::addCommand($commandDto);

        $strategyOneException = new StrategyTwoException();

        $queue = new QueueCommand($strategyOneException);
        $queue->execute();

        $expectedLogs = [
            'Sapronovps\OtusHomework\HomeworkTwo\Command\MoveCommand - Sapronovps\OtusHomework\HomeworkThree\Exception\MoveIncorrectVelocityException: Невозможно сдвинуть объект, неккоретная мгновенная скорость.'
        ];
        $actualLogs = LogCommand::getLogs();

        $this->assertEquals($expectedLogs, $actualLogs, 'Тест проверки, что команда записывает исключени в лог - провален.');

        $expectedRepeatedCommands = [
            'Sapronovps\OtusHomework\HomeworkTwo\Command\MoveCommand',
            'Sapronovps\OtusHomework\HomeworkTwo\Command\MoveCommand',
        ];

        $actualRepeatedCommand = RepeatAgainCommand::getRepeatedCommands();

        $this->assertEquals($expectedRepeatedCommands[0], $actualRepeatedCommand[0],
            'Тест проверки, что команда ставит повторно команду в очередь - провален.'
        );

        $this->assertEquals($expectedRepeatedCommands[1], $actualRepeatedCommand[1],
            'Тест проверки, что команда ставит повторно команду в очередь - провален.'
        );
    }

    private function clearStaticCache(): void
    {
        LogCommand::clearStaticFunction();
        RepeatAgainCommand::clearStaticCache();
    }
}