<?php

namespace Tleckie\Di\Definition\Handler;

use ReflectionException;
use Tleckie\Di\Exception\ContainerException;

/**
 * Class InstanceHandler
 *
 * @package Tleckie\Di\Handler\Handler
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class InstanceHandler extends Handler
{
    /**
     * @param $value
     * @return mixed
     * @throws ContainerException
     */
    public function handle($value): mixed
    {
        if (is_array($value) && isset($value['className'])) {
            try {
                $object = $this->createInstance($value['className'], $value['arguments'] ?? []);
                foreach ($value['methods'] ?? [] as $method) {
                    $this->callMethod($object, $method['methodName'], $method['arguments'] ?? []);
                }
            } catch (ReflectionException $exception) {
                throw new ContainerException($exception->getMessage());
            }

            return $object;
        }

        return parent::handle($value);
    }
}
