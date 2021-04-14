<?php

namespace Tleckie\Di\Definition\Handler;

/**
 * Interface HandlerInterface
 *
 * @package Tleckie\Di\Handler\Handler
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
interface HandlerInterface
{
    /**
     * @param HandlerInterface $definition
     * @return HandlerInterface
     */
    public function next(HandlerInterface $definition): HandlerInterface;

    /**
     * @param $value
     * @return mixed
     */
    public function handle($value): mixed;
}
