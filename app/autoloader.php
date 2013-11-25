<?php

use Composer\Autoload\ClassLoader;

/**
 * Если присутствует Composer и его автолоадер - используем его
 * Если нет, то используем бесстыдно скопированный у него же ClassLoader
 * На случай если даже Composer использовать нельзя
 */

$composerAutoloader = __DIR__ . "/../vendor/autoload.php";

if(file_exists( $composerAutoloader )) {
    $classLoader = require$composerAutoloader;
} else {
    require __DIR__ . "/Composer/Autoload/ClassLoader.php";
    $classLoader = new ClassLoader();
    $classLoader->register();
}

$classLoader->add('Core', __DIR__ . "/../modules/Core/src");
$classLoader->add('Debug', __DIR__ . "/../modules/Debug/src");
$classLoader->add('Parser', __DIR__ . "/../modules/Parser/src");
$classLoader->add('DB', __DIR__ . "/../modules/DB/src");


require_once __DIR__ . "/Application.php";
