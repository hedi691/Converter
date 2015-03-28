<?php

class  Converter{
	
	public static function convertToUSD($amountWithCurrencyToConvert)
    {	
		$currencycode=$amountWithCurrencyToConvert->getCurrencyCode();
		$amount=$amountWithCurrencyToConvert->getAmount();
		
		//get the exchange rate from the database
		$exchangeRatePersistenceTool= new ExchangeRatePersistence();
		$exchangeRate=$exchangeRatePersistenceTool->get($currencycode);
		
		//compute the new amount
		$newAmount=($exchangeRate[$currencycode]->getRate()) * $amount;
		
		$amountWithCurrencyConverted = new AmountWithCurrency('USD',$newAmount);
		
		return $amountWithCurrencyConverted;
		
	}
	
	public static function convertToUSDFromArray($amountsToConvert)
    {	
		

		//get ExchangeRates from the database
		$exchangeRatePersistenceTool= new ExchangeRatePersistence();
		$currencyCodes=array();
		foreach($amountsToConvert as $amountO) {
			array_push($currencyCodes,$amountO->getCurrencyCode());
		}
		$exchangeRates=$exchangeRatePersistenceTool->get($currencyCodes);

		//convert
		$arrayToReturn=array();
		foreach($amountsToConvert as $amountO) {
			$currencycode=$amountO->getCurrencyCode();
			$amount=$amountO->getAmount();
			

			//get exchange rate
			$rate=$exchangeRates[$currencycode];
			
			//compute the new amount
			$newAmount=($rate->getRate()) * $amount;
			$amountWithCurrencyConverted = new AmountWithCurrency('USD',$newAmount);
			
			
			array_push($arrayToReturn,$amountWithCurrencyConverted);
		}
		
		return $arrayToReturn;
		
	}
	
	
}
?>