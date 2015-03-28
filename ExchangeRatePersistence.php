<?php

define('DBUSER', 'root'); 
define('DBHOST', 'localhost');
define('DBPASSWORD', 'root');

class ExchangeRatePersistence {
	private $dbName="converter";
	private $exchangeRateTableName="exchange_rate";	
	private $exchangeRateClassName="ExchangeRate";
	private $rateColumnName="exchange_rate";
	private $codeColumnName="currency_code";
	private $dateColumnName="update_date";
	
	public function __construct()
    {
		
	}
	
	//param can be an ExchangeRate or an Array of ExchangeRate
	public function save($param) {
		try
		{
			$bdd = new PDO('mysql:host='.DBHOST.';dbname='.$this->dbName.';charset=utf8',DBUSER , DBPASSWORD);
		}
		catch (Exception $e)
		{
			die('Error : ' . $e->getMessage());
		}

		//prepare the query
		$query='INSERT INTO '.$this->exchangeRateTableName.' ('.$this->codeColumnName.','.$this->rateColumnName.','.$this->dateColumnName.') VALUES (?,?,now()) ON DUPLICATE KEY UPDATE '.$this->rateColumnName.'=?,'.$this->dateColumnName.'=now();';
		$queryPrepared=$bdd->prepare($query);
		
		//check if the param is an ExchangeRate or an Array of ExchangeRate
		if(is_a($param , $this->exchangeRateClassName) ) {
		
			$queryPrepared->execute(array($param->getCurrencyCode(),$param->getRate(),$param->getRate()));
			echo "\ n Exchange rate code:".$param->getCurrencyCode()." rate:".$param->getRate()." populated";

		} else if (is_array($param)) {
			foreach ($param as $exchangeRate){
				if(is_a($exchangeRate , $this->exchangeRateClassName) ) {
					$r =$queryPrepared->execute(array($exchangeRate->getCurrencyCode(),$exchangeRate->getRate(),$exchangeRate->getRate()));
					echo "\n Exchange rate code:".$exchangeRate->getCurrencyCode()." rate:".$exchangeRate->getRate()." populated";

				}
			}
		} else {
			echo("Error in param");
		}
		
	}
	
	//return an array of ExchangeRate
	//param can be a currency code or an Array of currency code
	public function get($param) {
		try
		{
			$bdd = new PDO('mysql:host='.DBHOST.';dbname='.$this->dbName.';charset=utf8',DBUSER , DBPASSWORD);
		}
		catch (Exception $e)
		{
			die('Error : ' . $e->getMessage());
		}
	
		// check the currency codes 
		$codes=array();
		if (is_array($param))  {
			foreach ($param as $currencyCode){
				if(strlen($currencyCode) == 3) {
					array_push($codes,$currencyCode);
				}
			}
		} else if(strlen($param) == 3) {
			array_push($codes,$currencyCode);
		}
		
		//prepare the query
		$place_holders = implode(',', array_fill(0, count($codes), '?'));
		$query='SELECT * FROM '.$this->exchangeRateTableName.' WHERE '.$this->codeColumnName.' IN ('.$place_holders.');';
		$queryPrepared=$bdd->prepare($query);
		
		//execute the query
		$result = $queryPrepared->execute($codes);
		
		
		//construct the return array
		$arrayToReturn= array();
		while ($exchangeRateRow = $queryPrepared->fetch(PDO::FETCH_ASSOC))
		{
			$exchangeRate = new ExchangeRate($exchangeRateRow[$this->codeColumnName],$exchangeRateRow[$this->rateColumnName]);
			$exchangeRate->setUpdateDate($exchangeRateRow[$this->dateColumnName]);
			$arrayToReturn[$exchangeRate->getCurrencyCode()]=$exchangeRate;
		}
		
		
		return $arrayToReturn;
		
		
	}

		
	/** allow to change the table name  **/
	public function setExchangeRateTableName($par){
       $this->exchangeRateTableName = $par;
    }
    public function getExchangeRateTableName(){
       return $this->exchangeRateTableName;
    }
	public function setDbName($par){
       $this->dbName = $par;
    }
    public function getDbName(){
       return $this->dbName;
	}
}





?>