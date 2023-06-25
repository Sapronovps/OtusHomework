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
$velocity = $movableAdapter->getVelocity();
$moveCommand = new \Sapronovps\OtusHomework\HomeworkTwo\Command\MoveCommand($movableAdapter);
$moveCommand->execute();

echo $spaceship->position->x . '<br>';
echo $spaceship->position->y . '<br>';

$position = new Vector(12,5);
$velocity = new Vector(-7, 3);
$direction = null;
$directionsNumber = null;

//echo sin(1);s
//echo $velocity->x * sin((float)$direction / 360 * (float)$directionsNumber) . '<br>';
//echo $velocity->x;

//$velocity = new Vector(
//    x: $velocity->x * sin($direction / 360 * $directionsNumber),
//    y: $velocity->y * cos($direction / 360 * $directionsNumber)
//);
//
//
//$newPosition = $position->add($velocity);
//
//echo $newPosition->x . '<br>';
//echo $newPosition->y . '<br>';