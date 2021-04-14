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
