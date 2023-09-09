<?php

use Sapronovps\OtusHomework\HomeworkSeven\BlockingCollection;
use Sapronovps\OtusHomework\HomeworkSeven\HardStopCommand;
use Sapronovps\OtusHomework\HomeworkSeven\Processable;
use Sapronovps\OtusHomework\HomeworkSeven\TestCommand;
use Sapronovps\OtusHomework\HomeworkTen\MoveToCommand;
use Sapronovps\OtusHomework\HomeworkTen\Processor;
use Sapronovps\OtusHomework\HomeworkTen\RunCommand;
use Sapronovps\OtusHomework\HomeworkTen\RunState;


require '../vendor/autoload.php';



//$queue = new BlockingCollection();
//$queue->add(new TestCommand());
//$queue->add(new TestCommand());
//$queue->add(new TestCommand());
//$queue->add(new MoveToCommand());
//$queue->add(new TestCommand());
//$queue->add(new TestCommand());
//$queue->add(new RunCommand());
//
//
//$processable = new Processable($queue);
//$queue->add(new HardStopCommand($processable));
//$queue->add(new TestCommand());
//$queue->add(new TestCommand());
//
//$processor = new Processor($queue, new RunState());
//$processor->run();
//
//echo $processor->getCountExecutedCommandInRunState() . '<br>';
//echo $processor->getCountExecutedCommandInMoveToState() . '<br>';




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