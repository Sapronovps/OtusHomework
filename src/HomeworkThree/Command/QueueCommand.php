<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkThree\Command;

use Sapronovps\OtusHomework\HomeworkThree\Dto\CommandDto;
use Sapronovps\OtusHomework\HomeworkThree\ExceptionHandler\ExceptionHandler;
use Sapronovps\OtusHomework\HomeworkThree\Strategy\StrategyExceptionInterface;
use Sapronovps\OtusHomework\HomeworkTwo\Command\CommandInterface;
use Throwable;

final class QueueCommand implements CommandInterface
{
    /** @var CommandDto[] очередь команд */
    private static array $queue = [];

    public function __construct(private readonly StrategyExceptionInterface $concreteStrategyException)
    {
    }

    public static function addCommand(CommandDto $commandDto): void
    {
        self::$queue[] = $commandDto;
    }

    public function execute(): void
    {
       while ([] !== self::$queue) {
           $this->executeIteration();
       }
    }

    private function executeIteration(): void
    {
        foreach (self::$queue as $key => $commandDto) {
            try {
                $command = $commandDto->command;
                $command->execute();
            } catch (Throwable $exception) {
                /** Обработчик под конкретные ошибки */
                ExceptionHandler::handle($exception, $command);

                /** Общая обработка ошибок */
                $this->concreteStrategyException->run($exception, $commandDto);
            } finally {
                unset(self::$queue[$key]);
            }
        }
    }
}