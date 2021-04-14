### Initialization:
```php
<?php

require "../vendor/autoload.php";

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
        // returns a new instance on each call
        return new B('String Argument');
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
    // lazy loading and apply singleton
    'lazyFactoryWithConstructArguments' => [
        'className' => A::class,
        'arguments' => ['stringValue', 'closureValue']
    ],
    'lazyFactoryWithConstructArgumentsAndCallMethodWithArguments' => [
        'className' => A::class,
        'arguments' => ['stringValue', 'closureValue'],
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