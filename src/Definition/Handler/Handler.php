<?php

namespace Tleckie\Di\Definition\Handler;

use ReflectionClass;
use ReflectionException;
use Tleckie\Di\DiInterface;
use function call_user_func_array;

/**
 * Class Handler
 *
 * @package Tleckie\Di\Handler\Handler
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class Handler implements HandlerInterface
{
    /** @var HandlerInterface|null */
    protected HandlerInterface|null $next = null;

    /** @var DiInterface */
    protected DiInterface $di;

    /**
     * Handler constructor.
     *
     * @param DiInterface $di
     */
    public function __construct(DiInterface $di)
    {
        $this->di = $di;
    }

    /**
     * @param HandlerInterface $definition
     * @return HandlerInterface
     */
    public function next(HandlerInterface $definition): HandlerInterface
    {
        $this->next = $definition;

        return $definition;
    }

    /**
     * @param $value
     * @return mixed
     */
    public function handle($value): mixed
    {
        if ($this->next instanceof HandlerInterface) {
            return $this->next->handle($value);
        }

        return $value;
    }

    /**
     * @param string $className
     * @param array  $arguments
     * @return object
     * @throws ReflectionException
     */
    protected function createInstance(string $className, array $arguments): object
    {
        return (new ReflectionClass($className))
            ->newInstanceArgs($this->resolveParams($arguments));
    }

    /**
     * @param array $params
     * @return array
     */
    protected function resolveParams(array $params): array
    {
        $di = $this->di;

        return $this->recursiveArrayMap(static function ($param) use ($di) {
            if ($di->handler()) {
                return $di->handler()->handle($param);
            }

            return $param;
        }, $params);
    }

    /**
     * @param $callback
     * @param $input
     * @return array
     */
    private function recursiveArrayMap($callback, $input): array
    {
        $output = [];
        foreach ($input as $key => $data) {
            $output[$key] = (is_array($data)) ?
                $this->recursiveArrayMap($callback, $data) :
                $callback($data);
        }

        return $output;
    }

    /**
     * @param object $object
     * @param string $methodName
     * @param array  $arguments
     */
    protected function callMethod(object $object, string $methodName, array $arguments): void
    {
        call_user_func_array(
            [$object, $methodName],
            $this->resolveParams($arguments)
        );
    }
}
