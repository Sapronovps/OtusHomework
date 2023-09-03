<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkEight;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * Сервис авторизации.
 */
class AuthService implements AuthServiceInterface
{
    /** @var string Алгоритм хэширования */
    private const ALGORITHM = 'HS256';

    /** @var array Зарегистрированные группы пользователей */
    private array $groups = [];

    /**
     * Регистрация группы пользователей.
     *
     * @param array $group
     * @return int
     */
    public function registerGroup(array $group): int
    {
        $this->groups[] = $group;

        return count($this->groups) - 1;
    }

    /**
     * Создание Json Web Token.
     *
     * @param array  $data
     * @param string $key
     * @return string
     * @throws Exception
     */
    public function createJwt(array $data, string $key): string
    {
        $groupId = $data['groupId'];
        $userName = $data['name'];

        if (false === isset($this->groups[$groupId])) {
            throw new Exception('Группа с ID ' . $groupId . ' не существует');
        }

        if (false === in_array($userName, $this->groups[$groupId], true)) {
            throw new Exception('Пользователя с именем ' . $userName . ' нет в группе с ID ' . $groupId);
        }

        $payload = [
            'iss' => 'auth-otus.ru',
            'aud' => 'tank-otus.ru',
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + 5,
            'data' => $data
        ];

        return JWT::encode($payload, $key, self::ALGORITHM);
    }

    /**
     * Декодирование Json Web Token в массив с проверкой подписи.
     *
     * @param string $jwt
     * @param string $key
     * @return array
     */
    public function decodeJwt(string $jwt, string $key): array
    {
        return (array)JWT::decode($jwt, new Key($key, self::ALGORITHM));
    }
}