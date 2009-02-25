<?php
/**
 * Payment
 * @author Christopher Troup <chris@norex.ca>
 * @package CMS
 * @version 2.0
 */

/**
 * DETAILED CLASS TITLE
 * 
 * DETAILED DESCRIPTION OF THE CLASS
 * @package CMS
 * @subpackage Core
 */
class Payment {

	/**
	 * Variable associated with `classname` column in table.
	 *
	 * @var string
	 */
	protected $class = null;
	
	/**
	 * Variable associated with `name` column in table.
	 *
	 * @var string
	 */
	protected $name = null;
	
	/**
	 * Variable associated with `description` column in table.
	 *
	 * @var string
	 */
	protected $description = null;
	
	/**
	 * Variable associated with `status` column in table.
	 *
	 * @var string
	 */
	protected $status = null;
	
	protected $order = null;
	
	/**
	 * Create an instance of the Payment class.
	 * 
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template Payment object is returned.
	 *
	 * @param int $classname
	 * @return Payment object
	 */
	public function __construct( $classname = null ) {
		if (!is_null($classname)) {
			$sql = 'select * from cart_payment where classname="' . $classname . '"';
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->setClass($result['classname']);
			$this->setName($result['name']);
			$this->setDescription($result['description']);
			$this->setStatus($result['status']);
		}
	}

	/**
	 * Returns the object's Class
	 *
	 * @return string
	 */
	public function getClass() {
		return $this->class;
	}

	/**
	 * Returns the object's Name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Returns the object's Description
	 *
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Returns the object's Status
	 *
	 * @return string
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * Sets the object's Class
	 *
	 * @param string $class New $this->class value
	 */
	public function setClass( $class ) {
		$this->class = $class;
	}

	/**
	 * Sets the object's Name
	 *
	 * @param string $name New $this->name value
	 */
	public function setName( $name ) {
		$this->name = $name;
	}

	/**
	 * Sets the object's Description
	 *
	 * @param string $description New $this->description value
	 */
	public function setDescription( $description ) {
		$this->description = $description;
	}

	/**
	 * Sets the object's Status
	 *
	 * @param string $status New $this->status value
	 */
	public function setStatus( $status ) {
		$this->status = $status;
	}
	
	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllPayments() {
		$sql = 'select `classname` from cart_payment where status=1';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = Payment::factory($result['classname']);
		}
		
