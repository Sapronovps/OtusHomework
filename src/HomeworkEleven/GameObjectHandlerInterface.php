<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkEleven;

interface GameObjectHandlerInterface
{
    public function setNext(GameObjectHandlerInterface $handler): GameObjectHandlerInterface;

    public function next(PlayingFieldsDto $playingFieldsDto): null|bool|GameObjectHandlerInterface;
}