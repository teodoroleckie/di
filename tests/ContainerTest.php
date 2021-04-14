<?php

namespace Tleckie\Di\Tests;

use PHPUnit\Framework\TestCase;
use Tleckie\Di\Container;
use Tleckie\Di\Definition\Adapter\ArrayAdapter;

use Tleckie\Di\Tests\Dummy\ConcreteA;

/**
 * Class ContainerTest
 *
 * @package Tleckie\Di\Tests\Definition\Adapter
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class ContainerTest extends TestCase
{
    /** @var Container */
    private Container $container;

    public function setUp(): void
    {
        $this->container = new Container();
    }

    /**
     * @test
     */
    public function setAdapter(): void
    {
        $definitions = [
            'test' => ['value'],
            'closure' => static function () {
                return 55;
            },
            'service' => [
                'className' => ConcreteA::class,
                'arguments' => ['test'],
                'methods' => [
                    [
                        'methodName' => 'changeValue',
                        'arguments' => ['closure']
                    ]
                ]
            ],
        ];

        $this->container->setAdapter(new ArrayAdapter($definitions));


        static::assertEquals(['value'], $this->container->get('test'));
        static::assertEquals(['value'], $this->container->get('test'));
        static::assertEquals(55, $this->container->get('closure'));
        $object = $this->container->get('service');
        static::assertEquals(55, $object->value());
    }
}
