<?php
require_once "vendor/autoload.php";

$router = new \Klein\Klein();
$router->respond(function() {
    return "<h1> GG </h1>";
});
$kernel = new \Me\Kernel($router);
$router->dispatch();