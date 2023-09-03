<?php

use Firebase\JWT\JWT;
use Sapronovps\OtusHomework\HomeworkEight\AuthService;
use Sapronovps\OtusHomework\HomeworkEight\GameServer;
use Sapronovps\OtusHomework\HomeworkSeven\BlockingCollection;
use Sapronovps\OtusHomework\HomeworkSeven\TestCommand;
use Sapronovps\OtusHomework\HomeworkSeven\Processable;
use Sapronovps\OtusHomework\HomeworkSeven\Processor;
use Sapronovps\OtusHomework\HomeworkSeven\SoftStopCommand;

require '../vendor/autoload.php';


$group = [
    'Pasha',
    'Sasha',
    'Viktor'
];

$gameServer = new GameServer();
$gameServer->registerGame($group);
$jwt = $gameServer->logInAsUser('Pasha');
$gameServer->play($jwt);

//$authService = new AuthService();
//$jwt = $authService->createToken($payload, $key);
//
//$pay = $authService->encodeToken($jwt, $key);



//$queue = new BlockingCollection();
//$queue->add(new TestCommand());
//$queue->add(new TestCommand());
//$processable = new Processable($queue);
//
//$queue->add(new SoftStopCommand($processable));
//$queue->add(new TestCommand());
//$queue->add(new TestCommand());
//$queue->add(new TestCommand());
//$processable->setQueue($queue);
//
//
//$processor = new Processor($processable);
//$processor->evaluaton();
//
//echo $processor->getNumberOfExecutedCommands();
//
//$queue->add(new TestCommand());
//$queue->add(new TestCommand());
//$processable->setQueue($queue);
//
//$processor = new Processor($processable);
//$processor->evaluaton();