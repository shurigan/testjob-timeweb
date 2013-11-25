<?php

use Core\Config\ConfigArray,
    Core\Router\BaseRouter,
    Core\Request,
    Core\Response\Response,
    Debug\Debug,
    DB\DB;


error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . "/../app/autoloader.php";

Debug::enable();

$config = new ConfigArray(__DIR__ . "/../app/config.php");

DB::create($config->getValue("db"));

$router = new BaseRouter($config->getValue("routes"));

$application = new Application( $config, $router );

$request = new Request();
$response = $application->handle($request);
$response->send();

