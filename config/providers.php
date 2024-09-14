<?php

return [
    'boot' => [
        Sophy\Providers\DatabaseDriverServiceProvider::class,
        Sophy\Providers\ViewServiceProvider::class,
        Sophy\Providers\SessionStorageServiceProvider::class,
    ],
    'runtime' => [
        App\Providers\RouteServiceProvider::class
    ],
    'cli' => [
        Sophy\Providers\DatabaseDriverServiceProvider::class,
    ]
];
