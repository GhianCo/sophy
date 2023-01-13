<?php

use Sophy\Settings\SettingsInterface;
use Sophy\Database\Drivers\DBHandler;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        DBHandler::class => function (ContainerInterface $c) {

            $settings = $c->get(SettingsInterface::class);

            $dbSettings = $settings->get('db');

            $driver = $dbSettings['driver'] ?? 'mysql';
            $host = $dbSettings['host'];
            $dbname = $dbSettings['database'];
            $username = $dbSettings['username'];
            $password = $dbSettings['password'];
            $charset = $dbSettings['charset'];

            $dsn = $driver.":host=$host;dbname=$dbname;charset=$charset";

            $dbHandler = new DBHandler($dsn, $username, $password);
            $dbHandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbHandler->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $dbHandler->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            return $dbHandler;
        },
    ]);
};
