<?php

namespace Tleckie\Di\Tests\Definition\Handler;

use Tleckie\Di\Definition\Handler\ClosureHandler;

/**
 * Class ClosureHandlerTest
 *
 * @package Tleckie\Di\Tests\Definition\Handler
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class ClosureHandlerTest extends AbstractTest
{
    /**
     * @test
     */
    public function instance(): void
    {
        $closure = static function () {
            return 'return value';
        };

        $handler = new ClosureHandler($this->diMock);
        static::assertEquals($closure, $handler->handle($closure));
        static::assertEquals(55.22, $handler->handle(55.22));
    }
}
