<?php

use Sapronovps\OtusHomework\HomeworkTwo\Adapter\RotatableAdapter;
use Sapronovps\OtusHomework\HomeworkTwo\Command\RotateCommand;
use Sapronovps\OtusHomework\HomeworkTwo\Spaceship;
use Sapronovps\OtusHomework\HomeworkTwo\Vector;

require '../vendor/autoload.php';

$position = new Vector(12,5);
$velocity = new Vector(-7, 3);

$position = new Vector(12, 5);
$velocity = new Vector(-7, 3);

$spaceship = new Spaceship(
    position: $position,
    velocity: $velocity,
    direction: 100,
    angularVelocity: 12,
    directionsNumber: 2
);

$rotatableAdapter = new RotatableAdapter($spaceship);
$rotateCommand = new RotateCommand($rotatableAdapter);
$rotateCommand->execute();

echo $spaceship->fuelLevel . '<br>';
echo $spaceship->fuelConsumption . '<br>';
