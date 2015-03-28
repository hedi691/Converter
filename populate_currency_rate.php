<?php

	require 'ExchangeRatePersistence.php'; 
	require 'ExchangeRate.php';
	require 'ExchangeRateReader.php';

	
	$APIUrl="https://wikitech.wikimedia.org/wiki/Fundraising/tech/Currency_conversion_sample?ctype=text/xml&action=raw";
	
	//get the data from the url
	$exchangeRates=ExchangeRateReader::readFromXml($APIUrl);
	
	//save to the database
	$msql= new ExchangeRatePersistence();
	$msql->save($exchangeRates);

?>