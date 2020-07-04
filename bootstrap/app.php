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

/*
 * =================================
 * |    Illuminate/Validator
 * =================================.
 */
// require config_path('Providers/ValidatorFactory.php');

/*
 * =================================
 * |    Routes
 * =================================.
 */
require config_path('routes.php');
