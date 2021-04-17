<?php

namespace Tleckie\Di\Definition\Handler;

use Closure;
/**
 * Class ClosureHandler
 *
 * @package Tleckie\Di\Handler\Handler
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class ClosureHandler extends Handler
{
    /**
     * @param $value
     * @return mixed
     */
    public function handle($value): mixed
    {
        if ($value instanceof Closure) {
            return $value();
        }

        return parent::handle($value);
    }

}
