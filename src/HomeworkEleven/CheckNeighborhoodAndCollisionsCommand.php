<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkEleven;

class CheckNeighborhoodAndCollisionsCommand implements CommandInterface
{
    public function execute(PlayingFieldsDto $playingFieldsDto): void
    {
        $checkNeighborhoodCommand = new CheckNeighborhoodCommand();
        $checkNeighborhoodCommand->setNext(new CheckCollisionsOfGameObjectsCommand());

        while (null !== $checkNeighborhoodCommand->next($playingFieldsDto)) {

        }
    }
}