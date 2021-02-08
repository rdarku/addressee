<?php
$router->get('','AddressesController@index');
$router->get('addresses','AddressesController@index');
$router->get('newAddress','AddressesController@add');
$router->post('addresses','AddressesController@store');
$router->post('api/validateAddress','AddressValidationController@validate');