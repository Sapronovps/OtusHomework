<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkSeven;

interface ProcessableInterface
{
    public function canContinue(): bool;

    public function setCanContinue(bool $canContinue): void;

    public function getQueue(): BlockingCollection;

    public function setQueue(BlockingCollection $queue): void;

    public function process(callable $func);
}