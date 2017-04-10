<?php
require_once "vendor/autoload.php";

print_r($_SERVER);

$router = new \Klein\Klein();
$kernel = new \Me\Kernel($router);
$router->dispatch();