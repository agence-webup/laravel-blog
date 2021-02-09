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
    "custom_guard" => null,
    'default_locale' => 'en',
    'locales' => [
        'en',
        'fr',
        'es',
    ],
    'upload_shortcut' => null,
    'default' => [
        'blogName' => 'Blog',
        'articleNumber' => 10,
    ],
    'custom_link' => [
        'name' => null,
        'link' => null
    ],
    'pictures' => [
        'avatar' => [
            'small' => [300, 200],
            'medium' => [600, 400],
        ],
        'cover' => [
            'small' => [300, 200],
            'medium' => [1000, 800],
            'large' => [2000, 1600]
        ]
    ]
];
