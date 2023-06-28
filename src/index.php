<?php

use Sapronovps\OtusHomework\HomeworkTwo\Vector;

require '../vendor/autoload.php';

$position = new Vector(12,5);
$velocity = new Vector(-7, 3);


$spaceship = new \Sapronovps\OtusHomework\HomeworkTwo\Spaceship(
    position: $position,
    velocity: $velocity,
);
$movableAdapter = new \Sapronovps\OtusHomework\HomeworkTwo\Adapter\MovableAdapter($spaceship);
$moveCommand = new \Sapronovps\OtusHomework\HomeworkTwo\Command\MoveCommand($movableAdapter);
$moveCommand->execute();

echo $spaceship->position->x . '<br>';
echo $spaceship->position->y . '<br>';

$position = new Vector(12,5);
