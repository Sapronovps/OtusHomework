<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkEleven;

/**
 * Команда для проверки окрестностей
 */
class CheckNeighborhoodCommand extends AbstractGameObjectHandler
{
    public function next(PlayingFieldsDto $playingFieldsDto): null|bool|GameObjectHandlerInterface
    {
        /** Если игровых полей нет, тогда прерываем цепочку обязанностей */
        if ([] === $playingFieldsDto->playingFieldsDto) {
            return null;
        }

        $gameObjectGroupByNeighborhood = [];

        $idPlayingField = 0;
        foreach ($playingFieldsDto->playingFieldsDto as $playingFieldDto) {
            $idPlayingField = $playingFieldDto->id;
            foreach ($playingFieldDto->gameObjects as $gameObject) {
                $gameObjectGroupByNeighborhood[$playingFieldDto->id][$gameObject->position][] = $gameObject->name;
            }
        }

        $newPlayingField = new PlayingFieldDto(++$idPlayingField, []);

        foreach ($playingFieldsDto->playingFieldsDto as $playingFieldDto) {
            foreach ($playingFieldDto->gameObjects as $key => $gameObject) {
                if (
                    isset($gameObjectGroupByNeighborhood[$playingFieldDto->id][$gameObject->position])
                    && count($gameObjectGroupByNeighborhood[$playingFieldDto->id][$gameObject->position]) > 1
                ) {
                    array_shift($gameObjectGroupByNeighborhood[$playingFieldDto->id][$gameObject->position]);
                    $newPlayingField->gameObjects[] = $gameObject;
                    unset($playingFieldDto->gameObjects[$key]);
                }
            }
        }

        if ([] !== $newPlayingField->gameObjects) {
            $playingFieldsDto->playingFieldsDto[] = $newPlayingField;
        }

        /** Передаем обработку игровых полей дальше по цепочке обязанностей */
        return parent::next($playingFieldsDto);
    }
}