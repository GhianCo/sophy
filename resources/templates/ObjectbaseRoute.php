<?php

use App\Actions\Objectbase\GetAll;
use App\Actions\Objectbase\GetOne;
use App\Actions\Objectbase\Create;
use App\Actions\Objectbase\Update;
use App\Actions\Objectbase\Delete;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (Group $group) {
    $group->group('/objectbase', function (Group $group) {
        $group->get('', GetAll::class);
        $group->get('/{id}', GetOne::class);
        
        $group->post('', Create::class);

        $group->put('/{id}', Update::class);
        $group->delete('/{id}', Delete::class);
    });
}

?>