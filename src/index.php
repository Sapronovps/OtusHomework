<?php


use Sapronovps\OtusHomework\HomeworkFive\IoC;
use Sapronovps\OtusHomework\HomeworkTwelve\Command\StartMoveCommand;
use Sapronovps\OtusHomework\HomeworkTwelve\Interpreter\Interpreter;

require '../vendor/autoload.php';

$gameId = 1;

$actionName = 'StartMoveCommand';

$ioC = new IoC();
$ioC->resolve(IoC::IOC_REGISTER, $actionName . 'Types.Get', function () {
    return new StartMoveCommand(new stdClass(), 3);
});


$gameObject = new stdClass();
$gameObject->id = 1;
$gameObject->initialVelocity = 0;

$ioC->resolve(IoC::IOC_REGISTER, $gameObject->id . ':' . $gameId . ':Objects.Get', function () use ($gameObject) {
    return $gameObject;
});

$order = new stdClass();
$order->action = $actionName;
$order->gameId = $gameId;
$order->id = 1;
$order->initialVelocity = 10;

$interpreter = new Interpreter($gameId, $ioC);
$command = $interpreter->interpret($order);
$command->execute();

echo $gameObject->initialVelocity;