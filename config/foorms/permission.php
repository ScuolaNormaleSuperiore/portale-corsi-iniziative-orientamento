<?php
return [
    'search' => [
        'fields' => [
            'id' =>[],
            'name' => [],
            'guard_name' => [],
        ],
        'relations' => [
            'roles' => [
                'fields'  => [
                    'id' => [],
                    'name' => [],
                    'guard_name' => []
                ]

            ],
        ]
        ],
    'list' => [
        'fields' => [
            'id' =>[],
            'name' => [],
            'guard_name' => [],
        ],
        'relations' => [
            'roles' => [
                'fields'  => [
                    'id' => [],
                    'name' => [],
                    'guard_name' => []
                ]

            ],
        ]
    ]
];