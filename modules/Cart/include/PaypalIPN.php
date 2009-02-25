<?
class PaypalIPN {
	protected $hostName;
	protected $accountEmail;
	
	public function __construct() {
		$this->hostName = SiteConfig::get('Cart::PaypalHostName');
		$this->accountEmail = SiteConfig::get('Cart::PaypalBusinessEmailAddress');
	}

	public function log($var, $param="a"){
		$fp = fopen(getenv("DOCUMENT_ROOT") . "/templates_c/IPN.html", $param);
		fwrite($fp, $var);
		fwrite($fp, "\n---------------------------------------------\n\n\n");
		fclose($fp);
	}
	
	public function checkOrder(){
		//If this function returns true, it means that the payment was successful and we should make a new order for the user. If it returns false, that is a false IPN request and it should be stored in a log file for security purposes 
		$IPNRequestVerification = false;
		$IPNRequestValidation = false;
		

		//Store all the requests coming from paypal.
		$IPNRequest = "";
		foreach ($_POST as $key => $value) {
			$IPNRequest .= "&$key=$value";
		}
		$paypaLog = new PaypaLog();
		$paypaLog->setIPN($IPNRequest);
		
		$IPNRequestVerification = $this->verifyIPNRequest();//Make sure that the request actually came from Paypal, not from a hacker
		if ($IPNRequestVerification){
			$paypaLog->setVerified("yes");
			$this->log("The request is verified");
			$IPNRequestValidation = $this->validateOrder();//Make sure that the client actually paid the right price for their order
			if ($IPNRequestValidation){
				$paypaLog->setValidated("yes");
			}
			else{
				$paypaLog->setValidated("no");
			}
		}
		else{
			$paypaLog->setVerified("no");
		}
		$paypaLog->save();
		
		if ($IPNRequestVerification && $IPNRequestValidation){
			$canCheckout = Module_Cart::canUserCheckout();
			if (count($canCheckout) == 0){
				$this->log("the request is verified and validated");
				return true;
			}
			else{
				$msg = "";
				foreach ($canCheckout as $key=>$value){
					$msg .= "$key= $value\n";
				}
				$this->log("the request is verified and validated BUT the user cannot buy the product because they didn't meet the minimum requirements\n$msg");
				$_SESSION['cart_checkout']['orderFailureReason'] = "The client cannot proceed with the payment because they didn't meet the minimum payment requirements";
				return false;
			}
		}
		else{
			$this->log("the request is either not verified or not validated");
			return false;
		}
	}
	
	public function verifyIPNRequest(){
		//The following function checks to see if the IPN request actually came from Paypal, or it is a hacker trying to bypass the payment
		$req = 'cmd=_notify-validate';
		foreach ($_POST as $key => $value) {
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
		}
		$this->log("New Request:\n\n" . $req, "a");
		//post back to PayPal system to validate
		$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		$fp = fsockopen("ssl://" . $this->hostName, 443, $errno, $errstr, 15);
		$this->log("ssl://" . $this->hostName);
		if (!$fp) {//Log an error
			$_SESSION['cart_checkout']['orderFailureReason'] = "Cannot connect with Paypal";
			$this->log("HTTP ERROR. ".$errstr." ".$errno." There was an issue processing your request. Please contact a system administrator.");
			return false;
		} 
		else {
			fputs ($fp, $header . $req);
			$res = "";
			while (!feof($fp)){
				$res .= fgets ($fp);
			}
			fclose ($fp);
			$this->log($res);
			$pieces = preg_split("*\r\n\r\n*", $res);
			$this->log($pieces[1]);
			if ($pieces[1] == "VERIFIED")
				return true;
		}
		$_SESSION['cart_checkout']['orderFailureReason'] = "The IPN couldn't be verified. This could be a potential hack attempt";
		return false;
	}

	public function validateOrder(){
		//The following function checks to ses if the user paid for what they ordered or not
		//First, make sure that the receiver is us:
		$this->log("Receiver is: " . $_POST["business"] . ", Our account is: " . $this->accountEmail);
		if ($_POST["business"] != $this->accountEmail){
			$_SESSION['cart_checkout']['orderFailureReason'] = "The money was paid to another user";
			return false;
		}
		
		$sessionID = $_POST["custom"];
		//Switch to the user's session. To do so, first we have to close the currenct session with Paypal.
		session_write_close();
		session_id($sessionID);//Then we have to assign the user's session ID
		session_start();//Then we can start a new session.
		
		$this->log("The ID of the session is: " . $sessionID);
		$this->log("The ID of the customer is: " . $_SESSION['authenticated_user']->getId());
		$this->log("Amount: " . $_POST["mc_gross"] . ", " . $_POST["mc_currency"]);
		
		$cartitems = CartBasket::getUserCartBaskets($_SESSION['authenticated_user']->getId());
		
		//Calculate the total amount of the client's order
		$tmpModule = new Module_Cart;
		$totalAmount = $tmpModule->getTotal();

		/*
		$totalAmount = 0.00;
		$tax = 0.00;
		foreach ($cartitems as $item) {
			$rate = CartTaxRate::getTaxRate($item->getProduct()->getTaxClass(), $_SESSION['cart_checkout']['address']['shipping_address'])->getRate();
			$taxValue = $rate * ($item->getPrice() * $item->getQuantity());
			$taxValue = ceil($taxValue);
			$taxValue = $taxValue / 100;
			$totalAmount += $item->getPrice() * $item->getQuantity() + $taxValue;
		}
		$shipping = @$_SESSION['cart_checkout']['shipping'];
		if ($shipping){
			$shippingCost = $shipping->getCost();
			$shippingCost = ceil($shippingCost * 100) / 100;
			$totalAmount += $shippingCost;
		}
		$totalAmount = ceil($totalAmount * 100) / 100;//Account for numbers such as: 19.6421 such amount will be rounded to 19.65
		*/
		//The currency of the client's order is always in Canadian Dollar. This needs to be tweaked so the admin will be able to set the currencies
		$currency = "CAD";
		
		$this->log("The order amount is: " . $totalAmount . ", " . $currency);
		//The reason why we're using the ceil function here is to account for the difference in calculating the taxes(if any)
		//For example, if paypal rounds the tax down (2.3487 becomes 2.34) and we round it up (2.3487 becomes 2.35), there should be no difference
		if (ceil($totalAmount) == ceil($_POST["mc_gross"]) && $currency == $_POST["mc_currency"]){
			$this->log("The client has paid for what they ordered");
			return true;
		}
		else{
			$this->log("The client has NOT paid for what they ordered");
			$_SESSION['cart_checkout']['orderFailureReason'] = "The client has NOT paid for what they ordered";
			return false;
		}
	}
}
?>