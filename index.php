<?php
require_once "vendor/autoload.php";

$router = new \Klein\Klein();
$kernel = new \Me\Kernel($router);
$router->dispatch();