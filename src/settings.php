<?php

use Sophy\Settings\Settings;
use Sophy\Settings\SettingsInterface;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {

    // Global Settings Object
    $containerBuilder->addDefinitions([
        SettingsInterface::class => function () {
            return new Settings([
                'displayErrorDetails' => true, // Should be set to false in production
                'logError'            => false,
                'logErrorDetails'     => false,
                "db" => [
                    'driver' => $_SERVER['DB_DRIVER'],
                    'host' => $_SERVER['DB_HOST'],
                    'username' => $_SERVER['DB_USER'],
                    'database' => $_SERVER['DB_NAME'],
                    'password' =>  $_SERVER['DB_PASS'],
                    'charset' => 'utf8mb4',
                    'collation' => 'utf8mb4_unicode_ci',
                    'flags' => [
                        // Turn off persistent connections
                        PDO::ATTR_PERSISTENT => false,
                        // Enable exceptions
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        // Emulate prepared statements
                        PDO::ATTR_EMULATE_PREPARES => true,
                        // Set default fetch mode to array
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ],
                ],
                'app' => [
                    'basePath' => $_SERVER['BASE_PATH'],
                    'domain' => $_SERVER['APP_DOMAIN'],
                    'secret' => $_SERVER['SECRET_KEY'],
                ],
            ]);
        }
    ]);
};
