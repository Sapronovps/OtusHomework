<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkEleven;

class CheckCollisionsOfGameObjectsCommand extends AbstractGameObjectHandler
{
    public function next(PlayingFieldsDto $playingFieldsDto): null|bool|GameObjectHandlerInterface
    {
        $gameObjectGroupByNeighborhood = [];

        foreach ($playingFieldsDto->playingFieldsDto as $playingFieldDto) {
            foreach ($playingFieldDto->gameObjects as $gameObject) {
                $gameObjectGroupByNeighborhood[$playingFieldDto->id][$gameObject->position][] = $gameObject->name;
            }
        }

        foreach ($playingFieldsDto->playingFieldsDto as $playingFieldDto) {
            foreach ($playingFieldDto->gameObjects as $gameObject) {
                if (
                    isset($gameObjectGroupByNeighborhood[$playingFieldDto->id][$gameObject->position])
                    && count($gameObjectGroupByNeighborhood[$playingFieldDto->id][$gameObject->position]) > 1
                ) {
                    // Есть коллизии объектов, возвращаем false
                    return false;
                }
            }
        }


        return parent::next($playingFieldsDto);
    }
}