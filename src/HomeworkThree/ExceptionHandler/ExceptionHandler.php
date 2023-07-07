<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkThree\ExceptionHandler;

use Sapronovps\OtusHomework\HomeworkThree\Dictionary\ExceptionHandlerDictionary;
use Sapronovps\OtusHomework\HomeworkThree\Exception\NotFoundHandlerException;
use Sapronovps\OtusHomework\HomeworkTwo\Command\CommandInterface;
use Throwable;

class ExceptionHandler
{
    /**
     * Перенаправление ошибки конкретному обработчику через словарь.
     *
     * @param Throwable        $exception
     * @param CommandInterface $command
     * @return void
     * @throws NotFoundHandlerException
     */
    public static function handle(Throwable $exception, CommandInterface $command): void
    {
        ExceptionHandlerDictionary::getHandler($exception, $command)->execute();
    }
}