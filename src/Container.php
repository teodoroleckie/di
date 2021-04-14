<?php

namespace Tleckie\Di;

use Closure;
use Psr\Container\NotFoundExceptionInterface;
use Tleckie\Di\Definition\Adapter\AdapterInterface;
use Tleckie\Di\Definition\Definition;
use Tleckie\Di\Definition\Handler\ArrayHandler;
use Tleckie\Di\Definition\Handler\ClosureHandler;
use Tleckie\Di\Definition\Handler\HandlerInterface;
use Tleckie\Di\Definition\Handler\InstanceHandler;
use Tleckie\Di\Definition\Handler\NumericHandler;
use Tleckie\Di\Definition\Handler\ObjectHandler;
use Tleckie\Di\Definition\Handler\StringHandler;

/**
 * Class Container
 *
 * @package Tleckie\Di
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class Container implements DiInterface
{
    /** @var array */
    private array $definitions = [];

    /** @var array */
    private array $indexed = [];

    /** @var HandlerInterface|null */
    private HandlerInterface|null $handler = null;

    /**
     * Container constructor.
     */
    public function __construct()
    {
        $handler = new StringHandler($this);

        $handler
            ->next(new NumericHandler($this))
            ->next(new InstanceHandler($this))
            ->next(new ClosureHandler($this))
            ->next(new ObjectHandler($this))
            ->next(new ArrayHandler($this));

        $this->changeHandler($handler);
    }

    /**
     * @param HandlerInterface $handler
     * @return DiInterface
     */
    public function changeHandler(HandlerInterface $handler): DiInterface
    {
        $this->handler = $handler;

        return $this;
    }

    /**
     * @return HandlerInterface|null
     */
    public function handler(): ?HandlerInterface
    {
        return $this->handler;
    }

    /**
     * @param AdapterInterface $adapter
     * @return DiInterface
     */
    public function setAdapter(AdapterInterface $adapter): DiInterface
    {
        $this->definitions = $adapter->load();

        return $this;
    }


    /**
     * @param string $id
     * @return mixed
     * @throws NotFoundExceptionInterface
     */
    public function get(string $id): mixed
    {
        if (isset($this->indexed[$id])) {
            return $this->indexed[$id];
        }

        if (!$this->has($id)) {
            return $this->indexed[$id] = $id;
        }

        $value = $this->handler->handle($this->definitions[$id]);
        if (!$value instanceof Closure) {
            $this->indexed[$id] = $value;

            return $value;
        }

        return $value();
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has(string $id): bool
    {
        return isset($this->definitions[$id]);
    }
}
