<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkThree\ExceptionHandler;

use Sapronovps\OtusHomework\HomeworkTwo\Command\CommandInterface;
use Throwable;

final class MoveIncorrectPositionExceptionHandler implements ExceptionHandlerInterface
{
    public function __construct(private readonly Throwable $exception, private readonly CommandInterface $command)
    {

    }

    public function execute(): void
    {
        echo 'Некорректная позиция ' . $this->command::class . ' выполнилась с ошибкой: ' . $this->exception->getMessage();
    }
}