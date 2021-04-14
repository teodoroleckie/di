<?php

namespace Tleckie\Di\Tests\Definition\Handler;

use Tleckie\Di\Definition\Handler\Handler;
use Tleckie\Di\Definition\Handler\StringHandler;

/**
 * Class StringHandlerTest
 *
 * @package Tleckie\Di\Tests\Definition\Handler
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class StringHandlerTest extends AbstractTest
{
    /**
     * @test
     */
    public function instance(): void
    {
        $definition = [
            'sameString' => 'same string',
            'otherString' => 'other string',
        ];

        $handler = new Handler($this->diMock);
        $handler->next(new StringHandler($this->diMock));

        $this->diMock
            ->expects(static::exactly(3))
            ->method('get')
            ->withConsecutive(['sameString'], ['otherString'], ['same value'], [3])
            ->willReturnOnConsecutiveCalls('same string', 'other string', 'same value');


        static::assertEquals('same string', $handler->handle('sameString'));
        static::assertEquals('other string', $handler->handle('otherString'));
        static::assertEquals('same value', $handler->handle('same value'));
        static::assertEquals(3, $handler->handle(3));
    }
}
