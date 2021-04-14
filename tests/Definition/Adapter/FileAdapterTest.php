<?php

namespace Tleckie\Di\Tests\Definition\Adapter;

use org\bovigo\vfs\vfsStream;
use Tleckie\Di\Definition\Adapter\FileAdapter;
use PHPUnit\Framework\TestCase;

class A
{
}
class B
{
}

/**
 * Class FileAdapterTest
 *
 * @package Tleckie\Di\Tests\Definition\Adapter
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class FileAdapterTest extends TestCase
{
    public function setUp(): void
    {
        $content = <<<EOF
        <?php 
            return [
                'stringValue' => 'value',
                'service' => [
                    'className' => Tleckie\Di\Tests\Definition\Adapter\A::class,
                    'arguments' => ['stringValue'],
                    'methods' => [
                        [
                            'methodName' => 'set',
                            'arguments' => ['stringValue']
                        ]
                    ]
                ],
                'closure' => (static function () {
                    return new B('Same value');
                }),
                'arrayStructure' => [
                    [
                        [
                            [
                                'test1' => 'pruebas',
                                'test2' => 'service',
                                'test3' => (static function () {
                                    return new Tleckie\Di\Tests\Definition\Adapter\A('other string');
                                }),
                                'test4' =>new Tleckie\Di\Tests\Definition\Adapter\B('Other value'),
                            ]
                        ]
                    ]
                ]
            ];
        EOF;

        vfsStream::setup(
            'root',
            null,
            ['pruebas.php' => $content]
        );
    }

    /**
     * @test
     */
    public function load(): void
    {
        $fileAdapter = new FileAdapter('vfs://root/pruebas.php');
        $array = $fileAdapter->load();

        static::assertEquals('value', $array['stringValue']);
        static::assertEquals(['stringValue'], $array['service']['arguments']);
    }

    /**
     * @test
     */
    public function loadThenThrowInvalidArgumentException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $fileAdapter = new FileAdapter('vfs://temp/pruebas.php');
        $fileAdapter->load();
    }
}
