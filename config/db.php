<?php

return [
  'db' => [
    'driver' => env('DB_HOST', 'mysql'),
    'host' => env('DB_HOST'),
    'port' => env('DB_PORT'),
    'database' => env('DB_DATABASE'),
    'username' => env('DB_USERNAME'),
    'password' => env('DB_PASSWORD'),
    'charset' => env('DB_ENCODE', 'utf8'),
    'collation' => env('DB_COLLATION', 'utf8_unicode_ci'),
  ]
];