<?php
require_once "vendor/autoloader.php";
$router = new \Klein\Klein();
$router->respond('/', function() {
    return "<h1> GG </h1>";
});
$router->dispatch();