<?php

require __DIR__.'/../vendor/autoload.php';

/*
 * =================================
 * |    DotEnv
 * =================================.
 */
use Dotenv\Dotenv;

$env = Dotenv::createImmutable(base_path());
$env->load();

/*
 * =================================
 * |    Eloquent
 * =================================.
 */
require config_path('database.php');
