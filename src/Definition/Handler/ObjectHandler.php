<?php

namespace Tleckie\Di\Definition\Handler;

/**
 * Class ObjectHandler
 *
 * @package Tleckie\Di\Handler\Handler
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class ObjectHandler extends Handler
{
    /**
     * @param $value
     * @return mixed
     */
    public function handle($value): mixed
    {
        if (is_object($value)) {
            return $value;
        }

        return parent::handle($value);
    }
}
