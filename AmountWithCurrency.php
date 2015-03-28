<?php
class  AmountWithCurrency{
    private $currencyCode;
	private $amount;
	
	public function __construct($_currencyCode,$_amount)
    {
		$this->amount=$_amount;
		$this->currencyCode=$_currencyCode;
		
	}
	public function setCurrencyCode($par){
       $this->currencyCode = $par;
    }
    public function getCurrencyCode(){
       return $this->currencyCode;
    }
    public function setAmount($par){
       $this->amount = $par;
    }
    public function getAmount(){
       return $this->amount;
    }
	public function toString() {
		return $this->currencyCode." ".$this->amount;
	}
}
?>