<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sapronovps\OtusHomework\HomeworkTwo\Adapter\MovableAdapter;
use Sapronovps\OtusHomework\HomeworkTwo\Command\MoveCommand;
use Sapronovps\OtusHomework\HomeworkTwo\Spaceship;
use Sapronovps\OtusHomework\HomeworkTwo\Vector;

class HomeworkTwoTest extends TestCase
{
    /**
     * Тест для объекта, находящегося в точке (12, 5) и движущегося со скоростью (-7, 3)
     * движение меняет положение объекта на (5, 8)
     *
     * @return void
     */
    public function testOne(): void
    {
        $position = new Vector(12, 5);
        $velocity = new Vector(-7, 3);

        $spaceship = new Spaceship(
            position: $position,
            velocity: $velocity
        );

        $movableAdapter = new MovableAdapter($spaceship);
        $moveCommand = new MoveCommand($movableAdapter);
        $moveCommand->execute();

        $this->assertEquals(
            (new Vector(5, 8)),
            $spaceship->position,
            'Тест не прошел: для объекта, находящегося в точке (12, 5) и движущегося со скоростью (-7, 3)
     * движение меняет положение объекта на (5, 8);');
    }

    /**
     * Тест - Попытка сдвинуть объект, у которого невозможно прочитать положение в пространстве, приводит к ошибке.
     *
     * @return void
     */
    public function testTwo(): void
    {
        $velocity = new Vector(-7, 3);
        $spaceship = new Spaceship(velocity: $velocity);

        try {
            $movableAdapter = new MovableAdapter($spaceship);
            $moveCommand = new MoveCommand($movableAdapter);
            $moveCommand->execute();
        } catch (Throwable $ex) {
            $expectedErrorMessage = 'Невозможно сдвинуть объект, неккоретная позиция.';
            $this->assertEquals($expectedErrorMessage, $ex->getMessage());
        }
    }

    /**
     * Тест - Попытка сдвинуть объект, у которого невозможно прочитать значение мгновенной скорости, приводит к ошибке.
     *
     * @return void
     */
    public function testThree(): void
    {
        $position = new Vector(12, 5);
        $spaceship = new Spaceship(position: $position);

        try {
            $movableAdapter = new MovableAdapter($spaceship);
            $moveCommand = new MoveCommand($movableAdapter);
            $moveCommand->execute();
        } catch (Throwable $ex) {
            $expectedErrorMessage = 'Невозможно сдвинуть объект, неккоретная мгновенная скорость.';
            $this->assertEquals(
                $expectedErrorMessage,
                $ex->getMessage(),
                'Тест не прошел: Попытка сдвинуть объект, у которого невозможно прочитать значение 
                мгновенной скорости, приводит к ошибке'
            );
        }
    }

    /**
     * Тест - Попытка сдвинуть объект, у которого невозможно изменить положение в пространстве, приводит к ошибке.
     *
     * @return void
     */
    public function testFour(): void
    {
        $position = new Vector(12, 5);
        $velocity = new Vector(-7, 3);
        $spaceship = new Spaceship(
            position: $position,
            velocity: $velocity
        );

        try {
            $newPosition = new Vector(log(-1), log(-1));

            $movableAdapter = new MovableAdapter($spaceship);
            $movableAdapter->setPosition($newPosition);

            $moveCommand = new MoveCommand($movableAdapter);
            $moveCommand->execute();
        } catch (Throwable $ex) {
            $expectedErrorMessage = 'Координата x не число';
            $this->assertEquals(
                $expectedErrorMessage,
                $ex->getMessage(),
                'Тест не прошел: Попытка сдвинуть объект, у которого невозможно изменить положение 
                в пространстве, приводит к ошибке');
        }
    }
}