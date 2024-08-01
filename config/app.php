<?php

return [
    'name' => env('APP_NAME', 'Sophy'),
    'env' => env('APP_ENV', 'dev'),
    'url' => env('APP_URL', 'localhost'),
    'domain' => env('APP_DOMAIN', 'localhost'),
    'path_route' => env('PATH_ROUTE', basename(dirname(__DIR__))),
    'timezone' => env('TIME_ZONE', 'America/Lima'),
    'jwt_secret_key' => env('JWT_SECRET_KEY', 'ghianco'),
];
