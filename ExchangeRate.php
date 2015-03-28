<?php
class  ExchangeRate{
    private $currencyCode;
	private $rate;
    private $updateDate;
	
	public function __construct($_currencyCode,$_rate)
    {
		$this->rate=$_rate;
		$this->currencyCode=$_currencyCode;
		$this->updateDate=null;
		
	}
	
	public function setCurrencyCode($par){
       $this->currencyCode = $par;
    }
    public function getCurrencyCode(){
       return $this->currencyCode;
    }
    public function setRate($par){
       $this->rate = $par;
    }
    public function getRate(){
       return $this->rate;
    }
	public function setUpdateDate($par){
       $this->updateDate = $par;
    }
	public function getUpdateDate(){
       return $this->updateDate;
    }

}

?>