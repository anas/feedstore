<?php

class EAndA extends Shipping {
	
	protected $base = 0.00;
	protected $fp;
	protected $server = "";
	protected $port = 30000;
	protected $merchant_cpcid = "";
	
	
	public function getCost() {
		//$this->sendXML();
		return parent::getCost() + $this->base;
	}
	
	protected function sendXML() {
	}
}
?>