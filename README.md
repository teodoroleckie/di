### Di:

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tleckie/di.svg?style=flat-square)](https://packagist.org/packages/tleckie/di)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/teodoroleckie/di/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/teodoroleckie/di/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/teodoroleckie/di/badges/build.png?b=master)](https://scrutinizer-ci.com/g/teodoroleckie/di/build-status/master)
[![Total Downloads](https://img.shields.io/packagist/dt/tleckie/di.svg?style=flat-square)](https://packagist.org/packages/tleckie/di)

You can install the package via composer:

```bash
composer require tleckie/di
```


```php
<?php

require "../vendor/autoload.php";

use Tleckie\Di\Di;
use Tleckie\Di\Definition\Adapter\FileAdapter;

$container = new Di();
$container->setAdapter(new FileAdapter('conf/definition.php', $container));

$container->get('stringValue');
$container->get('numericValue');
$container->get('chainValue');
$container->get('closureValue'); 
$container->get('closureValue'); // same instance
$container->get('closureValue'); // same instance
$container->get('closureValue'); // same instance
$container->get('arrayValue');
$container->get('lazyFactoryWithConstructArgumentsAnReturnSameInstance');
$container->get('lazyFactoryWithConstructArgumentsAndCallMethodWithArgumentsAndCreateANewInstance');

```


### Definition:

conf/definition.php

```php
<?php

return [
    'stringValue' => 'Lorem ipsum dolor sit amet',
    'numericValue' => 55,
    'chainValue' => 'stringValue',
    'closureValue' => static function () {
        // each call returns the same instance
        return new Project\B('String Argument');
    },
    'arrayValue' => [
        [
            [
                'host' => 'localhost',
                'port' => 443,
                'user' => 'userValue',
                'pass' => 'password',
            ]
        ]
    ],
    // lazy loading and singleton instance
    'lazyFactoryWithConstructArgumentsAnReturnSameInstance' => [
        'className' => Project\A::class,
        'arguments' => ['stringValue', 'closureValue'],
        'newInstance' => false // each call returns the same instance
    ],
    'lazyFactoryWithConstructArgumentsAndCallMethodWithArgumentsAndCreateANewInstance' => [
        'className' => Project\A::class,
        'arguments' => ['stringValue', 'closureValue'],
        'newInstance' => true, // each call returns a new instance
        'methods' => [
            [
                'methodName' => 'setValue',
                'arguments' => ['changed value ']
            ],
            [
                'methodName' => 'setOtherValue',
                'arguments' => ['changed other value ']
            ]
        ]
    ]
];
```