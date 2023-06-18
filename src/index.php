<?php

require '../vendor/autoload.php';

$homeworkOne = new \Sapronovps\OtusHomework\HomeworkOne();

$dto = $homeworkOne->solve(-1, 0, 1);

echo $dto->x1 .'<br>';
echo $dto->x2 .'<br>';