<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkThree\Strategy;

use Sapronovps\OtusHomework\HomeworkThree\Command\AttemptsEndedCommand;
use Sapronovps\OtusHomework\HomeworkThree\Command\LogCommand;
use Sapronovps\OtusHomework\HomeworkThree\Command\RepeatAgainCommand;
use Sapronovps\OtusHomework\HomeworkThree\Dto\CommandDto;
use Throwable;

/**
 * Вторая стратегия обработки исключений (ошибок).
 */
final class StrategyTwoException implements StrategyExceptionInterface
{
    public function run(Throwable $exception, CommandDto $commandDto): void
    {
        if ($commandDto->countOfAttempts < 3) {
            $command = new RepeatAgainCommand($commandDto);
        } else if ($commandDto->countOfAttempts === 3) {
            $command = new LogCommand($exception, $commandDto);
        } else {
            $command = new AttemptsEndedCommand($exception, $commandDto);
        }

        $command->execute();
    }
}