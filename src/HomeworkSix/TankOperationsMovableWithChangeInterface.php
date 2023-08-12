<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkSix;

interface TankOperationsMovableWithChangeInterface extends TankOperationsMovableInterface
{
    /**
     * Новый метод для контракта.
     *
     * @return void
     */
    public function finish(): void;
}