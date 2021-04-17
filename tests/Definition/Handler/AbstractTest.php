<?php

namespace Tleckie\Di\Tests\Definition\Handler;

use PHPUnit\Framework\TestCase;
use Tleckie\Di\Di;

/**
 * Class AbstractTest
 *
 * @package Tleckie\Di\Tests\Definition\Handler
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
abstract class AbstractTest extends TestCase
{
    /** @var Di|MockObject */
    protected Di|MockObject $diMock;

    public function setUp(): void
    {
        $this->diMock = $this->createMock(Di::class);
    }
}

class AbstractClass
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

class A extends AbstractClass
{
}

class B extends AbstractClass
{
}
