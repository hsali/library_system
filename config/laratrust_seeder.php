<?php

return [
    'role_structure' => [
        'admin' => [
            'books' => 'c,r,u,d',
            'racks' => 'c,r,u,d',
        ],
        'client' => [
            'racks' => 'r',
            'books' => 'r'
        ]
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
