<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sapronovps\OtusHomework\HomeworkEight\GameServer;

class HomeworkEightTest extends TestCase
{
    /**
     * Проверка позитивного теста создания группы, авторизации и выполнения действия игры с помощью сервиса авторизацц.
     *
     * @return void
     * @throws Exception
     */
    public function testOne(): void
    {
        $group = [
            'Pasha',
            'Sasha',
            'Viktor'
        ];

        $gameServer = new GameServer();
        $gameServer->registerGame($group);
        $jwt = $gameServer->logInAsUser('Pasha');
        $gameServer->play($jwt);

        $payload = $gameServer->decodeJwt($jwt);

        $this->assertEquals(['groupId' => 0, 'name' => 'Pasha'], (array)$payload['data'], 'Не удалось авторизоваться в игре.');
    }

    /**
     * Попытка авторизоваться поль пользователем, которого нет в группе.
     *
     * @return void
     */
    public function testTwo(): void
    {
        try {
            $group = [
                'Pasha',
                'Sasha',
                'Viktor'
            ];

            $gameServer = new GameServer();
            $gameServer->registerGame($group);
            $gameServer->logInAsUser('Pasha222');
        } catch (Throwable $ex) {
            $this->assertEquals(
                'Пользователя с именем Pasha222 нет в группе с ID 0',
                $ex->getMessage(),
                'Ошибка: удалось авторизоваться под пользователем, которого нет в группе.');
        }
    }

    /**
     * Попытка поиграть с некорректным json web token.
     *
     * @return void
     */
    public function testThree(): void
    {
        try {
            $group = [
                'Pasha',
                'Sasha',
                'Viktor'
            ];

            $gameServer = new GameServer();
            $gameServer->registerGame($group);
            $jwt = $gameServer->logInAsUser('Pasha');

            $gameServer->play($jwt . 'test');
        } catch (Throwable $ex) {
            $this->assertEquals(
                'Signature verification failed',
                $ex->getMessage(),
                'Ошибка: удалось играть в игру с неподписанным jwt.'
            );
        }
    }
}