<?php

namespace Tleckie\Di\Definition\Adapter;

use InvalidArgumentException;

/**
 * Class ArrayAdapter
 *
 * @package Tleckie\Di\Handler\Adapter
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class ArrayAdapter implements AdapterInterface
{
    /** @var array */
    private array $array;

    /**
     * ArrayAdapter constructor.
     *
     * @param array $array
     */
    public function __construct(array $array)
    {
        $this->array = $array;
    }

    /**
     * @return array
     * @throws InvalidArgumentException
     */
    public function load(): array
    {
        return $this->array;
    }
}
