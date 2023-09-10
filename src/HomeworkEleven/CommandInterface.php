<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkEleven;

interface CommandInterface
{
    public function execute(PlayingFieldsDto $playingFieldsDto);
}