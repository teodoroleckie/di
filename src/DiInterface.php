<?php

namespace Tleckie\Di;

use Psr\Container\ContainerInterface;
use Tleckie\Di\Definition\Adapter\AdapterInterface;
use Tleckie\Di\Definition\Handler\HandlerInterface;

/**
 * Interface DiInterface
 *
 * @package Tleckie\Di
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
interface DiInterface extends ContainerInterface
{
    /**
     * @param HandlerInterface $handler
     * @return DiInterface
     */
    public function changeHandler(HandlerInterface $handler): DiInterface;

    /**
     * @return HandlerInterface|null
     */
    public function handler(): ?HandlerInterface;

    /**
     * @param AdapterInterface $adapter
     * @return DiInterface
     */
    public function setAdapter(AdapterInterface $adapter): DiInterface;
}
