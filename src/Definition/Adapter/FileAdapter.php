<?php

namespace Tleckie\Di\Definition\Adapter;

use InvalidArgumentException;

/**
 * Class FileAdapter
 *
 * @package Tleckie\Di\Handler\Adapter
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class FileAdapter implements AdapterInterface
{
    /** @var string */
    private string $file;

    /**
     * FileAdapter constructor.
     *
     * @param string $file
     */
    public function __construct(string $file)
    {
        $this->file = $file;
    }

    /**
     * @return array
     * @throws InvalidArgumentException
     */
    public function load(): array
    {
        if (!is_file($this->file)) {
            throw new InvalidArgumentException(
                sprintf('File [%s] not found', $this->file)
            );
        }

        return include $this->file;
    }
}
