<?php

namespace App\Providers;

use Sophy\Providers\IServiceProvider;
use SophyDB\SophyDB;

class DatabaseDriverServiceProvider implements IServiceProvider
{
    public function registerServices()
    {
        $defaultConnection = config("database.default");

        SophyDB::addConn([
            'driver'        => config("database.connections." . $defaultConnection . ".driver"),
            'host'          => config("database.connections." . $defaultConnection . ".host"),
            'port'          => config("database.connections." . $defaultConnection . ".port"),
        
            'database'      => config("database.connections." . $defaultConnection . ".name"),
            'username'      => config("database.connections." . $defaultConnection . ".username"),
            'password'      => config("database.connections." . $defaultConnection . ".password"),
        ]);
    }
}
