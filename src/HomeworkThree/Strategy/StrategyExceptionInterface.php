<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkThree\Strategy;

use Sapronovps\OtusHomework\HomeworkThree\Dto\CommandDto;
use Throwable;

interface StrategyExceptionInterface
{
    public function run(Throwable $exception, CommandDto $commandDto): void;
}