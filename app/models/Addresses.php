<?php

namespace App\models;

use App\Core\App;

class Addresses
{
    protected $table = 'addresses';
    protected $database;
    protected $guard = [
        'address1',
        'address2',
        'city',
        'state',
        'zip5',
        'zip4',
    ];

    public function __construct()
    {
        $this->database = App::get('database');
    }

    public function getAll()
    {
        return $this->database->selectAll($this->table);
    }

    public function create($address)
    {
        $insertData = $this->filterInput($address);
        if(count($insertData) > 0)
            return $this->database->insert($this->table,$insertData);

        return 0;
    }

    private function filterInput($inputArray){
        return array_filter($inputArray, function($k,$v) {
            return in_array($v,$this->guard);
        }, ARRAY_FILTER_USE_BOTH);
    }

    /*
     * Function to get a record by the id
     * @param INT id
     * @returns a single Address record
     */
    public function find(int $id)
    {
        return $this->database->findOne('addresses','id',$id);
    }

    public function findOne()
    {

    }
}