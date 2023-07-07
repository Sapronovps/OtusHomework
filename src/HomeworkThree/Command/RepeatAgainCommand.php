<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkThree\Command;

use Sapronovps\OtusHomework\HomeworkThree\Dto\CommandDto;
use Sapronovps\OtusHomework\HomeworkTwo\Command\CommandInterface;

/**
 * Команда, которая повторяет команду выбросившую исключение.
 */
final class RepeatAgainCommand implements CommandInterface
{
    private static array $repeatedCommands = [];

    public function __construct(private readonly CommandDto $commandDto)
    {
    }

    public function execute(): void
    {
        $commandDto = new CommandDto(
            command: $this->commandDto->command,
            countOfAttempts: $this->commandDto->countOfAttempts + 1
        );

        QueueCommand::addCommand($commandDto);
        self::$repeatedCommands[] = $commandDto->command::class;
    }

    public static function getRepeatedCommands(): array
    {
        return self::$repeatedCommands;
    }

    public static function clearStaticCache(): void
    {
        self::$repeatedCommands = [];
    }
}