<?php

namespace Tleckie\Di\Tests;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Tleckie\Di\Di;
use Tleckie\Di\Definition\Adapter\ArrayAdapter;

use Tleckie\Di\Tests\Dummy\ConcreteA;

/**
 * Class DiTest
 *
 * @package Tleckie\Di\Tests\Definition\Adapter
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class DiTest extends TestCase
{
    /** @var ContainerInterface */
    private ContainerInterface $container;

    public function setUp(): void
    {
        $this->container = new Di();
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
                'newInstance' => false,
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

        static::assertEquals(spl_object_id($object), spl_object_id($this->container->get('service')));
        static::assertEquals(55, $object->value());
    }

    /**
     * @test
     */
    public function newInstance(): void
    {
        $definitions = [
            'test' => ['value'],
            'closure' => static function () {
                return new Dummy;
            },
            'service' => [
                'className' => ConcreteA::class,
                'arguments' => ['test'],
                'newInstance' => true,
                'methods' => [
                    [
                        'methodName' => 'changeValue',
                        'arguments' => ['closure']
                    ]
                ]
            ],
        ];

        $this->container->setAdapter(new ArrayAdapter($definitions));
        $object1 = $this->container->get('service');
        $object1->changeValue(888);

        static::assertEquals(888, $object1->value());
        static::assertInstanceOf(Dummy::class, $this->container->get('service')->value());
    }
}

class Dummy {

    protected $value;

    /**
     * Dummy constructor.
     */
    public function __construct()
    {
        $this->value = rand(1,888);
    }
}