<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkThree\Command;

use Sapronovps\OtusHomework\HomeworkThree\Dto\CommandDto;
use Sapronovps\OtusHomework\HomeworkTwo\Command\CommandInterface;
use Throwable;

final class AttemptsEndedCommand implements CommandInterface
{
    public function __construct(private readonly Throwable $exception, private readonly CommandDto $commandDto)
    {
    }

    public function execute(): void
    {
        echo 'Попытки закончились для исключения ' . $this->exception::class .  ' и команды ' . $this->commandDto::class;
    }
}