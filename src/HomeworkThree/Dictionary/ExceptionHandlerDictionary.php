<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkThree\Dictionary;

use Sapronovps\OtusHomework\HomeworkThree\Exception\MoveIncorrectPositionException;
use Sapronovps\OtusHomework\HomeworkThree\Exception\MoveIncorrectVelocityException;
use Sapronovps\OtusHomework\HomeworkThree\Exception\NotFoundHandlerException;
use Sapronovps\OtusHomework\HomeworkThree\ExceptionHandler\ExceptionHandlerInterface;
use Sapronovps\OtusHomework\HomeworkThree\ExceptionHandler\MoveIncorrectPositionExceptionHandler;
use Sapronovps\OtusHomework\HomeworkThree\ExceptionHandler\MoveIncorrectVelocityExceptionHandler;
use Sapronovps\OtusHomework\HomeworkTwo\Command\CommandInterface;
use Sapronovps\OtusHomework\HomeworkTwo\Command\MoveCommand;
use Throwable;

final class ExceptionHandlerDictionary
{
    /**
     * @param Throwable        $exception
     * @param CommandInterface $command
     * @return ExceptionHandlerInterface
     * @throws NotFoundHandlerException
     */
    public static function getHandler(Throwable $exception, CommandInterface $command): ExceptionHandlerInterface
    {
        $exceptionClass = $exception::class;
        $commandClass = $command::class;
        $handlerClass = self::getStructureHandler()[$exceptionClass][$commandClass] ?? false;

        if (false === $handlerClass) {
            throw new NotFoundHandlerException("Не удалось найти обработчик ошибки: $exceptionClass и команды $commandClass.");
        }

        return new $handlerClass($exception, $command);
    }

    private static function getStructureHandler(): array
    {
        $structureHandler = [];

        $structureHandler[MoveIncorrectPositionException::class][MoveCommand::class] = MoveIncorrectPositionExceptionHandler::class;
        $structureHandler[MoveIncorrectVelocityException::class][MoveCommand::class] = MoveIncorrectVelocityExceptionHandler::class;

        return $structureHandler;
    }
}