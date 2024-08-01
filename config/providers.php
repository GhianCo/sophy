<?php

return [
    'boot' => [
        App\Providers\DatabaseDriverServiceProvider::class,
    ],
    'runtime' => [
        App\Providers\RouteServiceProvider::class,
    ],
    'cli' => [
        //App\Providers\DatabaseDriverServiceProvider::class,
    ]
];
