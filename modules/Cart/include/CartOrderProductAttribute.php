<?php
/**
 * CartOrderProductAttribute
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
class CartOrderProductAttribute {

	/**
	 * Variable associated with `orders_products_attributes_id` column in table.
	 *
	 * @var string
	 */
	protected $id = null;
	
	/**
	 * Variable associated with `orders_id` column in table.
	 *
	 * @var string
	 */
	protected $orderid = null;
	
	/**
	 * Variable associated with `orders_products_id` column in table.
	 *
	 * @var string
	 */
	protected $productid = null;
	
	/**
	 * Variable associated with `products_options` column in table.
	 *
	 * @var string
	 */
	protected $products_options = null;
	
	/**
	 * Variable associated with `products_options_values` column in table.
	 *
	 * @var string
	 */
	protected $products_options_values = null;
	
	/**
	 * Variable associated with `options_values_price` column in table.
	 *
	 * @var string
	 */
	protected $options_values_price = null;
	
	/**
	 * Variable associated with `price_prefix` column in table.
	 *
	 * @var string
	 */
	protected $price_prefix = null;
	
	/**
	 * Variable associated with `product_attribute_is_free` column in table.
	 *
	 * @var string
	 */
	protected $product_attribute_is_free = null;
	
	/**
	 * Variable associated with `products_attributes_weight` column in table.
	 *
	 * @var string
	 */
	protected $products_attributes_weight = null;
	
	/**
	 * Variable associated with `products_attributes_weight_prefix` column in table.
	 *
	 * @var string
	 */
	protected $products_attributes_weight_prefix = null;
	
	/**
	 * Variable associated with `attributes_discounted` column in table.
	 *
	 * @var string
	 */
	protected $attributes_discounted = null;
	
	/**
	 * Variable associated with `attributes_price_base_included` column in table.
	 *
	 * @var string
	 */
	protected $attributes_price_base_included = null;
	
	/**
	 * Variable associated with `attributes_price_onetime` column in table.
	 *
	 * @var string
	 */
	protected $attributes_price_onetime = null;
	
	/**
	 * Variable associated with `attributes_price_factor` column in table.
	 *
	 * @var string
	 */
	protected $attributes_price_factor = null;
	
	/**
	 * Variable associated with `attributes_price_factor_offset` column in table.
	 *
	 * @var string
	 */
	protected $attributes_price_factor_offset = null;
	
	/**
	 * Variable associated with `attributes_price_factor_onetime` column in table.
	 *
	 * @var string
	 */
	protected $attributes_price_factor_onetime = null;
	
	/**
	 * Variable associated with `attributes_price_factor_onetime_offset` column in table.
	 *
	 * @var string
	 */
	protected $attributes_price_factor_onetime_offset = null;
	
	/**
	 * Variable associated with `attributes_qty_prices` column in table.
	 *
	 * @var string
	 */
	protected $attributes_qty_prices = null;
	
	/**
	 * Variable associated with `attributes_qty_prices_onetime` column in table.
	 *
	 * @var string
	 */
	protected $attributes_qty_prices_onetime = null;
	
	/**
	 * Variable associated with `attributes_price_words` column in table.
	 *
	 * @var string
	 */
	protected $attributes_price_words = null;
	
	/**
	 * Variable associated with `attributes_price_words_free` column in table.
	 *
	 * @var string
	 */
	protected $attributes_price_words_free = null;
	
	/**
	 * Variable associated with `attributes_price_letters` column in table.
	 *
	 * @var string
	 */
	protected $attributes_price_letters = null;
	
	/**
	 * Variable associated with `attributes_price_letters_free` column in table.
	 *
	 * @var string
	 */
	protected $attributes_price_letters_free = null;
	
	/**
	 * Variable associated with `products_options_id` column in table.
	 *
	 * @var string
	 */
	protected $products_options_id = null;
	
	/**
	 * Variable associated with `products_options_values_id` column in table.
	 *
	 * @var string
	 */
	protected $products_options_values_id = null;
	
	/**
	 * Variable associated with `products_prid` column in table.
	 *
	 * @var string
	 */
	protected $products_prid = null;
	
	/**
	 * Create an instance of the CartOrderProductAttribute class.
	 * 
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template CartOrderProductAttribute object is returned.
	 *
	 * @param int $orders_products_attributes_id
	 * @return CartOrderProductAttribute object
	 */
	public function __construct( $orders_products_attributes_id = null ) {
		if (!is_null($orders_products_attributes_id)) {
			$sql = 'select * from cart_orders_products_attributes where orders_products_attributes_id=' . $orders_products_attributes_id;
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->setId($result['orders_products_attributes_id']);
			$this->setOrderid($result['orders_id']);
			$this->setProductid($result['orders_products_id']);
			$this->setProducts_options($result['products_options']);
			$this->setProducts_options_values($result['products_options_values']);
			$this->setOptions_values_price($result['options_values_price']);
			$this->setPrice_prefix($result['price_prefix']);
			$this->setProduct_attribute_is_free($result['product_attribute_is_free']);
			$this->setProducts_attributes_weight($result['products_attributes_weight']);
			$this->setProducts_attributes_weight_prefix($result['products_attributes_weight_prefix']);
			$this->setAttributes_discounted($result['attributes_discounted']);
			$this->setAttributes_price_base_included($result['attributes_price_base_included']);
			$this->setAttributes_price_onetime($result['attributes_price_onetime']);
			$this->setAttributes_price_factor($result['attributes_price_factor']);
			$this->setAttributes_price_factor_offset($result['attributes_price_factor_offset']);
			$this->setAttributes_price_factor_onetime($result['attributes_price_factor_onetime']);
			$this->setAttributes_price_factor_onetime_offset($result['attributes_price_factor_onetime_offset']);
			$this->setAttributes_qty_prices($result['attributes_qty_prices']);
			$this->setAttributes_qty_prices_onetime($result['attributes_qty_prices_onetime']);
			$this->setAttributes_price_words($result['attributes_price_words']);
			$this->setAttributes_price_words_free($result['attributes_price_words_free']);
			$this->setAttributes_price_letters($result['attributes_price_letters']);
			$this->setAttributes_price_letters_free($result['attributes_price_letters_free']);
			$this->setProducts_options_id($result['products_options_id']);
			$this->setProducts_options_values_id($result['products_options_values_id']);
			$this->setProducts_prid($result['products_prid']);
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
	 * Returns the object's Orderid
	 *
	 * @return string
	 */
	public function getOrderid() {
		return $this->orderid;
	}

	/**
	 * Returns the object's Productid
	 *
	 * @return string
	 */
	public function getProductid() {
		return $this->productid;
	}

	/**
	 * Returns the object's Products_options
	 *
	 * @return string
	 */
	public function getProducts_options() {
		return $this->products_options;
	}

	/**
	 * Returns the object's Products_options_values
	 *
	 * @return string
	 */
	public function getProducts_options_values() {
		return $this->products_options_values;
	}

	/**
	 * Returns the object's Options_values_price
	 *
	 * @return string
	 */
	public function getOptions_values_price() {
		return $this->options_values_price;
	}

	/**
	 * Returns the object's Price_prefix
	 *
	 * @return string
	 */
	public function getPrice_prefix() {
		return $this->price_prefix;
	}

	/**
	 * Returns the object's Product_attribute_is_free
	 *
	 * @return string
	 */
	public function getProduct_attribute_is_free() {
		return $this->product_attribute_is_free;
	}

	/**
	 * Returns the object's Products_attributes_weight
	 *
	 * @return string
	 */
	public function getProducts_attributes_weight() {
		return $this->products_attributes_weight;
	}

	/**
	 * Returns the object's Products_attributes_weight_prefix
	 *
	 * @return string
	 */
	public function getProducts_attributes_weight_prefix() {
		return $this->products_attributes_weight_prefix;
	}

	/**
	 * Returns the object's Attributes_discounted
	 *
	 * @return string
	 */
	public function getAttributes_discounted() {
		return $this->attributes_discounted;
	}

	/**
	 * Returns the object's Attributes_price_base_included
	 *
	 * @return string
	 */
	public function getAttributes_price_base_included() {
		return $this->attributes_price_base_included;
	}

	/**
	 * Returns the object's Attributes_price_onetime
	 *
	 * @return string
	 */
	public function getAttributes_price_onetime() {
		return $this->attributes_price_onetime;
	}

	/**
	 * Returns the object's Attributes_price_factor
	 *
	 * @return string
	 */
	public function getAttributes_price_factor() {
		return $this->attributes_price_factor;
	}

	/**
	 * Returns the object's Attributes_price_factor_offset
	 *
	 * @return string
	 */
	public function getAttributes_price_factor_offset() {
		return $this->attributes_price_factor_offset;
	}

	/**
	 * Returns the object's Attributes_price_factor_onetime
	 *
	 * @return string
	 */
	public function getAttributes_price_factor_onetime() {
		return $this->attributes_price_factor_onetime;
	}

	/**
	 * Returns the object's Attributes_price_factor_onetime_offset
	 *
	 * @return string
	 */
	public function getAttributes_price_factor_onetime_offset() {
		return $this->attributes_price_factor_onetime_offset;
	}

	/**
	 * Returns the object's Attributes_qty_prices
	 *
	 * @return string
	 */
	public function getAttributes_qty_prices() {
		return $this->attributes_qty_prices;
	}

	/**
	 * Returns the object's Attributes_qty_prices_onetime
	 *
	 * @return string
	 */
	public function getAttributes_qty_prices_onetime() {
		return $this->attributes_qty_prices_onetime;
	}

	/**
	 * Returns the object's Attributes_price_words
	 *
	 * @return string
	 */
	public function getAttributes_price_words() {
		return $this->attributes_price_words;
	}

	/**
	 * Returns the object's Attributes_price_words_free
	 *
	 * @return string
	 */
	public function getAttributes_price_words_free() {
		return $this->attributes_price_words_free;
	}

	/**
	 * Returns the object's Attributes_price_letters
	 *
	 * @return string
	 */
	public function getAttributes_price_letters() {
		return $this->attributes_price_letters;
	}

	/**
	 * Returns the object's Attributes_price_letters_free
	 *
	 * @return string
	 */
	public function getAttributes_price_letters_free() {
		return $this->attributes_price_letters_free;
	}

	/**
	 * Returns the object's Products_options_id
	 *
	 * @return string
	 */
	public function getProducts_options_id() {
		return $this->products_options_id;
	}

	/**
	 * Returns the object's Products_options_values_id
	 *
	 * @return string
	 */
	public function getProducts_options_values_id() {
		return $this->products_options_values_id;
	}

	/**
	 * Returns the object's Products_prid
	 *
	 * @return string
	 */
	public function getProducts_prid() {
		return $this->products_prid;
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
	 * Sets the object's Orderid
	 *
	 * @param string $orderid New $this->orderid value
	 */
	public function setOrderid( $orderid ) {
		$this->orderid = $orderid;
	}

	/**
	 * Sets the object's Productid
	 *
	 * @param string $productid New $this->productid value
	 */
	public function setProductid( $productid ) {
		$this->productid = $productid;
	}

	/**
	 * Sets the object's Products_options
	 *
	 * @param string $products_options New $this->products_options value
	 */
	public function setProducts_options( $products_options ) {
		$this->products_options = $products_options;
	}

	/**
	 * Sets the object's Products_options_values
	 *
	 * @param string $products_options_values New $this->products_options_values value
	 */
	public function setProducts_options_values( $products_options_values ) {
		$this->products_options_values = $products_options_values;
	}

	/**
	 * Sets the object's Options_values_price
	 *
	 * @param string $options_values_price New $this->options_values_price value
	 */
	public function setOptions_values_price( $options_values_price ) {
		$this->options_values_price = $options_values_price;
	}

	/**
	 * Sets the object's Price_prefix
	 *
	 * @param string $price_prefix New $this->price_prefix value
	 */
	public function setPrice_prefix( $price_prefix ) {
		$this->price_prefix = $price_prefix;
	}

	/**
	 * Sets the object's Product_attribute_is_free
	 *
	 * @param string $product_attribute_is_free New $this->product_attribute_is_free value
	 */
	public function setProduct_attribute_is_free( $product_attribute_is_free ) {
		$this->product_attribute_is_free = $product_attribute_is_free;
	}

	/**
	 * Sets the object's Products_attributes_weight
	 *
	 * @param string $products_attributes_weight New $this->products_attributes_weight value
	 */
	public function setProducts_attributes_weight( $products_attributes_weight ) {
		$this->products_attributes_weight = $products_attributes_weight;
	}

	/**
	 * Sets the object's Products_attributes_weight_prefix
	 *
	 * @param string $products_attributes_weight_prefix New $this->products_attributes_weight_prefix value
	 */
	public function setProducts_attributes_weight_prefix( $products_attributes_weight_prefix ) {
		$this->products_attributes_weight_prefix = $products_attributes_weight_prefix;
	}

	/**
	 * Sets the object's Attributes_discounted
	 *
	 * @param string $attributes_discounted New $this->attributes_discounted value
	 */
	public function setAttributes_discounted( $attributes_discounted ) {
		$this->attributes_discounted = $attributes_discounted;
	}

	/**
	 * Sets the object's Attributes_price_base_included
	 *
	 * @param string $attributes_price_base_included New $this->attributes_price_base_included value
	 */
	public function setAttributes_price_base_included( $attributes_price_base_included ) {
		$this->attributes_price_base_included = $attributes_price_base_included;
	}

	/**
	 * Sets the object's Attributes_price_onetime
	 *
	 * @param string $attributes_price_onetime New $this->attributes_price_onetime value
	 */
	public function setAttributes_price_onetime( $attributes_price_onetime ) {
		$this->attributes_price_onetime = $attributes_price_onetime;
	}

	/**
	 * Sets the object's Attributes_price_factor
	 *
	 * @param string $attributes_price_factor New $this->attributes_price_factor value
	 */
	public function setAttributes_price_factor( $attributes_price_factor ) {
		$this->attributes_price_factor = $attributes_price_factor;
	}

	/**
	 * Sets the object's Attributes_price_factor_offset
	 *
	 * @param string $attributes_price_factor_offset New $this->attributes_price_factor_offset value
	 */
	public function setAttributes_price_factor_offset( $attributes_price_factor_offset ) {
		$this->attributes_price_factor_offset = $attributes_price_factor_offset;
	}

	/**
	 * Sets the object's Attributes_price_factor_onetime
	 *
	 * @param string $attributes_price_factor_onetime New $this->attributes_price_factor_onetime value
	 */
	public function setAttributes_price_factor_onetime( $attributes_price_factor_onetime ) {
		$this->attributes_price_factor_onetime = $attributes_price_factor_onetime;
	}

	/**
	 * Sets the object's Attributes_price_factor_onetime_offset
	 *
	 * @param string $attributes_price_factor_onetime_offset New $this->attributes_price_factor_onetime_offset value
	 */
	public function setAttributes_price_factor_onetime_offset( $attributes_price_factor_onetime_offset ) {
		$this->attributes_price_factor_onetime_offset = $attributes_price_factor_onetime_offset;
	}

	/**
	 * Sets the object's Attributes_qty_prices
	 *
	 * @param string $attributes_qty_prices New $this->attributes_qty_prices value
	 */
	public function setAttributes_qty_prices( $attributes_qty_prices ) {
		$this->attributes_qty_prices = $attributes_qty_prices;
	}

	/**
	 * Sets the object's Attributes_qty_prices_onetime
	 *
	 * @param string $attributes_qty_prices_onetime New $this->attributes_qty_prices_onetime value
	 */
	public function setAttributes_qty_prices_onetime( $attributes_qty_prices_onetime ) {
		$this->attributes_qty_prices_onetime = $attributes_qty_prices_onetime;
	}

	/**
	 * Sets the object's Attributes_price_words
	 *
	 * @param string $attributes_price_words New $this->attributes_price_words value
	 */
	public function setAttributes_price_words( $attributes_price_words ) {
		$this->attributes_price_words = $attributes_price_words;
	}

	/**
	 * Sets the object's Attributes_price_words_free
	 *
	 * @param string $attributes_price_words_free New $this->attributes_price_words_free value
	 */
	public function setAttributes_price_words_free( $attributes_price_words_free ) {
		$this->attributes_price_words_free = $attributes_price_words_free;
	}

	/**
	 * Sets the object's Attributes_price_letters
	 *
	 * @param string $attributes_price_letters New $this->attributes_price_letters value
	 */
	public function setAttributes_price_letters( $attributes_price_letters ) {
		$this->attributes_price_letters = $attributes_price_letters;
	}

	/**
	 * Sets the object's Attributes_price_letters_free
	 *
	 * @param string $attributes_price_letters_free New $this->attributes_price_letters_free value
	 */
	public function setAttributes_price_letters_free( $attributes_price_letters_free ) {
		$this->attributes_price_letters_free = $attributes_price_letters_free;
	}

	/**
	 * Sets the object's Products_options_id
	 *
	 * @param string $products_options_id New $this->products_options_id value
	 */
	public function setProducts_options_id( $products_options_id ) {
		$this->products_options_id = $products_options_id;
	}

	/**
	 * Sets the object's Products_options_values_id
	 *
	 * @param string $products_options_values_id New $this->products_options_values_id value
	 */
	public function setProducts_options_values_id( $products_options_values_id ) {
		$this->products_options_values_id = $products_options_values_id;
	}

	/**
	 * Sets the object's Products_prid
	 *
	 * @param string $products_prid New $this->products_prid value
	 */
	public function setProducts_prid( $products_prid ) {
		$this->products_prid = $products_prid;
	}


	/**
	 * Save the object in the database
	 */
	public function save() {
		if (!is_null($this->getId())) {
			$sql = 'update cart_orders_products_attributes set ';
		} else {
			$sql = 'insert into cart_orders_products_attributes set ';
		}
		if (!is_null($this->getOrderid())) {
			$sql .= '`orders_id`="' . e($this->getOrderid()) . '", ';
		}
		if (!is_null($this->getProductid())) {
			$sql .= '`orders_products_id`="' . e($this->getProductid()) . '", ';
		}
		if (!is_null($this->getProducts_options())) {
			$sql .= '`products_options`="' . e($this->getProducts_options()) . '", ';
		}
		if (!is_null($this->getProducts_options_values())) {
			$sql .= '`products_options_values`="' . e($this->getProducts_options_values()) . '", ';
		}
		if (!is_null($this->getOptions_values_price())) {
			$sql .= '`options_values_price`="' . e($this->getOptions_values_price()) . '", ';
		}
		if (!is_null($this->getPrice_prefix())) {
			$sql .= '`price_prefix`="' . e($this->getPrice_prefix()) . '", ';
		}
		if (!is_null($this->getProduct_attribute_is_free())) {
			$sql .= '`product_attribute_is_free`="' . e($this->getProduct_attribute_is_free()) . '", ';
		}
		if (!is_null($this->getProducts_attributes_weight())) {
			$sql .= '`products_attributes_weight`="' . e($this->getProducts_attributes_weight()) . '", ';
		}
		if (!is_null($this->getProducts_attributes_weight_prefix())) {
			$sql .= '`products_attributes_weight_prefix`="' . e($this->getProducts_attributes_weight_prefix()) . '", ';
		}
		if (!is_null($this->getAttributes_discounted())) {
			$sql .= '`attributes_discounted`="' . e($this->getAttributes_discounted()) . '", ';
		}
		if (!is_null($this->getAttributes_price_base_included())) {
			$sql .= '`attributes_price_base_included`="' . e($this->getAttributes_price_base_included()) . '", ';
		}
		if (!is_null($this->getAttributes_price_onetime())) {
			$sql .= '`attributes_price_onetime`="' . e($this->getAttributes_price_onetime()) . '", ';
		}
		if (!is_null($this->getAttributes_price_factor())) {
			$sql .= '`attributes_price_factor`="' . e($this->getAttributes_price_factor()) . '", ';
		}
		if (!is_null($this->getAttributes_price_factor_offset())) {
			$sql .= '`attributes_price_factor_offset`="' . e($this->getAttributes_price_factor_offset()) . '", ';
		}
		if (!is_null($this->getAttributes_price_factor_onetime())) {
			$sql .= '`attributes_price_factor_onetime`="' . e($this->getAttributes_price_factor_onetime()) . '", ';
		}
		if (!is_null($this->getAttributes_price_factor_onetime_offset())) {
			$sql .= '`attributes_price_factor_onetime_offset`="' . e($this->getAttributes_price_factor_onetime_offset()) . '", ';
		}
		if (!is_null($this->getAttributes_qty_prices())) {
			$sql .= '`attributes_qty_prices`="' . e($this->getAttributes_qty_prices()) . '", ';
		}
		if (!is_null($this->getAttributes_qty_prices_onetime())) {
			$sql .= '`attributes_qty_prices_onetime`="' . e($this->getAttributes_qty_prices_onetime()) . '", ';
		}
		if (!is_null($this->getAttributes_price_words())) {
			$sql .= '`attributes_price_words`="' . e($this->getAttributes_price_words()) . '", ';
		}
		if (!is_null($this->getAttributes_price_words_free())) {
			$sql .= '`attributes_price_words_free`="' . e($this->getAttributes_price_words_free()) . '", ';
		}
		if (!is_null($this->getAttributes_price_letters())) {
			$sql .= '`attributes_price_letters`="' . e($this->getAttributes_price_letters()) . '", ';
		}
		if (!is_null($this->getAttributes_price_letters_free())) {
			$sql .= '`attributes_price_letters_free`="' . e($this->getAttributes_price_letters_free()) . '", ';
		}
		if (!is_null($this->getProducts_options_id())) {
			$sql .= '`products_options_id`="' . e($this->getProducts_options_id()) . '", ';
		}
		if (!is_null($this->getProducts_options_values_id())) {
			$sql .= '`products_options_values_id`="' . e($this->getProducts_options_values_id()) . '", ';
		}
		if (!is_null($this->getProducts_prid())) {
			$sql .= '`products_prid`="' . e($this->getProducts_prid()) . '", ';
		}
		if (!is_null($this->getId())) {
			$sql .= 'orders_products_attributes_id="' . e($this->getId()) . '" where orders_products_attributes_id="' . e($this->getId()) . '"';
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
		$sql = 'delete from cart_orders_products_attributes where orders_products_attributes_id="' . e($this->getId()) . '"';
		Database::singleton()->query($sql);
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/CartOrderProductAttribute') {
		$form = new Form('CartOrderProductAttribute_addedit', 'post', $target);
		
		$form->setConstants( array ( 'section' => 'addedit' ) );
		$form->addElement( 'hidden', 'section' );
		
		if (!is_null($this->getId())) {
			$form->setConstants( array ( 'cartorderproductattribute_orders_products_attributes_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'cartorderproductattribute_orders_products_attributes_id' );
			
			$defaultValues ['cartorderproductattribute_orderid'] = $this->getOrderid();
			$defaultValues ['cartorderproductattribute_productid'] = $this->getProductid();
			$defaultValues ['cartorderproductattribute_products_options'] = $this->getProducts_options();
			$defaultValues ['cartorderproductattribute_products_options_values'] = $this->getProducts_options_values();
			$defaultValues ['cartorderproductattribute_options_values_price'] = $this->getOptions_values_price();
			$defaultValues ['cartorderproductattribute_price_prefix'] = $this->getPrice_prefix();
			$defaultValues ['cartorderproductattribute_product_attribute_is_free'] = $this->getProduct_attribute_is_free();
			$defaultValues ['cartorderproductattribute_products_attributes_weight'] = $this->getProducts_attributes_weight();
			$defaultValues ['cartorderproductattribute_products_attributes_weight_prefix'] = $this->getProducts_attributes_weight_prefix();
			$defaultValues ['cartorderproductattribute_attributes_discounted'] = $this->getAttributes_discounted();
			$defaultValues ['cartorderproductattribute_attributes_price_base_included'] = $this->getAttributes_price_base_included();
			$defaultValues ['cartorderproductattribute_attributes_price_onetime'] = $this->getAttributes_price_onetime();
			$defaultValues ['cartorderproductattribute_attributes_price_factor'] = $this->getAttributes_price_factor();
			$defaultValues ['cartorderproductattribute_attributes_price_factor_offset'] = $this->getAttributes_price_factor_offset();
			$defaultValues ['cartorderproductattribute_attributes_price_factor_onetime'] = $this->getAttributes_price_factor_onetime();
			$defaultValues ['cartorderproductattribute_attributes_price_factor_onetime_offset'] = $this->getAttributes_price_factor_onetime_offset();
			$defaultValues ['cartorderproductattribute_attributes_qty_prices'] = $this->getAttributes_qty_prices();
			$defaultValues ['cartorderproductattribute_attributes_qty_prices_onetime'] = $this->getAttributes_qty_prices_onetime();
			$defaultValues ['cartorderproductattribute_attributes_price_words'] = $this->getAttributes_price_words();
			$defaultValues ['cartorderproductattribute_attributes_price_words_free'] = $this->getAttributes_price_words_free();
			$defaultValues ['cartorderproductattribute_attributes_price_letters'] = $this->getAttributes_price_letters();
			$defaultValues ['cartorderproductattribute_attributes_price_letters_free'] = $this->getAttributes_price_letters_free();
			$defaultValues ['cartorderproductattribute_products_options_id'] = $this->getProducts_options_id();
			$defaultValues ['cartorderproductattribute_products_options_values_id'] = $this->getProducts_options_values_id();
			$defaultValues ['cartorderproductattribute_products_prid'] = $this->getProducts_prid();

			$form->setDefaults( $defaultValues );
		}
					
		$form->addElement('text', 'cartorderproductattribute_orderid', 'orderid');
		$form->addElement('text', 'cartorderproductattribute_productid', 'productid');
		$form->addElement('text', 'cartorderproductattribute_products_options', 'products_options');
		$form->addElement('text', 'cartorderproductattribute_products_options_values', 'products_options_values');
		$form->addElement('text', 'cartorderproductattribute_options_values_price', 'options_values_price');
		$form->addElement('text', 'cartorderproductattribute_price_prefix', 'price_prefix');
		$form->addElement('text', 'cartorderproductattribute_product_attribute_is_free', 'product_attribute_is_free');
		$form->addElement('text', 'cartorderproductattribute_products_attributes_weight', 'products_attributes_weight');
		$form->addElement('text', 'cartorderproductattribute_products_attributes_weight_prefix', 'products_attributes_weight_prefix');
		$form->addElement('text', 'cartorderproductattribute_attributes_discounted', 'attributes_discounted');
		$form->addElement('text', 'cartorderproductattribute_attributes_price_base_included', 'attributes_price_base_included');
		$form->addElement('text', 'cartorderproductattribute_attributes_price_onetime', 'attributes_price_onetime');
		$form->addElement('text', 'cartorderproductattribute_attributes_price_factor', 'attributes_price_factor');
		$form->addElement('text', 'cartorderproductattribute_attributes_price_factor_offset', 'attributes_price_factor_offset');
		$form->addElement('text', 'cartorderproductattribute_attributes_price_factor_onetime', 'attributes_price_factor_onetime');
		$form->addElement('text', 'cartorderproductattribute_attributes_price_factor_onetime_offset', 'attributes_price_factor_onetime_offset');
		$form->addElement('text', 'cartorderproductattribute_attributes_qty_prices', 'attributes_qty_prices');
		$form->addElement('text', 'cartorderproductattribute_attributes_qty_prices_onetime', 'attributes_qty_prices_onetime');
		$form->addElement('text', 'cartorderproductattribute_attributes_price_words', 'attributes_price_words');
		$form->addElement('text', 'cartorderproductattribute_attributes_price_words_free', 'attributes_price_words_free');
		$form->addElement('text', 'cartorderproductattribute_attributes_price_letters', 'attributes_price_letters');
		$form->addElement('text', 'cartorderproductattribute_attributes_price_letters_free', 'attributes_price_letters_free');
		$form->addElement('text', 'cartorderproductattribute_products_options_id', 'products_options_id');
		$form->addElement('text', 'cartorderproductattribute_products_options_values_id', 'products_options_values_id');
		$form->addElement('text', 'cartorderproductattribute_products_prid', 'products_prid');
		$form->addElement('submit', 'cartorderproductattribute_submit', 'Submit');

		if ($form->validate() && $form->isSubmitted()) {
			$this->setOrderid($form->exportValue('cartorderproductattribute_orderid'));
			$this->setProductid($form->exportValue('cartorderproductattribute_productid'));
			$this->setProducts_options($form->exportValue('cartorderproductattribute_products_options'));
			$this->setProducts_options_values($form->exportValue('cartorderproductattribute_products_options_values'));
			$this->setOptions_values_price($form->exportValue('cartorderproductattribute_options_values_price'));
			$this->setPrice_prefix($form->exportValue('cartorderproductattribute_price_prefix'));
			$this->setProduct_attribute_is_free($form->exportValue('cartorderproductattribute_product_attribute_is_free'));
			$this->setProducts_attributes_weight($form->exportValue('cartorderproductattribute_products_attributes_weight'));
			$this->setProducts_attributes_weight_prefix($form->exportValue('cartorderproductattribute_products_attributes_weight_prefix'));
			$this->setAttributes_discounted($form->exportValue('cartorderproductattribute_attributes_discounted'));
			$this->setAttributes_price_base_included($form->exportValue('cartorderproductattribute_attributes_price_base_included'));
			$this->setAttributes_price_onetime($form->exportValue('cartorderproductattribute_attributes_price_onetime'));
			$this->setAttributes_price_factor($form->exportValue('cartorderproductattribute_attributes_price_factor'));
			$this->setAttributes_price_factor_offset($form->exportValue('cartorderproductattribute_attributes_price_factor_offset'));
			$this->setAttributes_price_factor_onetime($form->exportValue('cartorderproductattribute_attributes_price_factor_onetime'));
			$this->setAttributes_price_factor_onetime_offset($form->exportValue('cartorderproductattribute_attributes_price_factor_onetime_offset'));
			$this->setAttributes_qty_prices($form->exportValue('cartorderproductattribute_attributes_qty_prices'));
			$this->setAttributes_qty_prices_onetime($form->exportValue('cartorderproductattribute_attributes_qty_prices_onetime'));
			$this->setAttributes_price_words($form->exportValue('cartorderproductattribute_attributes_price_words'));
			$this->setAttributes_price_words_free($form->exportValue('cartorderproductattribute_attributes_price_words_free'));
			$this->setAttributes_price_letters($form->exportValue('cartorderproductattribute_attributes_price_letters'));
			$this->setAttributes_price_letters_free($form->exportValue('cartorderproductattribute_attributes_price_letters_free'));
			$this->setProducts_options_id($form->exportValue('cartorderproductattribute_products_options_id'));
			$this->setProducts_options_values_id($form->exportValue('cartorderproductattribute_products_options_values_id'));
			$this->setProducts_prid($form->exportValue('cartorderproductattribute_products_prid'));
			$this->save();
		}

		return $form;
		
	}
	
	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllCartOrderProductAttributes() {
		$sql = 'select `orders_products_attributes_id` from cart_orders_products_attributes';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new CartOrderProductAttribute($result['orders_products_attributes_id']);
		}
		
		return $results;
	}
	
}
?>