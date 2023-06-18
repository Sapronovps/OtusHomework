<?php

declare(strict_types=1);

namespace Sapronovps\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use Sapronovps\OtusHomework\HomeworkOne;

class HomeworkOneTest extends TestCase
{
    /**
     * Тест x^2+1=0 (нет корней)
     *
     * @return void
     * @throws Exception
     */
    public function testOne(): void
    {
        $calculator = new HomeworkOne();

        $double = $calculator->solve(1, 0, 1);

        $this->assertNull($double->x1, 'Тест для x^2+1=0 не прошел.');
        $this->assertNull($double->x2, 'Тест для x^2+1=0 не прошел.');
    }

    /**
     * Тест x^2-1=0 (есть 2 корня -1;1)
     *
     * @return void
     * @throws Exception
     */
    public function testTwo(): void
    {
        $calculator = new HomeworkOne();

        $double = $calculator->solve(-1, 0, 1);

        $this->assertEquals(-1, $double->x1, 'Тест для x^2-1=0 не прошел.');
        $this->assertEquals(1, $double->x2, 'Тест для x^2-1=0 не прошел.');
    }

    /**
     * Тест минимальной реализации метода solve на примере x^2-4x-5=0
     *
     * @return void
     * @throws Exception
     */
    public function testThree(): void
    {
        $calculator = new HomeworkOne();

        $double = $calculator->solve(1, -4, -5);

        $this->assertEquals(5, $double->x1, 'Тест для x^2-4x-5=0 не прошел.');
        $this->assertEquals(-1, $double->x2, 'Тест для x^2-4x-5=0 не прошел.');
    }

    /**
     * Тест минимальной реализации метода solve на примере x^2+2x+1=0
     *
     * @return void
     * @throws Exception
     */
    public function testFour(): void
    {
        $calculator = new HomeworkOne();

        $double = $calculator->solve(1, 2, 1);

        $this->assertEquals(-1, $double->x1, 'Тест для x^2+2x+1=0 не прошел.');
        $this->assertEquals(-1, $double->x2, 'Тест для x^2+2x+1=0 не прошел.');
    }

    /**
     * Тест минимальной реализации метода solve когда a=0
     *
     * @return void
     * @throws Exception
     */
    public function testFive(): void
    {
        $calculator = new HomeworkOne();

        try {
            $calculator->solve(0, 2, 1);
        } catch (Exception $ex) {
            $this->assertEquals('a не равно 0', $ex->getMessage(), 'Тест когда a = 0 не прошел.');
        }
    }
}