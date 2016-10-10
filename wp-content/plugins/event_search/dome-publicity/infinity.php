<?php
class infinitySOAP extends SoapClient {
	/* Connect to JFJ staging */
	/* public function __construct($wsdl = "https://bbecrig05bo3.blackbaudhosting.com/17112_c45ea4a9-6acc-417a-9b46-03139f3c9575/AppFxWebService.asmx?wsdl", $options=array()) { */
		
	/* Connect to JFJ Production */
	public function __construct($wsdl = "https://bbisecrigabo3.blackbaudhosting.com/17112_ed77bf07-ecb8-4c6f-b258-5fa8f1749b33/AppFxWebService.asmx?wsdl", $options=array()) {
	
		if (empty($options) || !is_array($options)) {
			$options=array();
		}
		
		// Add the authentication information to our headers
		if (!array_key_exists('login', $options)) {
			$options["login"]="BLACKBAUDHOST\WebAPIUser17112";
			/* $options["login"]="BLACKBAUDHOST\JayJose17112"; */
		}
		
		if (!array_key_exists('password', $options)) {
			$options["password"]="7q22io54S1la473"; 
			/* $options["password"]="a4mamhwwsdLORD"; */
		}
		
		return parent::__construct($wsdl, $options); 
	}
	
	public function __call($function, $args) {

		$clientAppInfo=array('REDatabaseToUse' => 'Jews for Jesus',
							 'SessionKey'      => 'e878392c-3456-464a-836f-6ec9a57019d9',
							 'TimeOutSeconds'  => 120
							 );

		// Add the ClientAppInfoHeader to our request
		$params=array();

		foreach ($args as $key => $value) {
			if(is_array($value)) {
				foreach ($value as $key1 => $value1) {
					$params[$key1]=$value1;
				}
			} else {
				$params[$key]=$value;
			}
		}

		$params['ClientAppInfo'] = $clientAppInfo;
		$args=array($params);

		return $this->__soapCall($function, $args, $this->location, $this->headers);
	}
}

function getDeputationCompleteDetails($soapClient, $listID, $parameterValues=array()){
	$parameters = new stdClass;
	$parameters->Values = new stdClass;
	$parameters->Values->fv = $parameterValues;
	
	try{
		$params = array('DataListID' => $listID,
						'ContactRecordID' => '00000000-0000-0000-0000-000000000000',
						'Parameters' => $parameters,
						'ViewFormID' => '00000000-0000-0000-0000-000000000000',
						'IncludeMetaData' => false,
						'SortDirection' => 'Ascending');
		
		$result = $soapClient->DataListLoad($params);
		
	}catch(SOAPFault $f){
		print $f;
	}
	
	$resultRows = $result->Rows->r;
	
	if (!empty($resultRows) && !is_array($resultRows)) {
		// This is a single row -- make it an array		
		return array($resultRows);
	}else{
		return $resultRows;
	}
}

function getStringFilter($fieldID, $fieldValue, $fieldValueTrans='') {
	$fv = new stdClass;
	$fv->Value=getSoapString($fieldValue);
	$fv->ID=$fieldID;

	if (strlen($fieldValueTrans) > 0) {
		$fv->ValueTranslation=$fieldValueTrans;
		}

	return $fv;
}

function getSoapString($stringVar) {
	return new SoapVar($stringVar, XSD_STRING, "string", "http://www.w3.org/2001/XMLSchema");
}

?>