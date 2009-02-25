<?php
/**
 * CartSpecial
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
class CartSpecial {

	/**
	 * Variable associated with `specials_id` column in table.
	 *
	 * @var string
	 */
	protected $id = null;
	
	/**
	 * Variable associated with `products_id` column in table.
	 *
	 * @var string
	 */
	protected $product = null;
	
	/**
	 * Variable associated with `specials_new_products_price` column in table.
	 *
	 * @var string
	 */
	protected $new_products_price = null;
	
	/**
	 * Variable associated with `specials_date_added` column in table.
	 *
	 * @var string
	 */
	protected $date_added = null;
	
	/**
	 * Variable associated with `specials_last_modified` column in table.
	 *
	 * @var string
	 */
	protected $last_modified = null;
	
	/**
	 * Variable associated with `expires_date` column in table.
	 *
	 * @var string
	 */
	protected $expires_date = null;
	
	/**
	 * Variable associated with `date_status_change` column in table.
	 *
	 * @var string
	 */
	protected $date_status_change = null;
	
	/**
	 * Variable associated with `status` column in table.
	 *
	 * @var string
	 */
	protected $status = null;
	
	/**
	 * Variable associated with `specials_date_available` column in table.
	 *
	 * @var string
	 */
	protected $date_available = null;
	
	/**
	 * Create an instance of the CartSpecial class.
	 * 
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template CartSpecial object is returned.
	 *
	 * @param int $specials_id
	 * @return CartSpecial object
	 */
	public function __construct( $specials_id = null ) {
		if (!is_null($specials_id)) {
			$sql = 'select * from cart_specials where specials_id=' . $specials_id;
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->setId($result['specials_id']);
			$this->setProduct($result['products_id']);
			$this->setNew_products_price($result['specials_new_products_price']);
			$this->setDate_added($result['specials_date_added']);
			$this->setLast_modified($result['specials_last_modified']);
			$this->setExpires_date($result['expires_date']);
			$this->setDate_status_change($result['date_status_change']);
			$this->setStatus($result['status']);
			$this->setDate_available($result['specials_date_available']);
			
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
	 * Returns the object's Product
	 *
	 * @return string
	 */
	public function getProduct() {
		return $this->product;
	}

	/**
	 * Returns the object's New_products_price
	 *
	 * @return string
	 */
	public function getNew_products_price() {
		return $this->new_products_price;
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
	 * Returns the object's Expires_date
	 *
	 * @return string
	 */
	public function getExpires_date() {
		return $this->expires_date;
	}

	/**
	 * Returns the object's Date_status_change
	 *
	 * @return string
	 */
	public function getDate_status_change() {
		return $this->date_status_change;
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
	 * Returns the object's Date_available
	 *
	 * @return string
	 */
	public function getDate_available() {
		return $this->date_available;
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
	 * Sets the object's Product
	 *
	 * @param string $product New $this->product value
	 */
	public function setProduct( $product ) {
		$this->product = $product;
	}

	/**
	 * Sets the object's New_products_price
	 *
	 * @param string $new_products_price New $this->new_products_price value
	 */
	public function setNew_products_price( $new_products_price ) {
		$this->new_products_price = $new_products_price;
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
	 * Sets the object's Expires_date
	 *
	 * @param string $expires_date New $this->expires_date value
	 */
	public function setExpires_date( $expires_date ) {
		$this->expires_date = $expires_date;
	}

	/**
	 * Sets the object's Date_status_change
	 *
	 * @param string $date_status_change New $this->date_status_change value
	 */
	public function setDate_status_change( $date_status_change ) {
		$this->date_status_change = $date_status_change;
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
	 * Sets the object's Date_available
	 *
	 * @param string $date_available New $this->date_available value
	 */
	public function setDate_available( $date_available ) {
		$this->date_available = $date_available;
	}


	/**
	 * Save the object in the database
	 */
	public function save() {
		if (!is_null($this->getId())) {
			$sql = 'update cart_specials set ';
		} else {
			$sql = 'insert into cart_specials set ';
		}
		if (!is_null($this->getProduct())) {
			$sql .= '`products_id`="' . e($this->getProduct()) . '", ';
		}
		if (!is_null($this->getNew_products_price())) {
			$sql .= '`specials_new_products_price`="' . e($this->getNew_products_price()) . '", ';
		}
		if (!is_null($this->getDate_added())) {
			$sql .= '`specials_date_added`="' . e($this->getDate_added()) . '", ';
		}
		if (!is_null($this->getLast_modified())) {
			$sql .= '`specials_last_modified`="' . e($this->getLast_modified()) . '", ';
		}
		if (!is_null($this->getExpires_date())) {
			$sql .= '`expires_date`="' . e($this->getExpires_date()) . '", ';
		}
		if (!is_null($this->getDate_status_change())) {
			$sql .= '`date_status_change`="' . e($this->getDate_status_change()) . '", ';
		}
		if (!is_null($this->getStatus())) {
			$sql .= '`status`="' . e($this->getStatus()) . '", ';
		}
		if (!is_null($this->getDate_available())) {
			$sql .= '`specials_date_available`="' . e($this->getDate_available()) . '", ';
		}
		if (!is_null($this->getId())) {
			$sql .= 'specials_id="' . e($this->getId()) . '" where specials_id="' . e($this->getId()) . '"';
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
		$sql = 'delete from cart_specials where specials_id="' . e($this->getId()) . '"';
		Database::singleton()->query($sql);
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/CartSpecial') {
		$form = new Form('CartSpecial_addedit', 'post', $target);
		
		$form->setConstants( array ( 'section' => 'addedit' ) );
		$form->addElement( 'hidden', 'section' );
		
		if (!is_null($this->getId())) {
			$form->setConstants( array ( 'cartspecial_specials_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'cartspecial_specials_id' );
			
			$defaultValues ['cartspecial_product'] = $this->getProduct();
			$defaultValues ['cartspecial_new_products_price'] = $this->getNew_products_price();
			$defaultValues ['cartspecial_date_added'] = $this->getDate_added();
			$defaultValues ['cartspecial_last_modified'] = $this->getLast_modified();
			$defaultValues ['cartspecial_expires_date'] = $this->getExpires_date();
			$defaultValues ['cartspecial_date_status_change'] = $this->getDate_status_change();
			$defaultValues ['cartspecial_status'] = $this->getStatus();
			$defaultValues ['cartspecial_date_available'] = $this->getDate_available();

			$form->setDefaults( $defaultValues );
		}
					
		$form->addElement('text', 'cartspecial_product', 'product');
		$form->addElement('text', 'cartspecial_new_products_price', 'new_products_price');
		$form->addElement('text', 'cartspecial_date_added', 'date_added');
		$form->addElement('text', 'cartspecial_last_modified', 'last_modified');
		$form->addElement('text', 'cartspecial_expires_date', 'expires_date');
		$form->addElement('text', 'cartspecial_date_status_change', 'date_status_change');
		$form->addElement('text', 'cartspecial_status', 'status');
		$form->addElement('text', 'cartspecial_date_available', 'date_available');
		$form->addElement('submit', 'cartspecial_submit', 'Submit');

		if ($form->validate() && $form->isSubmitted()) {
			$this->setProduct($form->exportValue('cartspecial_product'));
			$this->setNew_products_price($form->exportValue('cartspecial_new_products_price'));
			$this->setDate_added($form->exportValue('cartspecial_date_added'));
			$this->setLast_modified($form->exportValue('cartspecial_last_modified'));
			$this->setExpires_date($form->exportValue('cartspecial_expires_date'));
			$this->setDate_status_change($form->exportValue('cartspecial_date_status_change'));
			$this->setStatus($form->exportValue('cartspecial_status'));
			$this->setDate_available($form->exportValue('cartspecial_date_available'));
			$this->save();
		}

		return $form;
		
	}
	
	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllCartSpecials() {
		$sql = 'select `specials_id` from cart_specials';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new CartSpecial($result['specials_id']);
		}
		
		return $results;
	}
	
}
?>