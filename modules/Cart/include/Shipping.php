<?php

/**
 * Shipping
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
class Shipping {

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
	 * Variable associated with `classname` column in table.
	 *
	 * @var string
	 */
	protected $class = null;
	
	/**
	 * Create an instance of the Shipping class.
	 * 
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template Shipping object is returned.
	 *
	 * @param int $id
	 * @return Shipping object
	 */
	public function __construct( $id = null ) {
		if (!is_null($id)) {
			$sql = 'select * from cart_shipping where classname="' . $id . '"';
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->setName($result['name']);
			$this->setDescription($result['description']);
			$this->setClass($result['classname']);
		}
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
	 * Returns the object's Class
	 *
	 * @return string
	 */
	public function getClass() {
		return $this->class;
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
	 * Sets the object's Class
	 *
	 * @param string $class New $this->class value
	 */
	public function setClass( $class ) {
		$this->class = $class;
	}
	
	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllShippings() {
		$sql = 'select `classname` from cart_shipping';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new Shipping($result['classname']);
		}
		
		return $results;
	}
	
	public static function &factory( $type ) {
		require_once($type . '.php');
		
		$obj = new $type($type);
		return $obj;
	}

	public function getCost() {
		/*
		 * The shipping cost is calculated as the following:
		 * The pallet count is how many items can fit onto one "pallet".
		 * We ship items by pallets and determine our delivery costs by how many pallets are shipped. 
		 * If we're shipping 20 bags of product X and 40 bags of products Y where:
		 * pallet count of X is 10
		 * pallet count of Y is 5
		 * That means that we are shipping: 2 pallets for X and 8 pallets for Y. Thus 10 pallets in total
		 * 
		 * The Shipping rates will be determined by the number of pallets each order makes up AND also by the total cost (before GST) for the order.
		 * Freight charges:
		 * $70/ pallet on orders up to $499
		 * $60/pallet on orders $550 - $999
		 * $50/pallet on orders +$1000
		 */
		if (isset($_SESSION['authenticated_user'])) {
			$cartitems = CartBasket::getUserCartBaskets($_SESSION['authenticated_user']->getId());
		} else {
			$cartitems = CartBasket::getUserCartBaskets();
		}
		
		$totalAmount = 0.00;
		$palletCount = 0.00;
		foreach ($cartitems as $item) {
			$totalAmount += $item->getPrice() * $item->getQuantity();
			if ($item->getProduct()->getPalletCount() != 0){
				$palletCount += $item->getQuantity() / $item->getProduct()->getPalletCount();
			}
			else{
				$palletCount += 0;
			}
		}
		$palletCount = ceil($palletCount);//Round up the number of pallets to an integer number
		if ($totalAmount >= 1000)
			return SiteConfig::get("Cart::ShippingCostMoreThan1000") * $palletCount;
		elseif ($totalAmount >= 500)
			return SiteConfig::get("Cart::ShippingCostLessThan999") * $palletCount;
		else
			return SiteConfig::get("Cart::ShippingCostLessThan499") * $palletCount;
	}
	
	public static function getForm() {
		$form = new Form('shipping_form', 'shipping_form', '/store/payment');
		
		$types = self::getAllShippings();
		
		if (isset($_SESSION['cart_checkout']['shipping'])) {
			$defaultValues ['ship_type'] = $_SESSION['cart_checkout']['shipping']->getClass();
			$form->setDefaults( $defaultValues );
		}
		
		foreach ($types as $type) {
			$form->addElement('radio', 'ship_type', null, $type->getName(), $type->getClass());
		}
		$form->updateElementAttr('ship_type', array('onchange'=>'return !updateShipping(this);'));
		
		return $form;
	}
}

?>