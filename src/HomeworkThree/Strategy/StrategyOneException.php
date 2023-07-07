<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkThree\Strategy;

use Sapronovps\OtusHomework\HomeworkThree\Command\LogCommand;
use Sapronovps\OtusHomework\HomeworkThree\Command\RepeatAgainCommand;
use Sapronovps\OtusHomework\HomeworkThree\Dto\CommandDto;
use Throwable;

/**
 * Первая стратегия обработки исключений (ошибок).
 */
final class StrategyOneException implements StrategyExceptionInterface
{
    public function run(Throwable $exception, CommandDto $commandDto): void
    {
        $command = $commandDto->countOfAttempts === 1 ? new RepeatAgainCommand($commandDto) : new LogCommand($exception, $commandDto);
        $command->execute();
    }
}