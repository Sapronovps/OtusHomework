<?php

declare(strict_types=1);

namespace Sapronovps\OtusHomework\HomeworkSix;

use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionParameter;
use Sapronovps\OtusHomework\HomeworkFive\IoC;

/**
 * Генерация класса PHP динамически на основании существующего класса или контракта.
 */
class AutoGenerateClass implements AutoGenerateClassInterface
{
    private ReflectionClass $reflectionClass;

    /**
     * @param mixed  $object
     * @param string $prefixClass
     * @throws ReflectionException
     */
    public function __construct(private readonly mixed $object, private readonly string $prefixClass = 'AutoGenerated')
    {
        $this->reflectionClass = new ReflectionClass($this->object);
    }

    /**
     * Генерация PHP класса на основании существующего класса или контракта.
     *
     * @return string
     */
    public function generateClassStr(): string
    {
        $newClassName = $this->prefixClass . $this->getClassName();
        $uses = $this->getUses();
        $methodsStr = $this->getMethodsStr();

        return "
            $uses;
        
            class $newClassName 
            {
              public function __construct(private readonly object \$object, private readonly IoC \$ioC)
              {
              }
            
              $methodsStr
            }
        ";
    }

    /**
     * Возвращает методы в строке.
     *
     * @return string
     */
    private function getMethodsStr(): string
    {
        $methods = $this->reflectionClass->getMethods();
        $methodsStr = '';

        foreach ($methods as $method) {
            $methodParameters = $this->getMethodParameters($method);
            $methodName = $method->getName();
            $methodNameWithParameters = $methodName . '(' . $methodParameters . ')';
            $methodAccessModifier = $this->getMethodAccessModifier($method);
            $methodReturnType = $this->getMethodReturnType($method);

            if ($this->isMethodGet($method)) {
                $methodBody = 'return $this->ioC->resolve($this->object::class . \'' . $methodName . '\', $this->object);';
            } else {
                $methodBody = '$this->ioC->resolve($this->object::class . \'' . $methodName .  '\', $this->object, $vector);';
            }

            $methodsStr .= " $methodAccessModifier function " . $methodNameWithParameters . ": $methodReturnType" .  "{
                $methodBody
             }";
        }

        return $methodsStr;
    }

    /**
     * Возвращает название класса.
     *
     * @return string
     */
    private function getClassName(): string
    {
        $className = $this->reflectionClass->getName();

        $className = explode('\\', $className);

        return array_pop($className);
    }

    /**
     * Возвращает модификатор доступа метода.
     *
     * @param ReflectionMethod $method
     * @return string
     */
    private function getMethodAccessModifier(ReflectionMethod $method): string
    {
        $methodAccessModifier = 'public';

        if ($method->isProtected()) {
            $methodAccessModifier = 'protected';
        }

        if ($method->isPrivate()) {
            $methodAccessModifier = 'private';
        }

        return $methodAccessModifier;
    }

    /**
     * Возвращает тип возвращаемого значения метода.
     *
     * @param ReflectionMethod $method
     * @return string
     */
    private function getMethodReturnType(ReflectionMethod $method): string
    {
        $methodReturnType = $method->getReturnType()?->getName() ?? '';
        $methodReturnType = explode('\\', $methodReturnType);

        return array_pop($methodReturnType);
    }

    /**
     * Метод на получение данных?
     *
     * @param ReflectionMethod $method
     * @return bool
     */
    private function isMethodGet(ReflectionMethod $method): bool
    {
        $methodName = $method->getName();

        return str_starts_with($methodName, 'get');
    }

    /**
     * Возвращает параметры метода в виде строки.
     *
     * @param ReflectionMethod $method
     * @return string
     */
    private function getMethodParameters(ReflectionMethod $method): string
    {
        $methodParameters = '';

        foreach ($method->getParameters() as $parameter) {
            $methodParameters .= $this->getParameterType($parameter) . ' $' . $parameter->getName() . ', ';
        }

        return substr($methodParameters, 0,-2);
    }

    /**
     * Возвращает ТИП параметра.
     *
     * @param ReflectionParameter $parameter
     * @return string
     */
    private function getParameterType(ReflectionParameter $parameter): string
    {
        $parameterType = $parameter->getType()?->getName() ?? '';
        $parameterType = explode('\\', $parameterType);

        return array_pop($parameterType);
    }

    /**
     * Возвращает зависимости в use;
     *
     * @return string
     */
    private function getUses(): string
    {
        $reflectionClass = new ReflectionClass(IoC::class);

        $uses = 'use ' . $reflectionClass->getName() . '; ';

        foreach ($this->reflectionClass->getMethods() as $method) {
            foreach ($method->getParameters() as $parameter) {
                $parameterType = $parameter->getType()?->getName()?? '';

                if ('' !== $parameterType) {
                    $uses .= ' use ' . $parameterType . '; ';
                }
            }
        }

        return $uses;
    }
}