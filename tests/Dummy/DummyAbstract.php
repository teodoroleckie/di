<?php

namespace Tleckie\Di\Tests\Dummy;

class DummyAbstract
{
    private mixed $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function changeValue($value): void
    {
        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }
}
