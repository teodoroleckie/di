<?php

namespace Tleckie\Di\Tests\Definition\Handler;

use Tleckie\Di\Definition\Handler\ObjectHandler;

/**
 * Class ObjectHandlerTest
 *
 * @package Tleckie\Di\Tests\Definition\Handler
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class ObjectHandlerTest extends AbstractTest
{
    /**
     * @test
     */
    public function object(): void
    {
        $object = new class() {
        };

        $handler = new ObjectHandler($this->diMock);

        static::assertEquals($object, $handler->handle($object));

        $handler = new ObjectHandler($this->diMock);

        static::assertEquals('string', $handler->handle('string'));
    }
}
