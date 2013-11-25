<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$arr = $hash = array();

$low = 1;
$high = 100000;


for($i = $low; $i <= $high; $i++) {
    $arr[] = $i;
    $hash[$i] = true;
}

$toFind = array();

for($i = 0; $i < 1000; $i++) {
    $toFind[] = rand($low, $high);
}


echo "Fill done!<br>";

$time = microtime();

foreach($toFind as $find) {
    $result = in_array($find, $arr);
    //$result =
}

echo "Indexed array - " . (microtime()-$time) . "<br>";

$time = microtime();

foreach($toFind as $find) {
    $result = array_key_exists($find, $hash);
}

echo "Hash array (array_key_exists) - " . (microtime()-$time) . "<br>";

$time = microtime();

foreach($toFind as $find) {
    $result = isset($hash[$find]);
}

echo "Hash array (isset) - " . (microtime()-$time) . "<br>";


