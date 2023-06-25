<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sapronovps\OtusHomework\HomeworkOne\HomeworkOne;

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

    /**
     * Тест когда дискриминант получился меньше чем -epsilon.
     *
     * @return void
     * @throws Exception
     */
    public function testSix(): void
    {
        $calculator = new HomeworkOne();

        $double = $calculator->solve(0.00000000001, 0, 1);

        $this->assertNull($double->x1, 'Тест когда дискриминант получился меньше чем -epsilon не прошел.');
        $this->assertNull($double->x2, 'Тест когда дискриминант получился меньше чем -epsilon0 не прошел.');
    }

    /**
     * Тест когда a больше чем epsilon.
     *
     * @return void
     * @throws Exception
     */
    public function testSeven(): void
    {
        $calculator = new HomeworkOne();

        try {
            $calculator->solve(0.0000000000000000000001, 2, 1);
        } catch (Exception $ex) {
            $this->assertEquals('a не равно 0', $ex->getMessage(), 'Тест когда a = 0 не прошел.');
        }
    }

    /**
     * Тест когда a float, но не больше чем epsilon.
     *
     * @return void
     * @throws Exception
     */
    public function testEight(): void
    {
        $calculator = new HomeworkOne();

        $double = $calculator->solve(0.001, 0.2, 0.1);

        $this->assertEqualsWithDelta(-0.501256289338, $double->x1, 0.0000001, 'Тест когда a float, но не больше чем epsilon не прошел.');
        $this->assertEqualsWithDelta(-199.49874371066, $double->x2, 0.0000001, 'Тест когда a float, но не больше чем epsilon не прошел.');
    }

    /**
     * Тест x^2+12x+36=0 (когда 1 корень)
     *
     * @return void
     * @throws Exception
     */
    public function testNine(): void
    {
        $calculator = new HomeworkOne();

        $double = $calculator->solve(1, 12, 36);

        $this->assertEquals(-6, $double->x1, 'Тест для x^2+12x+36=0 не прошел.');
        $this->assertEquals(-6, $double->x2, 'Тест для x^2+12x+36=0 не прошел.');
    }

    /**
     * Тест когда a === NAN (не число)
     *
     * @return void
     * @throws Exception
     */
    public function testTen(): void
    {
        $calculator = new HomeworkOne();

        try {
            $calculator->solve(log(-1), 2, 1);
        } catch (Exception $ex) {
            $this->assertEquals('a не число', $ex->getMessage(), 'Тест когда a === NAN не прошел.');
        }
    }

    /**
     * Тест когда b === NAN (не число)
     *
     * @return void
     * @throws Exception
     */
    public function testEleven(): void
    {
        $calculator = new HomeworkOne();

        try {
            $calculator->solve(1, log(-1), 1);
        } catch (Exception $ex) {
            $this->assertEquals('b не число', $ex->getMessage(), 'Тест когда b === NAN не прошел.');
        }
    }

    /**
     * Тест когда c === NAN (не число)
     *
     * @return void
     * @throws Exception
     */
    public function testTwelve(): void
    {
        $calculator = new HomeworkOne();

        try {
            $calculator->solve(1, 2, log(-1));
        } catch (Exception $ex) {
            $this->assertEquals('c не число', $ex->getMessage(), 'Тест когда c === NAN не прошел.');
        }
    }
}