<?php

namespace Tleckie\Di\Tests\Definition\Handler;

use Tleckie\Di\Definition\Handler\NumericHandler;

/**
 * Class NumericHandlerTest
 *
 * @package Tleckie\Di\Tests\Definition\Handler
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class NumericHandlerTest extends AbstractTest
{
    /**
     * @test
     */
    public function instance(): void
    {
        $definition = [
            'int' => 18,
            'float' => 55.22,
        ];

        $handler = new NumericHandler($this->diMock);

        static::assertEquals(18, $handler->handle($definition['int']));
        static::assertEquals(55.22, $handler->handle($definition['float']));
        static::assertEquals('same value', $handler->handle('same value'));
    }
}
