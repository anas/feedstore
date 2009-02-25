<?php

class CanadaPost extends Shipping {
	
	protected $base = 0.00;
	protected $fp;
	protected $server = "sellonline.canadapost.ca";
	protected $port = 30000;
	protected $merchant_cpcid = "CPC_DEMO_XML";
	
	
	public function getCost() {
		//$this->sendXML();
		return parent::getCost() + $this->base;
	}
	
	protected function sendXML() {
		
		$xml = '<?xml version="1.0" ?>
<eparcel>
	<language>en</language>
	<ratesAndServicesRequest>
		<merchantCPCID>CPC_DEMO_XML</merchantCPCID>
		<lineItems>
		<item>
			<quantity>1</quantity>
			<weight>0.5</weight>
			<length>30</length>
			<width>30</width>
			<height>30</height>
			<description> Demo Item to be shipped from Canada Post</description>
			<readyToShip />
		</item>

		</lineItems>
<city>Halifax</city>
		<provOrState>Nova Scotia</provOrState>
		<country>Canada</country>
		<postalCode>B3Z1P4</postalCode>

	</ratesAndServicesRequest>
</eparcel>
		';
		$this->fp = fsockopen ( $this->server, $this->port, $errno, $errstr, 30 );
		if (!$this->fp) {
    			die("Open Socket Error: $errstr ($errno)<br>\n");
				$this->error = true ;
				$this->error_msg = $errstr ;
		} else
			fwrite( $this->fp, $xml );
		
		if (!$this->fp) return ;
		while(!feof ($this->fp))
			$this->xml_response .= fgets( $this->fp, 4096 );
		
		print_r($this->xml_response);
   		fclose($this->fp);
	}
	
}

?>