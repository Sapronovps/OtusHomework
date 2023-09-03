<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkEight;

use Exception;

/**
 * Игровой сервер.
 */
class GameServer implements GameServerInterface
{
    /** @var int Идентификатор группы */
    private int $groupId;

    /** @var string Ключ для хэширования */
    private string $key = 'tank-otus';

    /** @var array Список игроков */
    private array $group = [];

    public function __construct(private readonly AuthService $authService = new AuthService())
    {
    }

    /**
     * Регистрвция игры.
     *
     * @param array $group
     * @return int
     */
    public function registerGame(array $group): int
    {
        $this->group = $group;
        $this->groupId = $this->authService->registerGroup($group);

        return $this->groupId;
    }

    /**
     * Авторизация под пользователем.
     *
     * @param string $login
     * @return string
     * @throws Exception
     */
    public function logInAsUser(string $login): string
    {
        return $this->authService->createJwt(
            [
                'groupId' => $this->groupId,
                'name' => $login
            ],
            $this->key
        );
    }

    /**
     * Запуск игры с проверкой доступов по JWT.
     *
     * @param string $jwt
     * @return void
     * @throws Exception
     */
    public function play(string $jwt): void
    {
       $this->verify($jwt);

       // Далее запускается игра
    }

    /**
     * Получение декодированного JWT.
     *
     * @param string $jwt
     * @return array
     */
    public function decodeJwt(string $jwt): array
    {
        return $this->authService->decodeJwt($jwt, $this->key);
    }

    /**
     * Проверка авторизованности пользователя.
     *
     * @param string $jwt
     * @return void
     * @throws Exception
     */
    private function verify(string $jwt): void
    {
        $payload = $this->decodeJwt($jwt);
        $userName = $payload['data']->name;

        if (false === in_array($userName, $this->group, true)) {
            throw new Exception('У вас нет доступа к игре.');
        }
    }
}