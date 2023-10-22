<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\FinalWork\Core\Interface;

interface CommandInterface
{
    public function execute(): void;
}