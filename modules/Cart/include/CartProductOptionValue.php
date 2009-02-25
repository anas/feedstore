<?php
/**
 * CartProductOptionValue
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
class CartProductOptionValue {

	/**
	 * Variable associated with `products_options_values_id` column in table.
	 *
	 * @var string
	 */
	protected $id = null;
	
	/**
	 * Variable associated with `language_id` column in table.
	 *
	 * @var string
	 */
	protected $language_id = null;
	
	/**
	 * Variable associated with `products_options_values_name` column in table.
	 *
	 * @var string
	 */
	protected $name = null;
	
	/**
	 * Variable associated with `products_options_values_sort_order` column in table.
	 *
	 * @var string
	 */
	protected $sort = null;
	
	public $optionid = null;
	
	/**
	 * Create an instance of the CartProductOptionValue class.
	 * 
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template CartProductOptionValue object is returned.
	 *
	 * @param int $language_id
	 * @return CartProductOptionValue object
	 */
	public function __construct( $products_options_values_id = null ) {
		if (!is_null($products_options_values_id)) {
			$sql = 'select * from cart_products_options_values where products_options_values_id=' . $products_options_values_id;
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->setId($result['products_options_values_id']);
			$this->setLanguage_id($result['language_id']);
			$this->setName($result['products_options_values_name']);
			$this->setSort($result['products_options_values_sort_order']);
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
	 * Returns the object's Language_id
	 *
	 * @return string
	 */
	public function getLanguage_id() {
		return $this->language_id;
	}

	/**
	 * Returns the object's Name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
	
	public function getSplitName() {
		return split(',', $this->getName());
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
	 * Sets the object's Language_id
	 *
	 * @param string $language_id New $this->language_id value
	 */
	public function setLanguage_id( $language_id ) {
		$this->language_id = $language_id;
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
			$sql = 'update cart_products_options_values set ';
		} else {
			$sql = 'insert into cart_products_options_values set ';
		}
		if (!is_null($this->getId())) {
			$sql .= '`language_id`="' . e($this->getLanguage_id()) . '", ';
		}
		if (!is_null($this->getName())) {
			$sql .= '`products_options_values_name`="' . e($this->getName()) . '", ';
		}
		if (!is_null($this->getSort())) {
			$sql .= '`products_options_values_sort_order`="' . e($this->getSort()) . '", ';
		}
		if (!is_null($this->getId())) {
			$sql .= 'products_options_values_id="' . e($this->getId()) . '" where products_options_values_id="' . e($this->getId()) . '"';
		} else {
			$sql = trim($sql, ', ');
		}
		Database::singleton()->query($sql);
		if (is_null($this->getId())) {
			$this->setId(Database::singleton()->lastInsertedID());
			self::__construct($this->getId());
			
			$sql = 'insert into cart_products_options_values_to_products_options set products_options_id=' . e($this->optionid) . ', products_options_values_id=' . e($this->getId());
			Database::singleton()->query($sql);
		}
	}

	/**
	 * Delete the object from the database
	 */
	public function delete() {
		$sql = 'delete from cart_products_options_values where products_options_values_id="' . e($this->getId()) . '"';
		Database::singleton()->query($sql);
		
		$sql = 'delete from cart_products_options_values_to_products_options where products_options_values_id=' . e($this->getId());
		Database::singleton()->query($sql);
		
		$sql = 'delete from cart_products_attributes where options_values_id=' . e($this->getId());
		Database::singleton()->query($sql);
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/CartProductOptionValue') {
		$form = new Form('CartProductOptionValue_addedit', 'post', $target);
		
		$form->setConstants( array ( 'section' => 'addedit' ) );
		$form->addElement( 'hidden', 'section' );
		
		if (!is_null($this->get())) {
			$form->setConstants( array ( 'cartproductoptionvalue_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'cartproductoptionvalue_id' );
			
			$defaultValues ['cartproductoptionvalue_language_id'] = $this->getLanguage_id();
			$defaultValues ['cartproductoptionvalue_name'] = $this->getName();
			$defaultValues ['cartproductoptionvalue_sort'] = $this->getSort();

			$form->setDefaults( $defaultValues );
		}
					
		$form->addElement('text', 'cartproductoptionvalue_id', 'id');
		$form->addElement('text', 'cartproductoptionvalue_name', 'name');
		$form->addElement('text', 'cartproductoptionvalue_sort', 'sort');
		$form->addElement('submit', 'cartproductoptionvalue_submit', 'Submit');

		if ($form->validate() && $form->isSubmitted()) {
			$this->setLanguage_id($form->exportValue('cartproductoptionvalue_language_id'));
			$this->setName($form->exportValue('cartproductoptionvalue_name'));
			$this->setSort($form->exportValue('cartproductoptionvalue_sort'));
			$this->save();
		}

		return $form;
		
	}
	
	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllCartProductOptionValues() {
		$sql = 'select `products_options_values_id` from cart_products_options_values';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new CartProductOptionValue($result['products_options_values_id']);
		}
		
		return $results;
	}
	
}


?>