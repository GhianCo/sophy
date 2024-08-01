<?php

use Slim\Interfaces\RouteCollectorProxyInterface as Group;
$routesDirectory = routesDirectory();
app()->router->group('/api', function (Group $group) use ($routesDirectory) {
});