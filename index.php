<?php

require_once ('vendor/autoload.php');

require_once 'core/bootstrap.php';

use App\Core\{Router,Request};

Router::load(__DIR__ . '/app/routes.php')
    ->direct(Request::uri(), Request::method());

/*$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><AddressValidateRequest></AddressValidateRequest>');*/
//
//const USERID="674PERSO4317";
//
//$xml->addAttribute('USERID',USERID);
//$revision = $xml->addChild('Revision',1);
//
//header("Content-Type:application/xml");
//print_r($xml->asXML());
//
//$xmlString = urlencode(trim("<AddressValidateRequest USERID={USERID}>
//<Revision>1</Revision>
//<Address ID='0'>
//<Address1>SUITE K</Address1>
//<Address2>29851 Aventura</Address2>
//<City/>
//<State>CA</State>
//<Zip5>92688</Zip5>
//<Zip4/>
//</Address>
//</AddressValidateRequest>"));
//
//$doc_string = preg_replace('/[\t\n]/', '', $xmlString);
//$doc_string = urlencode($doc_string);
//
//$url = "http://production.shippingapis.com/ShippingAPI.dll?API=Verify&XML=" . $doc_string;
//echo $url . "\n\n";

// perform the get
//$response = file_get_contents($url);

