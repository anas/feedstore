<?php
/**
 * CartManufacturer
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
class CartManufacturer {

	/**
	 * Variable associated with `manufacturers_id` column in table.
	 *
	 * @var string
	 */
	protected $id = null;
	
	/**
	 * Variable associated with `manufacturers_name` column in table.
	 *
	 * @var string
	 */
	protected $name = null;
	
	/**
	 * Variable associated with `manufacturers_image` column in table.
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
	
	protected $description = null;
	
	/**
	 * Create an instance of the CartManufacturer class.
	 * 
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template CartManufacturer object is returned.
	 *
	 * @param int $manufacturers_id
	 * @return CartManufacturer object
	 */
	public function __construct( $manufacturers_id = null ) {
		if (!is_null($manufacturers_id)) {
			$sql = 'select * from cart_manufacturers where manufacturers_id=' . $manufacturers_id;
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->setId($result['manufacturers_id']);
			$this->setName($result['manufacturers_name']);
			$this->setImage($result['manufacturers_image']);
			$this->setDate_added($result['date_added']);
			$this->setLast_modified($result['last_modified']);
			@$this->setDescription($result['manufacturers_description']);
		} else {
			$this->setImage(null);
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

	public function getDescription() {
		return $this->description;
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
	 * Sets the object's Image
	 *
	 * @param string $image New $this->image value
	 */
	public function setImage( $image ) {
		$this->image = new Image(array('id' => $image));
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

	public function setDescription($desc) {
		$this->description = $desc;
	}
	
	
	/**
	 * Save the object in the database
	 */
	public function save() {
		if (!is_null($this->getId())) {
			$sql = 'update cart_manufacturers set ';
		} else {
			$sql = 'insert into cart_manufacturers set ';
		}
		if (!is_null($this->getName())) {
			$sql .= '`manufacturers_name`="' . e($this->getName()) . '", ';
		}
		if (!is_null($this->getImage())) {
			$sql .= '`manufacturers_image`="' . e($this->getImage()->getId()) . '", ';
		}
		if (!is_null($this->getDate_added())) {
			$sql .= '`date_added`="' . e($this->getDate_added()) . '", ';
		}
		if (!is_null($this->getLast_modified())) {
			$sql .= '`last_modified`="' . e($this->getLast_modified()) . '", ';
		}
		if (!is_null($this->getId())) {
			$sql .= 'manufacturers_id="' . e($this->getId()) . '" where manufacturers_id="' . e($this->getId()) . '"';
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
		$sql = 'delete from cart_manufacturers where manufacturers_id="' . e($this->getId()) . '"';
		Database::singleton()->query($sql);
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/Cart') {
		$form = new Form('CartManufacturer_addedit', 'post', $target);
		
		$form->setConstants( array ( 'section' => 'manufacturers' ) );
		$form->addElement( 'hidden', 'section' );
		
		$form->setConstants( array ( 'action' => 'addedit' ) );
		$form->addElement( 'hidden', 'action' );
		
		if (!is_null($this->getId())) {
			$form->setConstants( array ( 'cartmanufacturer_manufacturers_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'cartmanufacturer_manufacturers_id' );
			
			$defaultValues ['cartmanufacturer_name'] = $this->getName();
			$defaultValues ['cartmanufacturer_image'] = $this->getImage()->getId();
			//$defaultValues ['cartmanufacturer_date_added'] = $this->getDate_added();
			//$defaultValues ['cartmanufacturer_last_modified'] = $this->getLast_modified();

			$form->setDefaults( $defaultValues );
		}
		
		if (@$this->getImage() && @$this->getImage()->getId())
			$form->addElement('dbimage', 'cartmanufacturer_image', $this->getImage()->getId());
		$form->addElement('text', 'cartmanufacturer_name', 'Name');
		$newImage = $form->addElement('file', 'cartmanufacturer_image_upload', 'Image');
		
		//$form->addElement('text', 'cartmanufacturer_date_added', 'date_added');
		//$form->addElement('text', 'cartmanufacturer_last_modified', 'last_modified');
		$form->addElement('submit', 'cartmanufacturer_submit', 'Submit');
		
		if ($form->validate() && $form->isSubmitted() && isset($_REQUEST['cartmanufacturer_submit'])) {
			$this->setName($form->exportValue('cartmanufacturer_name'));
			$this->setDescription($form->exportValue('cartmanufacturer_description'));
			//$this->setImage($form->exportValue('cartmanufacturer_image'));
			//$this->setDate_added($form->exportValue('cartmanufacturer_date_added'));
			//$this->setLast_modified($form->exportValue('cartmanufacturer_last_modified'));
			
			if ($newImage->isUploadedFile()) {
				$im = new Image();
				$id = $im->insert($newImage->getValue());
				$this->setImage($id);
				
			}
			
			$this->save();
		}

		return $form;
		
	}
	
	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllCartManufacturers() {
		$sql = 'select `manufacturers_id` from cart_manufacturers order by manufacturers_name';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new CartManufacturer($result['manufacturers_id']);
		}
		
		return $results;
	}
	
	public static function getProductsByManufacturer($man_id, $from = null, $limit = null) {
		$sql = 'select `products_id` from cart_products where `manufacturers_id`=' . $man_id;
		
		if (!is_null($from) && !is_null($limit)) {
			$sql .= ' limit ' . ($from - 1) . ', ' . ($limit);
		}
		
		
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new CartProduct($result['products_id']);
		}
		
		return $results;
	}
	
	public static function getAvailibleManufacturers() {
		$sql = 'select m.manufacturers_id from cart_products p  LEFT JOIN (cart_manufacturers m) on (p. manufacturers_id=m. manufacturers_id) where p.products_quantity > 0 group by m.manufacturers_id';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new CartManufacturer($result['manufacturers_id']);
		}
		
		return $results;
	}
	
	public static function getCategoriesByManufacturer($man_id) {
		$sql = 'select distinct pc.categories_id from cart_products p LEFT JOIN (cart_products_to_categories pc) ON (p.products_id=pc.products_id) where p.manufacturers_id=' . $man_id;
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new CartCategory($result['categories_id']);
		}
		return $results;
	}
	
	public function getProductsByCategory($cat_id) {
		$sql = 'SELECT p.products_id FROM cart_products p LEFT JOIN (cart_products_to_categories c) ON (p.products_id=c.products_id) where p.manufacturers_id=' . $this->getId() . ' and c.categories_id=' . $cat_id;
		$rs = Database::singleton()->query_fetch_all($sql);
		
		foreach ($rs as &$r) {
			$r = new CartProduct($r['products_id']);
		}
		return $rs;
	}
	
	public static function getCountCartManufacturer($man_id) {
		$sql = 'select count(*) as count from cart_products where manufacturers_id=' . $man_id;
		$result = Database::singleton()->query_fetch($sql);
		return $result['count'];
	}
	
	public static function toArray() {
		$mans = self::getAllCartManufacturers();
		$array = array(0 => '[ NONE SET ]');
		
		foreach ($mans as $man) {
			$array[$man->getId()] = $man->getName();
		}
		return $array;
	}
	
	
}
?>