<?php

namespace Tleckie\Di\Tests\Definition\Handler;

use Tleckie\Di\Definition\Handler\ArrayHandler;
use Tleckie\Di\Definition\Handler\ClosureHandler;
use Tleckie\Di\Definition\Handler\InstanceHandler;
use Tleckie\Di\Definition\Handler\NumericHandler;
use Tleckie\Di\Definition\Handler\ObjectHandler;
use Tleckie\Di\Definition\Handler\StringHandler;

/**
 * Class ArrayHandlerTest
 *
 * @package Tleckie\Di\Tests\Definition\Handler
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class ArrayHandlerTest extends AbstractTest
{
    /**
     * @test
     */
    public function instance(): void
    {
        $array = [
            'testKey' => [['value']],
            'testKey2' => [['testKey']],
        ];

        $expected = [
            'testKey' => [['value']],
            'testKey2' => [['value']],
        ];

        $handler = new StringHandler($this->diMock);

        $handler
            ->next(new NumericHandler($this->diMock))
            ->next(new InstanceHandler($this->diMock))
            ->next(new ClosureHandler($this->diMock))
            ->next(new ObjectHandler($this->diMock))
            ->next(new ArrayHandler($this->diMock));


        $this->diMock
            ->expects(static::exactly(2))
            ->method('get')
            ->withConsecutive(['value'], ['testKey'])
            ->willReturnOnConsecutiveCalls('value', 'value');

        $this->diMock
            ->method('handler')
            ->willReturn($handler);

        static::assertEquals($expected, $handler->handle($array));
    }

    /**
     * @test
     */
    public function notArray(): void
    {
        $handler = new ArrayHandler($this->diMock);

        static::assertEquals('value', $handler->handle('value'));
    }
}
