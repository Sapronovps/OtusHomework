<?php

use Sapronovps\OtusHomework\HomeworkEleven\CheckCollisionsOfGameObjectsCommand;
use Sapronovps\OtusHomework\HomeworkEleven\CheckNeighborhoodAndCollisionsCommand;
use Sapronovps\OtusHomework\HomeworkEleven\CheckNeighborhoodCommand;
use Sapronovps\OtusHomework\HomeworkEleven\GameObjectDto;
use Sapronovps\OtusHomework\HomeworkEleven\PlayingFieldDto;
use Sapronovps\OtusHomework\HomeworkEleven\PlayingFieldsDto;
use Sapronovps\OtusHomework\HomeworkSeven\BlockingCollection;
use Sapronovps\OtusHomework\HomeworkSeven\HardStopCommand;
use Sapronovps\OtusHomework\HomeworkSeven\Processable;
use Sapronovps\OtusHomework\HomeworkSeven\TestCommand;
use Sapronovps\OtusHomework\HomeworkTen\MoveToCommand;
use Sapronovps\OtusHomework\HomeworkTen\Processor;
use Sapronovps\OtusHomework\HomeworkTen\RunCommand;
use Sapronovps\OtusHomework\HomeworkTen\RunState;


require '../vendor/autoload.php';


//$gameObject1 = new GameObjectDto('Pasha', 1);
//$gameObject2 = new GameObjectDto('Sasha', 2);
//$gameObject3 = new GameObjectDto('Dima', 3);
//$gameObject4 = new GameObjectDto('Anton', 4);
//
//$playingField = new PlayingFieldDto(1, [$gameObject1, $gameObject2, $gameObject3, $gameObject4]);
//$playingFields = new PlayingFieldsDto([$playingField]);
//
//$checkNeighborhoodAndCollisionsCommand = new CheckNeighborhoodAndCollisionsCommand();
//$checkNeighborhoodAndCollisionsCommand->execute($playingFields);
//
//
//foreach ($playingFields->playingFieldsDto as $playingFieldDto) {
//    foreach ($playingFieldDto->gameObjects as $gameObject) {
//        echo $playingFieldDto->id . ' - ' . $gameObject->name . ' - ' . $gameObject->position . '<br>';
//    }
//}



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