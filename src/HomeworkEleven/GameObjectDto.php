<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkEleven;

/**
 * ДТО игрового объекта
 */
final class GameObjectDto
{
    /**
     *
     * @param string $name
     * @param int    $position
     */
    public function __construct(
        public string $name,
        public int    $position,
    )
    {
    }
}