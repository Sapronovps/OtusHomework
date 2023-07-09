<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkFour\Command;

use Sapronovps\OtusHomework\HomeworkTwo\Command\CommandInterface;

final class MacroCommand implements CommandInterface
{
    /**
     * @param CommandInterface[] $commands
     */
    public function __construct(private readonly array $commands)
    {
    }

    public function execute(): void
    {
        foreach ($this->commands as $command) {
            $command->execute();
        }
    }
}