<?php

return [
    'stringValue' => 'Lorem ipsum dolor sit amet',
    'numericValue' => 55,
    'chainValue' => 'stringValue',
    'closureValue' => static function () {
        // each call returns the same instance
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
    // lazy loading and singleton instance
    'lazyFactoryWithConstructArguments' => [
        'className' => A::class,
        'arguments' => ['stringValue', 'closureValue'],
        'newInstance' => false // each call returns the same instance
    ],
    'lazyFactoryWithConstructArgumentsAndCallMethodWithArguments' => [
        'className' => A::class,
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
