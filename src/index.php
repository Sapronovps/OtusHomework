<?php

use Sapronovps\OtusHomework\HomeworkFive\IoC;

require '../vendor/autoload.php';


// 1 ТЕСТ - Регистрация зависимости
$ioC = new IoC();

$ioC->resolve(IoC::SCOPES_NEW, 'scope1');
//$ioC->resolve(IoC::SCOPES_CURRENT, 'scope1');