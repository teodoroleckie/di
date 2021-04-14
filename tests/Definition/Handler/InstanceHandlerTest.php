<?php

namespace Tleckie\Di\Tests\Definition\Handler;

use Tleckie\Di\Definition\Handler\InstanceHandler;
use Tleckie\Di\Exception\ContainerException;

/**
 * Class InstanceHandlerTest
 *
 * @package Tleckie\Di\Tests\Definition\Handler
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class InstanceHandlerTest extends AbstractTest
{
    /**
     * @test
     */
    public function instance(): void
    {
        $definition = [
            'serviceA' => [
                'className' => A::class,
                'arguments' => ['Text Value'],
                'methods' => [
                    [
                        'methodName' => 'changeValue',
                        'arguments' => ['Changed Text']
                    ]
                ]
            ],
            'serviceB' => [
                'className' => B::class,
                'arguments' => ['Other Text'],
            ]
        ];

        $handler = new InstanceHandler($this->diMock);
        $service = $handler->handle($definition['serviceA']);

        static::assertInstanceOf(A::class, $service);
        static::assertEquals('Changed Text', $service->value());

        $handler = new InstanceHandler($this->diMock);
        $service = $handler->handle($definition['serviceB']);

        static::assertInstanceOf(B::class, $service);
        static::assertEquals('Other Text', $service->value());
    }

    /**
     * @test
     * @throws ContainerException
     */
    public function instanceThrowContainerException(): void
    {
        $this->expectException(ContainerException::class);

        $definition = [
            'serviceA' => [
                'className' => \Invalid\Namespace\A::class,
                'arguments' => ['Text Value']
            ]
        ];

        $handler = new InstanceHandler($this->diMock);
        $handler->handle($definition['serviceA']);
    }

    /**
     * @test
     * @throws ContainerException
     */
    public function retrieveEqualvalue(): void
    {
        $handler = new InstanceHandler($this->diMock);
        static::assertEquals('serviceA', $handler->handle('serviceA'));
    }
}
