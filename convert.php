<?php
	require 'Converter.php'; 
	require 'AmountWithCurrency.php'; 
	require 'ExchangeRatePersistence.php'; 
	require 'ExchangeRate.php'; 
	
	
	//create an array of
	$i=1;
	$amountsToConvert=array();
	while($i<sizeof($argv)) {
		$amountString=$argv[$i];
		$splittedInput = preg_split('/ /', $amountString);
		$amount=new AmountWithCurrency($splittedInput[0],$splittedInput[1]);
		array_push($amountsToConvert,$amount);
		$i++;
	}
	
	//convert
	$convertedAmounts = Converter::convertToUSDFromArray($amountsToConvert);
	
	//display the array
	foreach($convertedAmounts as $amount) {
		echo $amount->toString()." ";
	}


?>