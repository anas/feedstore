<?php
/**
 * CartTaxClass
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
class CartTaxClass {

	/**
	 * Variable associated with `tax_class_id` column in table.
	 *
	 * @var string
	 */
	protected $id = null;
	
	/**
	 * Variable associated with `tax_class_title` column in table.
	 *
	 * @var string
	 */
	protected $title = null;
	
	/**
	 * Variable associated with `tax_class_description` column in table.
	 *
	 * @var string
	 */
	protected $description = null;
	
	/**
	 * Variable associated with `last_modified` column in table.
	 *
	 * @var string
	 */
	protected $last_modified = null;
	
	/**
	 * Variable associated with `date_added` column in table.
	 *
	 * @var string
	 */
	protected $date_added = null;
	
	/**
	 * Create an instance of the CartTaxClass class.
	 * 
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template CartTaxClass object is returned.
	 *
	 * @param int $tax_class_id
	 * @return CartTaxClass object
	 */
	public function __construct( $tax_class_id = null ) {
		if (!is_null($tax_class_id)) {
			$sql = 'select * from cart_tax_class where tax_class_id=' . $tax_class_id;
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->setId($result['tax_class_id']);
			$this->setTitle($result['tax_class_title']);
			$this->setDescription($result['tax_class_description']);
			$this->setLast_modified($result['last_modified']);
			$this->setDate_added($result['date_added']);
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
	 * Returns the object's Title
	 *
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
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
	 * Returns the object's Last_modified
	 *
	 * @return string
	 */
	public function getLast_modified() {
		return $this->last_modified;
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
	 * Sets the object's Id
	 *
	 * @param string $id New $this->id value
	 */
	public function setId( $id ) {
		$this->id = $id;
	}

	/**
	 * Sets the object's Title
	 *
	 * @param string $title New $this->title value
	 */
	public function setTitle( $title ) {
		$this->title = $title;
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
	 * Sets the object's Last_modified
	 *
	 * @param string $last_modified New $this->last_modified value
	 */
	public function setLast_modified( $last_modified ) {
		$this->last_modified = $last_modified;
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
	 * Save the object in the database
	 */
	public function save() {
		if (!is_null($this->getId())) {
			$sql = 'update cart_tax_class set ';
		} else {
			$sql = 'insert into cart_tax_class set ';
		}
		if (!is_null($this->getTitle())) {
			$sql .= '`tax_class_title`="' . e($this->getTitle()) . '", ';
		}
		if (!is_null($this->getDescription())) {
			$sql .= '`tax_class_description`="' . e($this->getDescription()) . '", ';
		}
		if (!is_null($this->getLast_modified())) {
			$sql .= '`last_modified`="' . e($this->getLast_modified()) . '", ';
		}
		if (!is_null($this->getDate_added())) {
			$sql .= '`date_added`="' . e($this->getDate_added()) . '", ';
		}
		if (!is_null($this->getId())) {
			$sql .= 'tax_class_id="' . e($this->getId()) . '" where tax_class_id="' . e($this->getId()) . '"';
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
		$sql = 'delete from cart_tax_class where tax_class_id="' . e($this->getId()) . '"';
		Database::singleton()->query($sql);
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/Cart') {
		$form = new Form('CartTaxClass_addedit', 'post', $target);
		
		$form->setConstants( array ( 'section' => 'tax_classes' ) );
		$form->addElement( 'hidden', 'section' );
		
		$form->setConstants( array ( 'action' => 'addedit' ) );
		$form->addElement( 'hidden', 'action' );
		
		if (!is_null($this->getId())) {
			$form->setConstants( array ( 'carttaxclass_tax_class_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'carttaxclass_tax_class_id' );
			
			$defaultValues ['carttaxclass_title'] = $this->getTitle();
			$defaultValues ['carttaxclass_description'] = $this->getDescription();
			$defaultValues ['carttaxclass_last_modified'] = $this->getLast_modified();
			$defaultValues ['carttaxclass_date_added'] = $this->getDate_added();

			$form->setDefaults( $defaultValues );
		}
					
		$form->addElement('text', 'carttaxclass_title', 'Title');
		$text = $form->addElement('textarea', 'carttaxclass_description', 'Description');
		$text->setCols(60);
		$text->setRows(10);
		
		$form->addElement('text', 'carttaxclass_last_modified', 'Last Modified');
		$form->addElement('text', 'carttaxclass_date_added', 'Date Added');
		$form->addElement('submit', 'carttaxclass_submit', 'Submit');
		
		$form->addRule( 'carttaxclass_title', 'Please enter a Title', 'required', null );
		$form->addRule( 'carttaxclass_description', 'Please enter a Description', 'required', null );

		if ($form->validate() && $form->isSubmitted()) {
			$this->setTitle($form->exportValue('carttaxclass_title'));
			$this->setDescription($form->exportValue('carttaxclass_description'));
			$this->setLast_modified($form->exportValue('carttaxclass_last_modified'));
			$this->setDate_added($form->exportValue('carttaxclass_date_added'));
			$this->save();
		}

		return $form;
		
	}
	
	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllCartTaxClasses() {
		$sql = 'select `tax_class_id` from cart_tax_class';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new CartTaxClass($result['tax_class_id']);
		}
		
		return $results;
	}
	
	public static function toArray() {
		$classes = self::getAllCartTaxClasses();
		
		$array = array();
		foreach ($classes as $class) {
			$array[$class->getId()] = $class->getTitle();
		}
		return $array;
	}
	
}
?>