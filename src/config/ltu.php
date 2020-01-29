<?php

return [
    'data_cases' => [

        'string' => [
            'empty' => true,
            'small' => true,
            'long' => true,
            'null' => true
        ],

        'integer' => [
            'zero' => true,
            'negative' => true,
            'positive' => true
        ],

        'date' => [
            'past' => true,
            'today' => true,
            'future' => true,
            'string' => true,
            'null' => true
        ]

    ]
];
