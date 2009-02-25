<?php
/**
 * CartProductType
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
class CartProductType {

	/**
	 * Variable associated with `type_id` column in table.
	 *
	 * @var string
	 */
	protected $id = null;
	
	/**
	 * Variable associated with `type_name` column in table.
	 *
	 * @var string
	 */
	protected $name = null;
	
	/**
	 * Variable associated with `type_handler` column in table.
	 *
	 * @var string
	 */
	protected $handler = null;
	
	/**
	 * Variable associated with `type_master_type` column in table.
	 *
	 * @var string
	 */
	protected $masterType = null;
	
	/**
	 * Variable associated with `allow_add_to_cart` column in table.
	 *
	 * @var string
	 */
	protected $allow_add_to_cart = null;
	
	/**
	 * Variable associated with `default_image` column in table.
	 *
	 * @var string
	 */
	protected $image = null;
	
	/**
	 * Variable associated with `date_added` column in table.
	 *
	 * @var string
	 */
	protected $date_added = null;
	
	/**
	 * Variable associated with `last_modified` column in table.
	 *
	 * @var string
	 */
	protected $last_modified = null;
	
	/**
	 * Create an instance of the CartProductType class.
	 * 
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template CartProductType object is returned.
	 *
	 * @param int $type_id
	 * @return CartProductType object
	 */
	public function __construct( $type_id = null ) {
		if (!is_null($type_id)) {
			$sql = 'select * from cart_product_types where type_id=' . $type_id;
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->setId($result['type_id']);
			$this->setName($result['type_name']);
			/*
			$this->setHandler($result['type_handler']);
			$this->setMasterType($result['type_master_type']);
			$this->setAllow_add_to_cart($result['allow_add_to_cart']);
			$this->setImage($result['default_image']);
			*/
			$this->setDate_added($result['date_added']);
			$this->setLast_modified($result['last_modified']);
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
	 * Returns the object's Name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Returns the object's Handler
	 *
	 * @return string
	 */
	public function getHandler() {
		return $this->handler;
	}

	/**
	 * Returns the object's MasterType
	 *
	 * @return string
	 */
	public function getMasterType() {
		return $this->masterType;
	}

	/**
	 * Returns the object's Allow_add_to_cart
	 *
	 * @return string
	 */
	public function getAllow_add_to_cart() {
		return $this->allow_add_to_cart;
	}

	/**
	 * Returns the object's Image
	 *
	 * @return string
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * Returns the object's Date_added
	 *
	 * @return string
	 */
	public function getDate_added() {
		return $this->date_added;
	}

	/**
	 * Returns the object's Last_modified
	 *
	 * @return string
	 */
	public function getLast_modified() {
		return $this->last_modified;
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
	 * Sets the object's Name
	 *
	 * @param string $name New $this->name value
	 */
	public function setName( $name ) {
		$this->name = $name;
	}

	/**
	 * Sets the object's Handler
	 *
	 * @param string $handler New $this->handler value
	 */
	public function setHandler( $handler ) {
		$this->handler = $handler;
	}

	/**
	 * Sets the object's MasterType
	 *
	 * @param string $masterType New $this->masterType value
	 */
	public function setMasterType( $masterType ) {
		$this->masterType = $masterType;
	}

	/**
	 * Sets the object's Allow_add_to_cart
	 *
	 * @param string $allow_add_to_cart New $this->allow_add_to_cart value
	 */
	public function setAllow_add_to_cart( $allow_add_to_cart ) {
		$this->allow_add_to_cart = $allow_add_to_cart;
	}

	/**
	 * Sets the object's Image
	 *
	 * @param string $image New $this->image value
	 */
	public function setImage( $image ) {
		$this->image = $image;
	}

	/**
	 * Sets the object's Date_added
	 *
	 * @param string $date_added New $this->date_added value
	 */
	public function setDate_added( $date_added ) {
		$this->date_added = $date_added;
	}

	/**
	 * Sets the object's Last_modified
	 *
	 * @param string $last_modified New $this->last_modified value
	 */
	public function setLast_modified( $last_modified ) {
		$this->last_modified = $last_modified;
	}


	/**
	 * Save the object in the database
	 */
	public function save() {
		if (!is_null($this->getId())) {
			$sql = 'update cart_product_types set ';
		} else {
			$sql = 'insert into cart_product_types set ';
		}
		if (!is_null($this->getName())) {
			$sql .= '`type_name`="' . e($this->getName()) . '", ';
		}
		/*
		if (!is_null($this->getHandler())) {
			$sql .= '`type_handler`="' . e($this->getHandler()) . '", ';
		}
		if (!is_null($this->getMasterType())) {
			$sql .= '`type_master_type`="' . e($this->getMasterType()) . '", ';
		}
		if (!is_null($this->getAllow_add_to_cart())) {
			$sql .= '`allow_add_to_cart`="' . e($this->getAllow_add_to_cart()) . '", ';
		}
		if (!is_null($this->getImage())) {
			$sql .= '`default_image`="' . e($this->getImage()->getId()) . '", ';
		}
		*/
		if (!is_null($this->getDate_added())) {
			$sql .= '`date_added`="' . e($this->getDate_added()) . '", ';
		}
		if (!is_null($this->getLast_modified())) {
			$sql .= '`last_modified`="' . e($this->getLast_modified()) . '", ';
		}
		if (!is_null($this->getId())) {
			$sql .= 'type_id="' . e($this->getId()) . '" where type_id="' . e($this->getId()) . '"';
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
		$sql = 'delete from cart_product_types where type_id="' . e($this->getId()) . '"';
		Database::singleton()->query($sql);
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/Cart') {
		//Only the name will be displayed to the administrator
		//All the other attributes are not valid for feedstore.ca
		
		$form = new Form('CartProductType_addedit', 'post', $target);
		
		$form->setConstants( array ( 'section' => 'product_types' ) );
		$form->addElement( 'hidden', 'section' );
		$form->setConstants( array ( 'action' => 'addedit' ) );
		$form->addElement( 'hidden', 'action' );
		
		if (!is_null($this->getId())) {
			$form->setConstants( array ( 'cartproducttype_type_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'cartproducttype_type_id' );
			
			$defaultValues ['cartproducttype_name'] = $this->getName();
			/*
			$defaultValues ['cartproducttype_handler'] = $this->getHandler();
			$defaultValues ['cartproducttype_masterType'] = $this->getMasterType();
			$defaultValues ['cartproducttype_allow_add_to_cart'] = $this->getAllow_add_to_cart();
			$defaultValues ['cartproducttype_image'] = $this->getImage()->getId();
			$defaultValues ['cartproducttype_date_added'] = $this->getDate_added();
			$defaultValues ['cartproducttype_last_modified'] = $this->getLast_modified();
			*/
			$form->setDefaults( $defaultValues );
		}
					
		$form->addElement('text', 'cartproducttype_name', 'name');
		/*
		$form->addElement('text', 'cartproducttype_handler', 'handler');
		$form->addElement('text', 'cartproducttype_masterType', 'masterType');
		$form->addElement('text', 'cartproducttype_allow_add_to_cart', 'allow_add_to_cart');
		$form->addElement('text', 'cartproducttype_image', 'image');
		$form->addElement('text', 'cartproducttype_date_added', 'date_added');
		$form->addElement('text', 'cartproducttype_last_modified', 'last_modified');
		*/
		$form->addElement('submit', 'cartproducttype_submit', 'Submit');

		if ($form->validate() && $form->isSubmitted()) {
			$this->setName($form->exportValue('cartproducttype_name'));
			/*
			$this->setHandler($form->exportValue('cartproducttype_handler'));
			$this->setMasterType($form->exportValue('cartproducttype_masterType'));
			$this->setAllow_add_to_cart($form->exportValue('cartproducttype_allow_add_to_cart'));
			$this->setImage($form->exportValue('cartproducttype_image'));
			$this->setDate_added($form->exportValue('cartproducttype_date_added'));
			$this->setLast_modified($form->exportValue('cartproducttype_last_modified'));
			*/
			$this->save();
		}

		return $form;
		
	}
	
	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllCartProductTypes() {
		$sql = 'select `type_id` from cart_product_types';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new CartProductType($result['type_id']);
		}
		
		return $results;
	}
	
	public static function toArray() {
		$types = self::getAllCartProductTypes();
		
		$array = array();
		foreach ($types as $type) {
			$array[$type->getId()] = $type->getName();
		}
		return $array;
	}
	
	public function getCountProducts(){
		$sql = 'select count(products_id) as `count` from cart_products where products_type="' . e($this->getId()) . '"';
		$rs = Database::singleton()->query_fetch($sql);
		
		return $rs['count'];
	}
}
?>