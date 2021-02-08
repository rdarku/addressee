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
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
	                'reconnect'=>TRUE
                ]
            );
        }
        catch (\Exception $e){
        	dd($config);
            die(var_dump($e->getMessage()));
        }
    }

}