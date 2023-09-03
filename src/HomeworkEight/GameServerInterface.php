<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkEight;

/**
 * Интерфейс игрового сервера.
 */
interface GameServerInterface
{
    /**
     * Регистрация игры.
     *
     * @param array $group
     * @return int ID группы
     */
    public function registerGame(array $group): int;

    /**
     * Авторизация под пользователем.
     *
     * @param string $login
     * @return string JWT
     */
    public function logInAsUser(string $login): string;

    /**
     * Запуск игры с проверкой доступов по JWT
     *
     * @param string $jwt
     * @return void
     */
    public function play(string $jwt): void;

    /**
     * Получение декодированного JWT.
     *
     * @param string $jwt
     * @return array
     */
    public function decodeJwt(string $jwt): array;
}