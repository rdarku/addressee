<?php

namespace App\Core\Database;

class QueryBuilder
{
    public \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll(string $table){
        $statement = $this->pdo->prepare("select * from $table");

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS);
    }

    public function findOne(string $table, string $key, $value){
        $sql = sprintf("select * from %s where %s = %s",
            $table, $key, $value
        );

        try{
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(\PDO::FETCH_CLASS);
        }
        catch (\Exception $e){
            die($e->getMessage());
        }
    }

    public function insert(string $table, Array $params)
    {
        $sql = sprintf('INSERT INTO %s (%s) VALUES (%s)',
        $table,
        $this->getInsertColumnsAsString($params),
        $this->getInsertValuesAsString($params));

        try{
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
            return $statement->rowCount();
        }
        catch (\Exception $e){
            die($e->getMessage());
        }



    }

    public function getInsertColumnsAsString(Array $params){
        return implode(', ',
            array_map(function($param){
                return "{$param}";
            }, array_keys($params))
        );

    }

    public function getInsertValuesAsString(Array $params){
        return implode(', ',
                array_map(function($param){
                    return ":{$param}";
                }, array_keys($params))
            );
    }
}