<?php

namespace Tleckie\Di\Definition\Handler;

/**
 * Class NumericHandler
 *
 * @package Tleckie\Di\Handler\Handler
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class NumericHandler extends Handler
{
    /**
     * @param $value
     * @return mixed
     */
    public function handle($value): mixed
    {
        if (is_numeric($value)) {
            return $value;
        }

        return parent::handle($value);
    }
}
