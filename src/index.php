<?php

use Sapronovps\OtusHomework\HomeworkThree\Command\QueueCommand;
use Sapronovps\OtusHomework\HomeworkThree\Dto\CommandDto;
use Sapronovps\OtusHomework\HomeworkTwo\Vector;

require '../vendor/autoload.php';

$position = new Vector(12,5);
$velocity = new Vector(-7, 3);


$spaceship = new \Sapronovps\OtusHomework\HomeworkTwo\Spaceship(
    position: $position,
    velocity: null,
);
$movableAdapter = new \Sapronovps\OtusHomework\HomeworkTwo\Adapter\MovableAdapter($spaceship);
$moveCommand = new \Sapronovps\OtusHomework\HomeworkTwo\Command\MoveCommand($movableAdapter);

$commandDto = new CommandDto(command: $moveCommand);
QueueCommand::addCommand($commandDto);

$strategyOneException = new \Sapronovps\OtusHomework\HomeworkThree\Strategy\StrategyTwoException();
$queue = new QueueCommand($strategyOneException);
$queue->execute();

$commands = \Sapronovps\OtusHomework\HomeworkThree\Command\RepeatAgainCommand::getRepeatedCommands();

var_dump($commands);

echo $spaceship->position->x . '<br>';
echo $spaceship->position->y . '<br>';
