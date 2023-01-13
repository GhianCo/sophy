<?php

use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\DefaultAction;

return function (App $app) {
    $app->get('/', DefaultAction::class);

    $app->group('/api', function (Group $group) {
    });

    $app->group('/public', function (Group $group) {
    });
};
