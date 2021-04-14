<?php

namespace Tleckie\Di\Definition\Handler;

/**
 * Class ClosureHandler
 *
 * @package Tleckie\Di\Handler\Handler
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class StringHandler extends Handler
{
    /**
     * @param $value
     * @return mixed
     */
    public function handle($value): mixed
    {
        if (is_string($value)) {
            return $this->di->get($value);
        }

        return parent::handle($value);
    }
}
