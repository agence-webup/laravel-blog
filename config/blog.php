<?php

return [
  'database' => [
    'connection' => env('DB_CONNECTION_BLOG', 'mysql'),
    'prefix_for_default_connection' => "blog_",
  ],
];
