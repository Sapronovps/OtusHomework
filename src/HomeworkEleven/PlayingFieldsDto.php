<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkEleven;

/**
 * ДТО для хранения игровых полей.
 */
final class PlayingFieldsDto
{
    /**
     * @param PlayingFieldDto[] $playingFieldsDto
     */
    public function __construct(public array $playingFieldsDto)
    {
    }
}