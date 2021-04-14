<?php

namespace Tleckie\Di\Definition\Adapter;

/**
 * Interface AdapterInterface
 *
 * @package Tleckie\Di\Handler\Adapter
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
interface AdapterInterface
{
    /**
     * @return array
     */
    public function load(): array;
}
