<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkThree\Dto;

use Sapronovps\OtusHomework\HomeworkTwo\Command\CommandInterface;

final class CommandDto
{
    public function __construct(public readonly CommandInterface $command, public readonly int $countOfAttempts = 1)
    {
    }
}