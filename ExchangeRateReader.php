<?php
class  ExchangeRateReader{
	
	
	//return an Array of ExchangeRate from an XML
	static function readFromXml($fileName){
		
		//load the xml
		$xml = simplexml_load_file($fileName);
		
		//create en array of ExchangeRate 
		$arrayToReturn = array();
		foreach ($xml as $xmlElement){
			$exchangeRate = new ExchangeRate($xmlElement->currency->__toString(),$xmlElement->rate->__toString());
			array_push($arrayToReturn, $exchangeRate);
		}
		
		return $arrayToReturn;
    }
}
?>