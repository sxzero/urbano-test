<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => env('DB_HOST', 'localhost'),
    'port' => env('DB_PORT', ''),
    'database' => env('DB_DATABASE', 'database'),
    'username' => env('DB_USERNAME', 'root'),
    'password' => env('DB_PASSWORD', 'password'),
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => env('DB_PREFIX', ''),
]);

$capsule->bootEloquent();
