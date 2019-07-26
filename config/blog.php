<?php

return [
    'database' => [
        'connection' => env('DB_CONNECTION_BLOG', 'mysql'),
        'prefix_for_default_connection' => "blog_",
    ],
    'mails' => [
        'enable' => true,
        'users' => [
            'register' => true,
        ],
    ],
    'default_locale' => 'en',
    'locales' => [
        'en',
        'fr',
        'es',
    ],
    'default' => [
        'blogName' => 'Blog',
        'articleNumber' => 10,
    ]
];
