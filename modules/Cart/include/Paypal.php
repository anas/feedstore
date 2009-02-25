<?php

class Paypal extends Payment {
	
	public static function getForm() {
		$form = parent::getForm();
		$paypalHost = 'https://' . SiteConfig::get('Cart::PaypalHostName') . '/cgi-bin/webscr';
		$form->updateAttributes(array( 'action' => $paypalHost));
		$form->updateAttributes(array( 'onSubmit' => "return checkBeforeSendToPaypal()"));
		
		$form->setConstants( array ( 'cmd' => '_cart' ) );
		$form->addElement( 'hidden', 'cmd' );
		$form->setConstants( array ( 'upload' => 1 ) );
		$form->addElement( 'hidden', 'upload' );

		//Set the ID of the customer making this order
		$form->setConstants( array ( 'custom' => session_id() ) );
		$form->addElement( 'hidden', 'custom' );
		
		$form->setConstants( array ( 'currency_code' => "CAD" ) );
		$form->addElement( 'hidden', 'currency_code' );
		
		$form->setConstants( array ( 'business' => SiteConfig::get('Cart::PaypalBusinessEmailAddress') ) );
		$form->addElement( 'hidden', 'business' );

		$form->setConstants( array ( 'return' => "http://" . $_SERVER['HTTP_HOST'] . "/store/orderComplete" ) );
		$form->addElement( 'hidden', 'return' );
//		<input type="hidden" name="return" value="ordercomplete.php?req=success">		
		
		$items = CartBasket::getUserCartBaskets($_SESSION['authenticated_user']->getId());
		
		$count = 0;
		foreach ($items as $item) {
			$form->setConstants( array ( 'item_name_' . ++$count => $item->getProduct()->getName() ) );
			$form->addElement( 'hidden', 'item_name_' . $count );
			
			$form->setConstants( array ( 'item_number_' . $count => $item->getProduct()->getModel() ) );
			$form->addElement( 'hidden', 'item_number_' . $count );
			
			$form->setConstants( array ( 'amount_' . $count => round($item->getPrice(), 2) ) );
			$form->addElement( 'hidden', 'amount_' . $count );
			
			$form->setConstants( array ( 'quantity_' . $count => $item->getQuantity() ) );
			$form->addElement( 'hidden', 'quantity_' . $count );
			//The tax will be passed as one value
			//$taxRate = CartTaxRate::getTaxRate($item->getProduct()->getTaxClass(), $_SESSION['cart_checkout']['address']['shipping_address'])->getRate();
			//$taxValue = $taxRate * $item->getPrice();//Do not multiply by the quantity because paypal does it automatically
			//$taxValue = ceil($taxValue);
			//$taxValue = $taxValue / 100;
			//$form->setConstants( array ( 'tax_' . $count => $taxValue ) );
			//$form->addElement( 'hidden', 'tax_' . $count );
			
			//Charge the shipping cost only for the first item because the shipping cost will apply on all the items
			$shippingCost = 0;
			if ($count == 1){
				$shipping = @$_SESSION['cart_checkout']['shipping'];
				if ($shipping)
					$shippingCost = number_format($_SESSION['cart_checkout']['shipping']->getCost(), 2);
				$shippingCost = ceil($shippingCost * 100) / 100;
			}
			$form->setConstants( array ( 'shipping_' . $count => $shippingCost));
			$form->addElement( 'hidden', 'shipping_' . $count );
		}
		$temp = new Module_Cart();
		$form->setConstants( array ( 'tax_cart' => $temp->getTax() ) );
		$form->addElement( 'hidden', 'tax_cart');
		//$form->setConstants( array ( 'shipping' => number_format($_SESSION['cart_checkout']['shipping']->getCost(), 2) ) );
		//$form->addElement( 'hidden', 'shipping' );
		$form->addElement('image', 'cart_submit', 'https://www.paypal.com/en_US/i/btn/x-click-but23.gif');
		return $form;
	}
}
?>