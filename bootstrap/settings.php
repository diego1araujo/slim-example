<?php

return [
    'settings' => [
        'displayErrorDetails' => true,
        'view' => [
            'path' => __DIR__ . '/../resources/views',
            'cache' => __DIR__ . '/../resources/cache',
        ],
    ],
    'default' => 'development',
    'connections' => [
        'development' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => '',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
        ],
        'production' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => '',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
        ],
    ],
];
