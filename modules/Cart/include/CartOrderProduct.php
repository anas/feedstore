<?php
/**
 * CartOrderProduct
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
class CartOrderProduct {

	/**
	 * Variable associated with `orders_products_id` column in table.
	 *
	 * @var string
	 */
	protected $id = null;
	
	/**
	 * Variable associated with `orders_id` column in table.
	 *
	 * @var string
	 */
	protected $orderId = null;
	
	/**
	 * Variable associated with `products_id` column in table.
	 *
	 * @var string
	 */
	protected $product = null;
	
	/**
	 * Variable associated with `products_model` column in table.
	 *
	 * @var string
	 */
	protected $model = null;
	
	/**
	 * Variable associated with `products_name` column in table.
	 *
	 * @var string
	 */
	protected $name = null;
	
	/**
	 * Variable associated with `products_price` column in table.
	 *
	 * @var string
	 */
	protected $price = null;
	
	/**
	 * Variable associated with `final_price` column in table.
	 *
	 * @var string
	 */
	protected $finalPrice = null;
	
	/**
	 * Variable associated with `products_tax` column in table.
	 *
	 * @var string
	 */
	protected $tax = null;
	
	/**
	 * Variable associated with `products_quantity` column in table.
	 *
	 * @var string
	 */
	protected $quantity = null;
	
	/**
	 * Variable associated with `onetime_charges` column in table.
	 *
	 * @var string
	 */
	protected $oneTimeCharges = null;
	
	/**
	 * Variable associated with `products_priced_by_attribute` column in table.
	 *
	 * @var string
	 */
	protected $pricedByAttribute = null;
	
	/**
	 * Variable associated with `product_is_free` column in table.
	 *
	 * @var string
	 */
	protected $isFree = null;
	
	/**
	 * Variable associated with `products_discount_type` column in table.
	 *
	 * @var string
	 */
	protected $discountType = null;
	
	/**
	 * Variable associated with `products_discount_type_from` column in table.
	 *
	 * @var string
	 */
	protected $discountTypeFrom = null;
	
	/**
	 * Variable associated with `products_prid` column in table.
	 *
	 * @var string
	 */
	protected $prid = null;
	
	/**
	 * Create an instance of the CartOrderProduct class.
	 * 
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template CartOrderProduct object is returned.
	 *
	 * @param int $orders_products_id
	 * @return CartOrderProduct object
	 */
	public function __construct( $orders_products_id = null ) {
		if (!is_null($orders_products_id)) {
			$sql = 'select * from cart_orders_products where orders_products_id=' . $orders_products_id;
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->setId($result['orders_products_id']);
			$this->setOrderId($result['orders_id']);
			$this->setProduct($result['products_id']);
			$this->setModel($result['products_model']);
			$this->setName($result['products_name']);
			$this->setPrice($result['products_price']);
			$this->setFinalPrice($result['final_price']);
			$this->setTax($result['products_tax']);
			$this->setQuantity($result['products_quantity']);
			$this->setOneTimeCharges($result['onetime_charges']);
			$this->setPricedByAttribute($result['products_priced_by_attribute']);
			$this->setIsFree($result['product_is_free']);
			$this->setDiscountType($result['products_discount_type']);
			$this->setDiscountTypeFrom($result['products_discount_type_from']);
			$this->setPrid($result['products_prid']);
		}
	}

	/**
	 * Returns the object's Id
	 *
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Returns the object's OrderId
	 *
	 * @return string
	 */
	public function getOrderId() {
		return $this->orderId;
	}

	/**
	 * Returns the object's Product
	 *
	 * @return string
	 */
	public function getProduct() {
		return $this->product;
	}

	/**
	 * Returns the object's Model
	 *
	 * @return string
	 */
	public function getModel() {
		return $this->model;
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
	 * Returns the object's Price
	 *
	 * @return string
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * Returns the object's FinalPrice
	 *
	 * @return string
	 */
	public function getFinalPrice() {
		return $this->finalPrice;
	}

	/**
	 * Returns the object's Tax
	 *
	 * @return string
	 */
	public function getTax() {
		return $this->tax;
	}

	/**
	 * Returns the object's Quantity
	 *
	 * @return string
	 */
	public function getQuantity() {
		return $this->quantity;
	}

	/**
	 * Returns the object's OneTimeCharges
	 *
	 * @return string
	 */
	public function getOneTimeCharges() {
		return $this->oneTimeCharges;
	}

	/**
	 * Returns the object's PricedByAttribute
	 *
	 * @return string
	 */
	public function getPricedByAttribute() {
		return $this->pricedByAttribute;
	}

	/**
	 * Returns the object's IsFree
	 *
	 * @return string
	 */
	public function getIsFree() {
		return $this->isFree;
	}

	/**
	 * Returns the object's DiscountType
	 *
	 * @return string
	 */
	public function getDiscountType() {
		return $this->discountType;
	}

	/**
	 * Returns the object's DiscountTypeFrom
	 *
	 * @return string
	 */
	public function getDiscountTypeFrom() {
		return $this->discountTypeFrom;
	}

	/**
	 * Returns the object's Prid
	 *
	 * @return string
	 */
	public function getPrid() {
		return $this->prid;
	}

	/**
	 * Sets the object's Id
	 *
	 * @param string $id New $this->id value
	 */
	public function setId( $id ) {
		$this->id = $id;
	}

	/**
	 * Sets the object's OrderId
	 *
	 * @param string $orderId New $this->orderId value
	 */
	public function setOrderId( $orderId ) {
		$this->orderId = $orderId;
	}

	/**
	 * Sets the object's Product
	 *
	 * @param string $product New $this->product value
	 */
	public function setProduct( $product ) {
		require_once('CartProduct.php');
		$this->product = new CartProduct($product);
	}

	/**
	 * Sets the object's Model
	 *
	 * @param string $model New $this->model value
	 */
	public function setModel( $model ) {
		$this->model = $model;
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
	 * Sets the object's Price
	 *
	 * @param string $price New $this->price value
	 */
	public function setPrice( $price ) {
		$this->price = $price;
	}

	/**
	 * Sets the object's FinalPrice
	 *
	 * @param string $finalPrice New $this->finalPrice value
	 */
	public function setFinalPrice( $finalPrice ) {
		$this->finalPrice = $finalPrice;
	}

	/**
	 * Sets the object's Tax
	 *
	 * @param string $tax New $this->tax value
	 */
	public function setTax( $tax ) {
		$this->tax = $tax;
	}

	/**
	 * Sets the object's Quantity
	 *
	 * @param string $quantity New $this->quantity value
	 */
	public function setQuantity( $quantity ) {
		$this->quantity = $quantity;
	}

	/**
	 * Sets the object's OneTimeCharges
	 *
	 * @param string $oneTimeCharges New $this->oneTimeCharges value
	 */
	public function setOneTimeCharges( $oneTimeCharges ) {
		$this->oneTimeCharges = $oneTimeCharges;
	}

	/**
	 * Sets the object's PricedByAttribute
	 *
	 * @param string $pricedByAttribute New $this->pricedByAttribute value
	 */
	public function setPricedByAttribute( $pricedByAttribute ) {
		$this->pricedByAttribute = $pricedByAttribute;
	}

	/**
	 * Sets the object's IsFree
	 *
	 * @param string $isFree New $this->isFree value
	 */
	public function setIsFree( $isFree ) {
		$this->isFree = $isFree;
	}

	/**
	 * Sets the object's DiscountType
	 *
	 * @param string $discountType New $this->discountType value
	 */
	public function setDiscountType( $discountType ) {
		$this->discountType = $discountType;
	}

	/**
	 * Sets the object's DiscountTypeFrom
	 *
	 * @param string $discountTypeFrom New $this->discountTypeFrom value
	 */
	public function setDiscountTypeFrom( $discountTypeFrom ) {
		$this->discountTypeFrom = $discountTypeFrom;
	}

	/**
	 * Sets the object's Prid
	 *
	 * @param string $prid New $this->prid value
	 */
	public function setPrid( $prid ) {
		$this->prid = $prid;
	}


	/**
	 * Save the object in the database
	 */
	public function save() {
		if (!is_null($this->getId())) {
			$sql = 'update cart_orders_products set ';
		} else {
			$sql = 'insert into cart_orders_products set ';
		}
		if (!is_null($this->getOrderId())) {
			$sql .= '`orders_id`="' . e($this->getOrderId()) . '", ';
		}
		if (!is_null($this->getProduct())) {
			$sql .= '`products_id`="' . e($this->getProduct()->getId()) . '", ';
		}
		if (!is_null($this->getModel())) {
			$sql .= '`products_model`="' . e($this->getModel()) . '", ';
		}
		if (!is_null($this->getName())) {
			$sql .= '`products_name`="' . e($this->getName()) . '", ';
		}
		if (!is_null($this->getPrice())) {
			$sql .= '`products_price`="' . e($this->getPrice()) . '", ';
		}
		if (!is_null($this->getFinalPrice())) {
			$sql .= '`final_price`="' . e($this->getFinalPrice()) . '", ';
		}
		if (!is_null($this->getTax())) {
			$sql .= '`products_tax`="' . e($this->getTax()) . '", ';
		}
		if (!is_null($this->getQuantity())) {
			$sql .= '`products_quantity`="' . e($this->getQuantity()) . '", ';
		}
		if (!is_null($this->getOneTimeCharges())) {
			$sql .= '`onetime_charges`="' . e($this->getOneTimeCharges()) . '", ';
		}
		if (!is_null($this->getPricedByAttribute())) {
			$sql .= '`products_priced_by_attribute`="' . e($this->getPricedByAttribute()) . '", ';
		}
		if (!is_null($this->getIsFree())) {
			$sql .= '`product_is_free`="' . e($this->getIsFree()) . '", ';
		}
		if (!is_null($this->getDiscountType())) {
			$sql .= '`products_discount_type`="' . e($this->getDiscountType()) . '", ';
		}
		if (!is_null($this->getDiscountTypeFrom())) {
			$sql .= '`products_discount_type_from`="' . e($this->getDiscountTypeFrom()) . '", ';
		}
		if (!is_null($this->getPrid())) {
			$sql .= '`products_prid`="' . e($this->getPrid()) . '", ';
		}
		if (!is_null($this->getId())) {
			$sql .= 'orders_products_id="' . e($this->getId()) . '" where orders_products_id="' . e($this->getId()) . '"';
		} else {
			$sql = trim($sql, ', ');
		}
		Database::singleton()->query($sql);
		if (is_null($this->getId())) {
			$this->setId(Database::singleton()->lastInsertedID());
			self::__construct($this->getId());
		}
	}

	/**
	 * Delete the object from the database
	 */
	public function delete() {
		$sql = 'delete from cart_orders_products where orders_products_id="' . e($this->getId()) . '"';
		Database::singleton()->query($sql);
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/CartOrderProduct') {
		$form = new Form('CartOrderProduct_addedit', 'post', $target);
		
		$form->setConstants( array ( 'section' => 'addedit' ) );
		$form->addElement( 'hidden', 'section' );
		
		if (!is_null($this->getId())) {
			$form->setConstants( array ( 'cartorderproduct_orders_products_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'cartorderproduct_orders_products_id' );
			
			$defaultValues ['cartorderproduct_orderId'] = $this->getOrderId();
			$defaultValues ['cartorderproduct_product'] = $this->getProduct()->getId();
			$defaultValues ['cartorderproduct_model'] = $this->getModel();
			$defaultValues ['cartorderproduct_name'] = $this->getName();
			$defaultValues ['cartorderproduct_price'] = $this->getPrice();
			$defaultValues ['cartorderproduct_finalPrice'] = $this->getFinalPrice();
			$defaultValues ['cartorderproduct_tax'] = $this->getTax();
			$defaultValues ['cartorderproduct_quantity'] = $this->getQuantity();
			$defaultValues ['cartorderproduct_oneTimeCharges'] = $this->getOneTimeCharges();
			$defaultValues ['cartorderproduct_pricedByAttribute'] = $this->getPricedByAttribute();
			$defaultValues ['cartorderproduct_isFree'] = $this->getIsFree();
			$defaultValues ['cartorderproduct_discountType'] = $this->getDiscountType();
			$defaultValues ['cartorderproduct_discountTypeFrom'] = $this->getDiscountTypeFrom();
			$defaultValues ['cartorderproduct_prid'] = $this->getPrid();

			$form->setDefaults( $defaultValues );
		}
					
		$form->addElement('text', 'cartorderproduct_orderId', 'orderId');
		$form->addElement('text', 'cartorderproduct_product', 'product');
		$form->addElement('text', 'cartorderproduct_model', 'model');
		$form->addElement('text', 'cartorderproduct_name', 'name');
		$form->addElement('text', 'cartorderproduct_price', 'price');
		$form->addElement('text', 'cartorderproduct_finalPrice', 'finalPrice');
		$form->addElement('text', 'cartorderproduct_tax', 'tax');
		$form->addElement('text', 'cartorderproduct_quantity', 'quantity');
		$form->addElement('text', 'cartorderproduct_oneTimeCharges', 'oneTimeCharges');
		$form->addElement('text', 'cartorderproduct_pricedByAttribute', 'pricedByAttribute');
		$form->addElement('text', 'cartorderproduct_isFree', 'isFree');
		$form->addElement('text', 'cartorderproduct_discountType', 'discountType');
		$form->addElement('text', 'cartorderproduct_discountTypeFrom', 'discountTypeFrom');
		$form->addElement('text', 'cartorderproduct_prid', 'prid');
		$form->addElement('submit', 'cartorderproduct_submit', 'Submit');

		if ($form->validate() && $form->isSubmitted()) {
			$this->setOrderId($form->exportValue('cartorderproduct_orderId'));
			$this->setProduct($form->exportValue('cartorderproduct_product'));
			$this->setModel($form->exportValue('cartorderproduct_model'));
			$this->setName($form->exportValue('cartorderproduct_name'));
			$this->setPrice($form->exportValue('cartorderproduct_price'));
			$this->setFinalPrice($form->exportValue('cartorderproduct_finalPrice'));
			$this->setTax($form->exportValue('cartorderproduct_tax'));
			$this->setQuantity($form->exportValue('cartorderproduct_quantity'));
			$this->setOneTimeCharges($form->exportValue('cartorderproduct_oneTimeCharges'));
			$this->setPricedByAttribute($form->exportValue('cartorderproduct_pricedByAttribute'));
			$this->setIsFree($form->exportValue('cartorderproduct_isFree'));
			$this->setDiscountType($form->exportValue('cartorderproduct_discountType'));
			$this->setDiscountTypeFrom($form->exportValue('cartorderproduct_discountTypeFrom'));
			$this->setPrid($form->exportValue('cartorderproduct_prid'));
			$this->save();
		}

		return $form;
		
	}
	
	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllCartOrderProducts() {
		$sql = 'select `orders_products_id` from cart_orders_products';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new CartOrderProduct($result['orders_products_id']);
		}
		
		return $results;
	}
	
	public function getOrderProductAttributes() {
		$sql = 'select * from cart_orders_products_attributes where orders_id=' . $this->getOrderId() . ' and orders_products_id=' . $this->getId();
		$rs = Database::singleton()->query_fetch_all($sql);
		return $rs;
	}
	
}
?>