		return $results;
	}
	
	public static function &factory( $type ) {
		require_once($type . '.php');
		$obj = new $type($type);
		return $obj;
	}
	
	public static function getForm() {
		$form = new Form('payment_form', 'payment_form', '/store/payment');
		
		$types = self::getAllPayments();
		$select_types = array();
		foreach ($types as $type) {
			$select_types[$type->getClass()] = $type->getName();
		}
		$defaults = array();
		if (isset($_SESSION['cart_checkout']['payment'])) {
			$defaults['pay_type'] = $_SESSION['cart_checkout']['payment']->getClass();
		} else {
			$_SESSION['cart_checkout']['payment'] = new Payment($type->getClass());
			$defaults['pay_type'] = $_SESSION['cart_checkout']['payment']->getClass();
		}
		$form->setDefaults($defaults);
		
		$form->addElement('select', 'pay_type', 'Payment Method', $select_types);

		$class = new $defaults['pay_type'];
		
		if (!isset($_SESSION['cart_checkout']['payment'])) {
			$form = $class->getForm(&$form);
		}
		
		return $form;
	}
	
	public function process($values=null) {
		//It seems that the parameter $values is not used at all
		//I gave it a default value of null.
		//Anas, 29, October, 2008
		
		$order = new CartOrder();
		
		$customer = $_SESSION['authenticated_user'];
		$billing_adr = $_SESSION['cart_checkout']['address']['billing_address'];
		$shipping_adr = $_SESSION['cart_checkout']['address']['shipping_address'];
		
		
		$payment = $_SESSION['cart_checkout']['payment'];
		$shipping = $_SESSION['cart_checkout']['shipping'];
		
		$order->setCustomer($customer->getId());
		$order->setCustomerName($customer->getName());
		$order->setCustomerAddress($billing_adr->getId());
		$order->setCustomerTelephone($customer->getPhone());
		$order->setCustomerEmail($customer->getEmail());
		
		$order->setBillingName($customer->getName());
		$order->setBillingAddress($billing_adr->getId());
		
		$order->setDeliveryName($customer->getName());
		$order->setDeliveryAddress($shipping_adr->getId());
		
		$order->setPaymentMethod($payment->getName());
		$order->setPaymentModuleCode($payment->getClass());
		
		$order->setShippingMethod($shipping->getName());
		$order->setShippingModuleCode($shipping->getClass());
		$order->setShippingCost($shipping->getCost());
		
		
		$order->setCurrency('CAD');
		$order->setCurrencyValue('1.000000');
		
		$order->setDeliveryDirections($_SESSION['cart_checkout']['delivery_direction']);
		$cartitems = CartBasket::getUserCartBaskets($_SESSION['authenticated_user']->getId());
		
		$subtotal = 0;
		$tax = 0;
		foreach ($cartitems as $item) {
			$subtotal += ($item->getPrice() * $item->getQuantity());
			$taxclass = $item->getProduct()->getTaxClass();
			$taxrate = CartTaxRate::getTaxRate($taxclass, $shipping_adr)->getRate();
			$tax += ($taxrate / 100) * ($item->getPrice() * $item->getQuantity());
		}
		
		$order->setSubTotal($subtotal);
		$order->setTax($tax);
		$order->setTotal($subtotal + $tax + $shipping->getCost());
		
		$order->setStatus(1);
		
		$order->setIp_address($_SERVER['REMOTE_ADDR']);
		$order->setDate_purchased(date('Y-m-d H:i:s'));
		$order->setPaypal_ipn_id(@$_REQUEST["txn_id"]);
		$order->save();
		foreach ($cartitems as $item) {
			$product = new CartOrderProduct();
			$product->setOrderId($order->getId());
			$product->setProduct($item->getProduct()->getId());
			
			$product->setModel($item->getProduct()->getModel());
			$product->setName($item->getProduct()->getName());
			$product->setPrice($item->getPrice());
			$product->setFinalPrice($item->getQuantity() * $item->getPrice());
			$product->setQuantity($item->getQuantity());
			
			$taxclass = $item->getProduct()->getTaxClass();
			
			$taxrate = CartTaxRate::getTaxRate($taxclass, $billing_adr)->getRate();
			
			$product->setTax($taxrate);
			$product->save();
			
			if ($item->getProduct()->getAttId()) {
				$product_atts = CartBasketAttribute::getCartBasketProductAttributes($item->getProduct()->getId() . ':' . $item->getProduct()->getAttId());
				foreach ($product_atts as $product_att) {
					
					$att = new CartOrderProductAttribute();
					$att->setOrderid($order->getId());
					$att->setProductid($product->getId());
					
					$option = new CartProductOption($product_att['products_options_id']); // works
					$att->setProducts_options($option->getName()); // works
					
					$option_value = new CartProductOptionValue($product_att['products_options_value_id']);
					$att->setProducts_options_values($option_value->getName());
					
					$sql = 'select * from cart_products_attributes where options_id=' . $product_att['products_options_id'] . ' and ';
					$sql .= 'options_values_id=' . $product_att['products_options_value_id'] . ' and ';
					$sql .= 'products_id=' . $item->getProduct()->getId();
					$r = Database::singleton()->query_fetch($sql);
					$att->setOptions_values_price($r['options_values_price']);
					
					$att->save();
				}
			}
		}
		
		$_SESSION['cart_checkout']['order'] = $order;
	}
	
	/*
	 * This is shown to the user when their required input is valid and the payment is
	 * complete (as far as the user checkout experience is concerned)
	 */
	public function complete( $smarty ) {
		$smarty->assign('order', $_SESSION['cart_checkout']['order']);
		
		$smarty->assign('ship_address', $_SESSION['cart_checkout']['address']['shipping_address']);
		$smarty->assign('bill_address', $_SESSION['cart_checkout']['address']['billing_address']);
		
		return $smarty->fetch('cart_order_complete.tpl');
	}
	
}
?>