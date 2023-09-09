<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkTen;

use Sapronovps\OtusHomework\HomeworkSeven\HardStopCommand;

class HardStopV2Command extends HardStopCommand implements ProcessorStateInterface
{
    public function next(ProcessorInterface $processor): ?ProcessorStateInterface
    {
        $this->changeState($processor, null);

        return null;
    }

    public function changeState(ProcessorInterface $processor, ?ProcessorStateInterface $state): void
    {
        $processor->changeState($state);
    }
}