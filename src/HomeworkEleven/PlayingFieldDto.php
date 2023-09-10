<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkEleven;

/**
 * Игровое поле с игровыми объектами
 */
final class PlayingFieldDto
{
    /**
     *
     * @param int   $id
     * @param GameObjectDto[] $gameObjects
     */
    public function __construct(
        public int   $id,
        public array $gameObjects
    )
    {
    }
}