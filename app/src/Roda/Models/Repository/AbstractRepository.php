<?php

namespace Roda\Models\Repository;

use Doctrine\DBAL\DriverManager;

abstract class AbstractRepository
{
    public static function getConnection()
    {
        $connectionParams = array(
            'dbname' => 'bionic_roda',
            'user' => 'root',
            'password' => '_drago2016N',
            'host' => '127.0.0.1',
            'charset' =>  'UTF8',
            'driver' => 'pdo_mysql',
        );
        return DriverManager::getConnection($connectionParams);
    }
    
    public static function query($sql_query)
    {
        $connection = static::getConnection();
        return $connection->query($sql_query);
    }
    
}
