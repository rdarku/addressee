<?php

namespace App\Core\Database;

class Connection
{
    public static function make($config){
        try {
            return new \PDO(
                $config['connection']. ';dbname='.$config['name'],
                $config['username'],
                $config['password'],
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                ]
            );
        }
        catch (Exception $e){
            die(var_dump($e->getMessage()));
        }
    }

}