<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkEight;

/**
 * Интерфейс сервиса авторизации.
 */
interface AuthServiceInterface
{
    /**
     * Регистрация группы пользователей.
     *
     * @param array $group
     * @return int
     */
    public function registerGroup(array $group): int;

    /**
     * Создание Json Web Token.
     *
     * @param array  $data
     * @param string $key
     * @return string
     */
    public function createJwt(array $data, string $key): string;

    /**
     * Декодирование Json Web Token в массив с проверкой подписи.
     *
     * @param string $jwt
     * @param string $key
     * @return array
     */
    public function decodeJwt(string $jwt, string $key): array;
}