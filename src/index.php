<?php

use Sapronovps\OtusHomework\HomeworkSeven\BlockingCollection;
use Sapronovps\OtusHomework\HomeworkSeven\TestCommand;
use Sapronovps\OtusHomework\HomeworkSeven\Processable;
use Sapronovps\OtusHomework\HomeworkSeven\Processor;
use Sapronovps\OtusHomework\HomeworkSeven\SoftStopCommand;

require '../vendor/autoload.php';


$queue = new BlockingCollection();
$queue->add(new TestCommand());
$queue->add(new TestCommand());
$processable = new Processable($queue);

$queue->add(new SoftStopCommand($processable));
$queue->add(new TestCommand());
$queue->add(new TestCommand());
$queue->add(new TestCommand());
$processable->setQueue($queue);


$processor = new Processor($processable);
$processor->evaluaton();

echo $processor->getNumberOfExecutedCommands();

$queue->add(new TestCommand());
$queue->add(new TestCommand());
$processable->setQueue($queue);

$processor = new Processor($processable);
$processor->evaluaton();