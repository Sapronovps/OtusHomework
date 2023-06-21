<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework;

use Exception;
use Sapronovps\OtusHomework\Dto\DoubleResult;

/**
 * Otus - первое домашнее задание.
 */
final class HomeworkOne
{
    /**
     * Решение квадртного уравнения с помощью дискриминанта.
     *
     * @param float $a
     * @param float $b
     * @param float $c
     * @return DoubleResult
     * @throws Exception
     */
    public function solve(float $a, float $b, float $c): DoubleResult
    {
        if (true === is_nan($a)) {
            throw new Exception('a не число');
        }

        if (true === is_nan($b)) {
            throw new Exception('b не число');
        }

        if (true === is_nan($c)) {
            throw new Exception('c не число');
        }

        if (abs($a) <= PHP_FLOAT_EPSILON) {
            throw new Exception('a не равно 0');
        }

        $D = $b * $b - 4 * $a * $c;

        if ($D < -PHP_FLOAT_EPSILON) {
            return new DoubleResult();
        }

        if (abs($D) <= PHP_FLOAT_EPSILON) {
            return new DoubleResult(
                x1: -$b / (2 * $a),
                x2: -$b / (2 * $a)
            );
        }

        if ($D > PHP_FLOAT_EPSILON) {
            return new DoubleResult(
                x1: (-$b + sqrt($D)) / (2 * $a),
                x2: (-$b - sqrt($D)) / (2 * $a)
            );
        }

        return new DoubleResult();
    }
}