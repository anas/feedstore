<?php
/**
 * CartBasketAttribute
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
class CartBasketAttribute {

	/**
	 * Variable associated with `customers_basket_attributes_id` column in table.
	 *
	 * @var string
	 */
	protected $id = null;
	
	/**
	 * Variable associated with `customers_id` column in table.
	 *
	 * @var string
	 */
	protected $user = null;
	
	/**
	 * Variable associated with `products_id` column in table.
	 *
	 * @var string
	 */
	protected $product = null;
	
	/**
	 * Variable associated with `products_options_id` column in table.
	 *
	 * @var string
	 */
	protected $optionsId = null;
	
	/**
	 * Variable associated with `products_options_value_id` column in table.
	 *
	 * @var string
	 */
	protected $valueId = null;
	
	/**
	 * Variable associated with `products_options_value_text` column in table.
	 *
	 * @var string
	 */
	protected $valueText = null;
	
	/**
	 * Variable associated with `products_options_sort_order` column in table.
	 *
	 * @var string
	 */
	protected $sort = null;
	
	/**
	 * Create an instance of the CartBasketAttribute class.
	 * 
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template CartBasketAttribute object is returned.
	 *
	 * @param int $customers_basket_attributes_id
	 * @return CartBasketAttribute object
	 */
	public function __construct( $customers_basket_attributes_id = null ) {
		if (!is_null($customers_basket_attributes_id)) {
			$sql = 'select * from cart_customers_basket_attributes where customers_basket_attributes_id=' . $customers_basket_attributes_id;
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->setId($result['customers_basket_attributes_id']);
			$this->setUser($result['customers_id']);
			$this->setProduct($result['products_id']);
			$this->setOptionsId($result['products_options_id']);
			$this->setValueId($result['products_options_value_id']);
			$this->setValueText($result['products_options_value_text']);
			$this->setSort($result['products_options_sort_order']);
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
	 * Returns the object's User
	 *
	 * @return string
	 */
	public function getUser() {
		return $this->user;
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
	 * Returns the object's OptionsId
	 *
	 * @return string
	 */
	public function getOptionsId() {
		return $this->optionsId;
	}

	/**
	 * Returns the object's ValueId
	 *
	 * @return string
	 */
	public function getValueId() {
		return $this->valueId;
	}

	/**
	 * Returns the object's ValueText
	 *
	 * @return string
	 */
	public function getValueText() {
		return $this->valueText;
	}

	/**
	 * Returns the object's Sort
	 *
	 * @return string
	 */
	public function getSort() {
		return $this->sort;
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
	 * Sets the object's User
	 *
	 * @param string $user New $this->user value
	 */
	public function setUser( $user ) {
		$this->user = new User($user);
	}

	/**
	 * Sets the object's Product
	 *
	 * @param string $product New $this->product value
	 */
	public function setProduct( $product ) {
		$this->product = $product;
	}

	/**
	 * Sets the object's OptionsId
	 *
	 * @param string $optionsId New $this->optionsId value
	 */
	public function setOptionsId( $optionsId ) {
		$this->optionsId = $optionsId;
	}

	/**
	 * Sets the object's ValueId
	 *
	 * @param string $valueId New $this->valueId value
	 */
	public function setValueId( $valueId ) {
		$this->valueId = $valueId;
	}

	/**
	 * Sets the object's ValueText
	 *
	 * @param string $valueText New $this->valueText value
	 */
	public function setValueText( $valueText ) {
		$this->valueText = $valueText;
	}

	/**
	 * Sets the object's Sort
	 *
	 * @param string $sort New $this->sort value
	 */
	public function setSort( $sort ) {
		$this->sort = $sort;
	}


	/**
	 * Save the object in the database
	 */
	public function save() {
		if (!is_null($this->getId())) {
			$sql = 'update cart_customers_basket_attributes set ';
		} else {
			$sql = 'insert into cart_customers_basket_attributes set ';
		}
		if (!is_null($this->getUser())) {
			$sql .= '`customers_id`="' . e($this->getUser()->getId()) . '", ';
		}
		if (!is_null($this->getProduct())) {
			$sql .= '`products_id`="' . e($this->getProduct()) . '", ';
		}
		if (!is_null($this->getOptionsId())) {
			$sql .= '`products_options_id`="' . e($this->getOptionsId()) . '", ';
		}
		if (!is_null($this->getValueId())) {
			$sql .= '`products_options_value_id`="' . e($this->getValueId()) . '", ';
		}
		if (!is_null($this->getValueText())) {
			$sql .= '`products_options_value_text`="' . e($this->getValueText()) . '", ';
		}
		if (!is_null($this->getSort())) {
			$sql .= '`products_options_sort_order`="' . e($this->getSort()) . '", ';
		}
		if (!is_null($this->getId())) {
			$sql .= 'customers_basket_attributes_id="' . e($this->getId()) . '" where customers_basket_attributes_id="' . e($this->getId()) . '"';
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
		$sql = 'delete from cart_customers_basket_attributes where customers_basket_attributes_id="' . e($this->getId()) . '"';
		Database::singleton()->query($sql);
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/CartBasketAttribute') {
		$form = new Form('CartBasketAttribute_addedit', 'post', $target);
		
		$form->setConstants( array ( 'section' => 'addedit' ) );
		$form->addElement( 'hidden', 'section' );
		
		if (!is_null($this->getId())) {
			$form->setConstants( array ( 'cartbasketattribute_customers_basket_attributes_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'cartbasketattribute_customers_basket_attributes_id' );
			
			$defaultValues ['cartbasketattribute_user'] = $this->getUser()->getId();
			$defaultValues ['cartbasketattribute_product'] = $this->getProduct();
			$defaultValues ['cartbasketattribute_optionsId'] = $this->getOptionsId();
			$defaultValues ['cartbasketattribute_valueId'] = $this->getValueId();
			$defaultValues ['cartbasketattribute_valueText'] = $this->getValueText();
			$defaultValues ['cartbasketattribute_sort'] = $this->getSort();

			$form->setDefaults( $defaultValues );
		}
					
		$form->addElement('text', 'cartbasketattribute_user', 'user');
		$form->addElement('text', 'cartbasketattribute_product', 'product');
		$form->addElement('text', 'cartbasketattribute_optionsId', 'optionsId');
		$form->addElement('text', 'cartbasketattribute_valueId', 'valueId');
		$form->addElement('text', 'cartbasketattribute_valueText', 'valueText');
		$form->addElement('text', 'cartbasketattribute_sort', 'sort');
		$form->addElement('submit', 'cartbasketattribute_submit', 'Submit');

		if ($form->validate() && $form->isSubmitted()) {
			$this->setUser($form->exportValue('cartbasketattribute_user'));
			$this->setProduct($form->exportValue('cartbasketattribute_product'));
			$this->setOptionsId($form->exportValue('cartbasketattribute_optionsId'));
			$this->setValueId($form->exportValue('cartbasketattribute_valueId'));
			$this->setValueText($form->exportValue('cartbasketattribute_valueText'));
			$this->setSort($form->exportValue('cartbasketattribute_sort'));
			$this->save();
		}

		return $form;
		
	}
	
	public static function getCartBasketProductAttributes($prid) {
		$sql = 'select * from cart_customers_basket_attributes where products_id="' . e($prid) . '"';
		$r = Database::singleton()->query_fetch_all($sql);
		return $r;
	}
	
	public static function getByUniqId($pid) {
		$sql = 'select customers_basket_attributes_id from cart_customers_basket_attributes where products_id="' . $pid . '"';
		$r = Database::singleton()->query_fetch($sql);
		return new CartBasketAttribute($r['customers_basket_attributes_id']);
	}
	
	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllCartBasketAttributes() {
		$sql = 'select `customers_basket_attributes_id` from cart_customers_basket_attributes';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new CartBasketAttribute($result['customers_basket_attributes_id']);
		}
		
		return $results;
	}
	
}
?>