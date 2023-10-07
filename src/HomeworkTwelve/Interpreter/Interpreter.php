<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkTwelve\Interpreter;

use ReflectionClass;
use ReflectionException;
use Sapronovps\OtusHomework\HomeworkFive\IoC;
use Sapronovps\OtusHomework\HomeworkTwelve\Exception\InterpretException;

/**
 * Интерпретатор заказов действий над игровым объектом.
 */
class Interpreter implements InterpreterInterface
{
    public function __construct(
        private int $gameId,
        private IoC $ioC
    )
    {
    }

    /**
     * Основное действие интерпретации.
     *
     * @param object $order
     * @return mixed
     * @throws InterpretException
     * @throws ReflectionException
     */
    public function interpret(object $order): mixed
    {
        // Получим действие
        if (!isset($order->action)) {
            throw new InterpretException('Action не найден.');
        }
        $actionName = $order->action;
        $action = $this->ioC->resolve($actionName . 'Types.Get');

        // Проверим наличие игры в скоупе, что приказ направлен только на разрешенный игровой объект
        if (!isset($order->id)) {
            throw new InterpretException('Id игры не найден.');
        }
        $id = $order->id;
        $gameObject = $this->ioC->resolve($id .':' . $this->gameId . ':Objects.Get');

        $actionClass = $action::class;
        $reflectionClass = new ReflectionClass($actionClass);

        $parameters = [];

        foreach ($reflectionClass->getConstructor()?->getParameters() as $parameter) {
            $parameterName = $parameter->getName();

            if ('object' === $parameterName) {
                $parameters[] = $gameObject;
            }

            if (isset($order->{$parameterName})) {
                $parameters[] = $order->{$parameterName};
            }
        }

        return new $actionClass(...$parameters);
    }
}