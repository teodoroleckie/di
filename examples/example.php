<?php

require "../vendor/autoload.php";

// emulate class autoload
include_once "B.php";
include_once "A.php";


use Tleckie\Di\Container;
use Tleckie\Di\Definition\Adapter\FileAdapter;

$container = new Container();
$container->setAdapter(new FileAdapter('conf/definition.php', $container));

$container->get('stringValue');
$container->get('numericValue');
$container->get('chainValue');
$container->get('closureValue');
$container->get('closureValue'); // new instance
$container->get('closureValue'); // new instance
$container->get('closureValue'); // new instance
$container->get('arrayValue');
$container->get('lazyFactoryWithConstructArguments');
$container->get('lazyFactoryWithConstructArgumentsAndCallMethodWithArguments');
