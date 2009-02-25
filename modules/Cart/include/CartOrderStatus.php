<?php
/**
 * CartOrderStatus
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
class CartOrderStatus {

	/**
	 * Variable associated with `orders_status_id` column in table.
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
	 * Variable associated with `orders_status_name` column in table.
	 *
	 * @var string
	 */
	protected $name = null;
	
	/**
	 * Create an instance of the CartOrderStatus class.
	 * 
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template CartOrderStatus object is returned.
	 *
	 * @param int $language_id
	 * @return CartOrderStatus object
	 */
	public function __construct( $id = null ) {
		if (!is_null($id)) {
			$sql = 'select * from cart_orders_status where orders_status_id=' . $id;
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->setId($result['orders_status_id']);
			$this->setLanguage_id($result['language_id']);
			$this->setName($result['orders_status_name']);
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
	 * Save the object in the database
	 */
	public function save() {
		if (!is_null($this->get())) {
			$sql = 'update cart_orders_status set ';
		} else {
			$sql = 'insert into cart_orders_status set ';
		}
		if (!is_null($this->getId())) {
			$sql .= '`language_id`="' . e($this->getLanguage_id()) . '", ';
		}
		if (!is_null($this->getName())) {
			$sql .= '`orders_status_name`="' . e($this->getName()) . '", ';
		}
		if (!is_null($this->get())) {
			$sql .= 'orders_status_id="' . e($this->getId()) . '" where orders_status_id="' . e($this->getId()) . '"';
		} else {
			$sql = trim($sql, ', ');
		}
		Database::singleton()->query($sql);
		if (is_null($this->get())) {
			$this->set(Database::singleton()->lastInsertedID());
			self::__construct($this->get());
		}
	}

	/**
	 * Delete the object from the database
	 */
	public function delete() {
		$sql = 'delete from cart_orders_status where language_id="' . e($this->get()) . '"';
		Database::singleton()->query($sql);
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/CartOrderStatus') {
		$form = new Form('CartOrderStatus_addedit', 'post', $target);
		
		$form->setConstants( array ( 'section' => 'addedit' ) );
		$form->addElement( 'hidden', 'section' );
		
		if (!is_null($this->get())) {
			$form->setConstants( array ( 'cartorderstatus_language_id' => $this->get() ) );
			$form->addElement( 'hidden', 'cartorderstatus_language_id' );
			
			$defaultValues ['cartorderstatus_id'] = $this->getId();
			$defaultValues ['cartorderstatus_name'] = $this->getName();

			$form->setDefaults( $defaultValues );
		}
					
		$form->addElement('text', 'cartorderstatus_id', 'id');
		$form->addElement('text', 'cartorderstatus_name', 'name');
		$form->addElement('submit', 'cartorderstatus_submit', 'Submit');

		if ($form->validate() && $form->isSubmitted()) {
			$this->setId($form->exportValue('cartorderstatus_id'));
			$this->setName($form->exportValue('cartorderstatus_name'));
			$this->save();
		}

		return $form;
		
	}
	
	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllCartOrderStatuss() {
		$sql = 'select `language_id` from cart_orders_status';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new CartOrderStatus($result['language_id']);
		}
		
		return $results;
	}
	
}
?>