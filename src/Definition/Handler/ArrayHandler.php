<?php

namespace Tleckie\Di\Definition\Handler;

/**
 * Class ArrayHandler
 *
 * @package Tleckie\Di\Handler\Handler
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class ArrayHandler extends Handler
{
    /**
     * @param $value
     * @return mixed
     */
    public function handle($value): mixed
    {
        if (is_array($value) && !isset($value['className'])) {
            return $this->resolveParams($value);
        }

        return parent::handle($value);
    }
}
