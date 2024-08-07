<?php

return [
    'boot' => [
        Sophy\Providers\ViewServiceProvider::class
    ],
    'runtime' => [
        App\Providers\DatabaseDriverServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\PDFServiceProvider::class
    ],
    'cli' => [
        //App\Providers\DatabaseDriverServiceProvider::class,
    ]
];
