<?php

return [
    'boot' => [
        Sophy\Providers\DatabaseDriverServiceProvider::class,
        Sophy\Providers\ViewServiceProvider::class
    ],
    'runtime' => [
        App\Providers\RouteServiceProvider::class,
        App\Providers\PDFServiceProvider::class
    ],
    'cli' => [
        Sophy\Providers\DatabaseDriverServiceProvider::class,
    ]
];
