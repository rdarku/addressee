<?php

namespace App\Controllers;

use App\models\{Addresses,States};

class AddressesController
{
    public function index()
    {
        $addresses = (new Addresses())->getAll();
        
        return view('addresses',compact('addresses'));
    }

    public function store()
    {
        $args = array(
            'address1'   => FILTER_SANITIZE_STRIPPED,
            'address2'   => FILTER_SANITIZE_STRIPPED,
            'zip5'   => FILTER_VALIDATE_INT,
            'zip4'   => FILTER_VALIDATE_INT,
            'city'   => FILTER_SANITIZE_STRIPPED,
            'state'   => FILTER_SANITIZE_STRIPPED,
        );

        $postData = filter_input_array(INPUT_POST,$args);
        try{
            (new Addresses())->create($postData);
        }catch(\Exception $e){
            dd($e);
        }

        return redirect('addresses');
    }

    public function add()
    {
	
	    $states = (new States())->getAll();
        return view('addressForm',compact('states'));
    }
}