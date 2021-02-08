<?php
	
	
	namespace App\Controllers;
	
	
	use App\Core\App;
	
	class AddressValidationController
	{
		private const VAL_API_URL = "http://production.shippingapis.com/ShippingAPI.dll";
		private const VALIDATION_FILTERS = [
			'address1' => FILTER_SANITIZE_STRIPPED,
			'address2' => FILTER_SANITIZE_STRIPPED,
			'zip5' => FILTER_VALIDATE_INT,
			'zip4' => FILTER_VALIDATE_INT,
			'city' => FILTER_SANITIZE_STRIPPED,
			'state' => FILTER_SANITIZE_STRIPPED,
		];
		
		public function validate()
		{
			header("Access-Control-Allow-Origin: *");
			header("Content-Type: application/json; charset=UTF-8");
			header("Access-Control-Allow-Methods: POST");
			header("Access-Control-Max-Age: 3600");
			header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
			
			$rawPostData = json_decode(file_get_contents("php://input"), true);
	
			$valPostData = filter_var_array($rawPostData, self::VALIDATION_FILTERS);
			
			$requestString = $this->createXMLRequestString($valPostData);
			
			$url = $this->getValidationRequestURL($requestString);
			
			$response = simplexml_load_string(file_get_contents($url));
			
			$this->processResponse($response);
		}
		
		private function createXMLRequestString(array $requestParams)
		{
			$xml = new \SimpleXMLElement(
				"<?xml version=\"1.0\" encoding=\"UTF-8\"?>
						<AddressValidateRequest/>"
			);
			$xml->addAttribute('USERID', App::get('config')['validation_api']['USERID']);
			$xml->addChild("Revision", 1);
			$address = $xml->addChild("Address");
			$address->addAttribute("ID", '0');
			$address->addChild("Address1", $requestParams['address1']);
			$address->addChild("Address2", $requestParams['address2']);
			$address->addChild("City", $requestParams['city']);
			$address->addChild("State", $requestParams['state']);
			$address->addChild("Zip5", $requestParams['zip5']);
			$address->addChild("Zip4", $requestParams['zip4']);
			
			return urlencode(
				preg_replace(
					'/[\t\n]/',
					'', $xml->asXML())
			);
		}
		
		private function getValidationRequestURL(string $queryString)
		{
			return self::VAL_API_URL . "?API=Verify&XML=" . $queryString;
		}
		
		private function getFilterType(string $fieldName)
		{
			$filter = FILTER_DEFAULT;
			
			switch ($fieldName) {
				case 'address2':
				case 'city':
				case 'state':
				case 'address1':
					$filter = FILTER_SANITIZE_STRING;
					break;
				case 'zip4':
				case 'zip5':
					FILTER_VALIDATE_INT;
					break;
				default:
					break;
			}
			
			return $filter;
		}
		
		private function processResponse(object $response)
		{
			$returnData = [
				'status' => 400,
				'message' => 'Bad Request',
				'data' => []
			];
			
			if (property_exists($response, 'Address')) {
				if (property_exists($response->Address, 'Error')) {
					$returnData['data'] = $response->Address->Error;
					$returnData['message'] = (string)$response->Address->Error->Description;
				} else {
					$returnData['data'] = $response;
					$returnData['status'] = 200;
					$returnData['message'] = (property_exists($response->Address, 'ReturnText'))
						? (string)$response->Address->ReturnText
						: 'success';
				}
			} else {
				$returnData['message'] = (string)$response->Description;
			}
			
			http_response_code($returnData['status']);
			print_r(trim(json_encode($returnData)));
		}
	}