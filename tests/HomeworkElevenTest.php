<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sapronovps\OtusHomework\HomeworkEleven\CheckNeighborhoodAndCollisionsCommand;
use Sapronovps\OtusHomework\HomeworkEleven\GameObjectDto;
use Sapronovps\OtusHomework\HomeworkEleven\PlayingFieldDto;
use Sapronovps\OtusHomework\HomeworkEleven\PlayingFieldsDto;

class HomeworkElevenTest extends TestCase
{
    /**
     * Тест проверяет ситуацию, когда не были инициализированы игровые поля.
     *
     * @return void
     */
    public function testOne(): void
    {
        $playingFieldsDto = new PlayingFieldsDto([]);

        $checkNeighborhoodAndCollisionsCommand = new CheckNeighborhoodAndCollisionsCommand();
        $checkNeighborhoodAndCollisionsCommand->execute($playingFieldsDto);

        $this->assertEquals(
            [],
            $playingFieldsDto->playingFieldsDto,
            'Неверно отработала команда CheckNeighborhoodAndCollisionsCommand.'
        );
    }

    /**
     * Тест проверяет ситуацию, когда в одном игровом поле есть коллизии.
     *
     * @return void
     */
    public function testTwo(): void
    {
        $gameObject1 = new GameObjectDto('Pasha', 1);
        $gameObject2 = new GameObjectDto('Sasha', 1);
        $gameObject3 = new GameObjectDto('Dima', 1);
        $gameObject4 = new GameObjectDto('Anton', 1);

        $playingField = new PlayingFieldDto(1, [$gameObject1, $gameObject2, $gameObject3, $gameObject4]);
        $playingFields = new PlayingFieldsDto([$playingField]);

        $checkNeighborhoodAndCollisionsCommand = new CheckNeighborhoodAndCollisionsCommand();
        $checkNeighborhoodAndCollisionsCommand->execute($playingFields);

        $expectedResult = [
          1 => 'Anton - 1',
          2 => 'Dima - 1',
          3 => 'Sasha - 1',
          4 => 'Pasha - 1',
        ];

        $actualResult = [];

        foreach ($playingFields->playingFieldsDto as $playingFieldDto) {
            foreach ($playingFieldDto->gameObjects as $gameObject) {
                $actualResult[$playingFieldDto->id] = $gameObject->name . ' - ' . $gameObject->position;
            }
        }

        $this->assertEquals(
            $expectedResult,
            $actualResult,
            'Команда решения окрестностей CheckNeighborhoodCommand отработала неверно.'
        );
    }

    /**
     * Тест проверяет ситуацию, когда в одном игровом поле нет коллизий.
     *
     * @return void
     */
    public function testThree(): void
    {
        $gameObject1 = new GameObjectDto('Pasha', 1);
        $gameObject2 = new GameObjectDto('Sasha', 2);
        $gameObject3 = new GameObjectDto('Dima', 3);
        $gameObject4 = new GameObjectDto('Anton', 4);

        $playingField = new PlayingFieldDto(1, [$gameObject1, $gameObject2, $gameObject3, $gameObject4]);
        $playingFields = new PlayingFieldsDto([$playingField]);

        $checkNeighborhoodAndCollisionsCommand = new CheckNeighborhoodAndCollisionsCommand();
        $checkNeighborhoodAndCollisionsCommand->execute($playingFields);

        $expectedResult = [
            1 => [
                'Pasha - 1',
                'Sasha - 2',
                'Dima - 3',
                'Anton - 4',
            ]
        ];

        $actualResult = [];

        foreach ($playingFields->playingFieldsDto as $playingFieldDto) {
            foreach ($playingFieldDto->gameObjects as $gameObject) {
                $actualResult[$playingFieldDto->id][] = $gameObject->name . ' - ' . $gameObject->position;
            }
        }

        $this->assertEqualsCanonicalizing(
            $expectedResult,
            $actualResult,
            'Команда решения окрестностей CheckNeighborhoodCommand отработала неверно.'
        );
    }
}