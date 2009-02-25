<?php
/**
 * CartCategory
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
class CartCategory {

	/**
	 * Variable associated with `categories_id` column in table.
	 *
	 * @var string
	 */
	protected $id = null;
	
	/**
	 * Variable associated with `categories_image` column in table.
	 *
	 * @var string
	 */
	protected $image = null;
	
	/**
	 * Variable associated with `parent_id` column in table.
	 *
	 * @var string
	 */
	protected $parent_id = null;
	
	/**
	 * Variable associated with `sort_order` column in table.
	 *
	 * @var string
	 */
	protected $sort_order = null;
	
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
	 * Variable associated with `categories_status` column in table.
	 *
	 * @var string
	 */
	protected $status = null;
	
	/* Variable associated with `categories_name` column in table.
	 *
	 * @var string
	 */
	protected $name = null;
	
	/**
	 * Variable associated with `categories_description` column in table.
	 *
	 * @var string
	 */
	protected $description = null;
	
	/**
	 * Create an instance of the CartCategory class.
	 * 
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template CartCategory object is returned.
	 *
	 * @param int $categories_id
	 * @return CartCategory object
	 */
	public function __construct( $categories_id = null ) {
		if (!is_null($categories_id)) {
			$sql = 'select c.*, cd.* from cart_categories c LEFT JOIN cart_categories_description cd ON (cd.categories_id = c.categories_id) where c.categories_id=' . $categories_id;
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			// sets from cart_categories table
			$this->setId($result['categories_id']);
			$this->setImage($result['categories_image']);
			$this->setParent_id($result['parent_id']);
			$this->setSort_order($result['sort_order']);
			$this->setDate_added($result['date_added']);
			$this->setLast_modified($result['last_modified']);
			$this->setStatus($result['categories_status']);
			
			// sets from cart_categories_description table
			$this->setName($result['categories_name']);
			$this->setDescription($result['categories_description']);
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
	 * Returns the object's Image
	 *
	 * @return string
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * Returns the object's Parent_id
	 *
	 * @return string
	 */
	public function getParent_id() {
		return $this->parent_id;
	}

	/**
	 * Returns the object's Sort_order
	 *
	 * @return string
	 */
	public function getSort_order() {
		return $this->sort_order;
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
	 * Returns the object's Status
	 *
	 * @return string
	 */
	public function getStatus() {
		return $this->status;
	}
	
	public function getName() {
		return $this->name;
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
	 * Sets the object's Image
	 *
	 * @param string $image New $this->image value
	 */
	public function setImage( $image ) {
		$this->image = $image;
	}

	/**
	 * Sets the object's Parent_id
	 *
	 * @param string $parent_id New $this->parent_id value
	 */
	public function setParent_id( $parent_id ) {
		$this->parent_id = $parent_id;
	}

	/**
	 * Sets the object's Sort_order
	 *
	 * @param string $sort_order New $this->sort_order value
	 */
	public function setSort_order( $sort_order ) {
		$this->sort_order = $sort_order;
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
	 * Sets the object's Status
	 *
	 * @param string $status New $this->status value
	 */
	public function setStatus( $status ) {
		$this->status = $status;
	}
	
	public function setName ( $name ) {
		$this->name = $name; 
	}
	
	public function setDescription( $desc ) {
		$this->description = $desc;
	}

	public function getSubCategories() {
		return $this->getCartCategorys(array('parent_id' => $this->getId()));
	}

	/**
	 * Save the object in the database
	 */
	public function save() {
		$date = date('Y-m-d H:i:s');
		$this->setLast_modified($date);
		
		if (!is_null($this->getId())) {
			$sql = 'update cart_categories set ';
		} else {
			$sql = 'insert into cart_categories set ';
			$this->setDate_added($date);
		}
		if (!is_null($this->getImage())) {
			$sql .= '`categories_image`="' . e($this->getImage()->getId()) . '", ';
		}
		if (!is_null($this->getParent_id())) {
			$sql .= '`parent_id`="' . e($this->getParent_id()) . '", ';
		}
		if (!is_null($this->getSort_order())) {
			$sql .= '`sort_order`="' . e($this->getSort_order()) . '", ';
		}
		if (!is_null($this->getDate_added())) {
			$sql .= '`date_added`="' . e($this->getDate_added()) . '", ';
		}
		if (!is_null($this->getLast_modified())) {
			$sql .= '`last_modified`="' . e($this->getLast_modified()) . '", ';
		}
		if (!is_null($this->getStatus())) {
			$sql .= '`categories_status`="' . e($this->getStatus()) . '", ';
		}
		if (!is_null($this->getId())) {
			$sql .= 'categories_id="' . e($this->getId()) . '" where categories_id="' . e($this->getId()) . '"';
		} else {
			$sql = trim($sql, ', ');
		}
		Database::singleton()->query($sql);
		$catId = Database::singleton()->lastInsertedID();
		$new = false;
		if (is_null($this->getId())) {
			$this->setId($catId);
			$new = true;
			$sql = 'insert into cart_categories_description set ';
		} else {
			$sql = 'update cart_categories_description set ';
		}
		$sql .= '`language_id`="' . 1 . '", ';
		$sql .= '`categories_name`="' . e($this->getName()) . '", ';
		$sql .= '`categories_description`="' . e($this->getDescription()) . '"';
		
		if ($new) {
			$sql .= ', `categories_id`="' . e($this->getId()) . '"';
		} else {
			$sql .= ' where `categories_id`="' . e($this->getId()) . '"';
		}
		Database::singleton()->query($sql);
		
		self::__construct($this->getId());
	}

	/**
	 * Delete the object from the database
	 */
	public function delete() {
		$sql = 'delete from cart_categories where categories_id="' . e($this->getId()) . '"';
		Database::singleton()->query($sql);
		
		$sql = 'delete from cart_categories_description where categories_id="' . e($this->getId()) . '"';
		Database::singleton()->query($sql);
		
		$cats = $this->getSubCategories();
		foreach ($cats as $cat) {
			$cat->delete();
		}
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/Cart') {
		$form = new Form('CartCategory_addedit', 'post', $target);
		
		$form->setConstants( array ( 'section' => 'categories' ) );
		$form->addElement( 'hidden', 'section' );
		$form->setConstants( array ( 'action' => 'addedit' ) );
		$form->addElement( 'hidden', 'action' );
		
		if (!is_null($this->getId())) {
			$form->setConstants( array ( 'cartcategory_categories_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'cartcategory_categories_id' );
			
			$defaultValues ['cartcategory_name'] = $this->getName();
			$defaultValues ['cartcategory_description'] = $this->getDescription();
			$defaultValues ['cartcategory_image'] = $this->getImage();
			$defaultValues ['cartcategory_parent_id'] = $this->getParent_id();
			$defaultValues ['cartcategory_date_added'] = $this->getDate_added();
			$defaultValues ['cartcategory_last_modified'] = $this->getLast_modified();
			$defaultValues ['cartcategory_status'] = $this->getStatus();

			$form->setDefaults( $defaultValues );
		}
		
		$form->addElement('text', 'cartcategory_name', 'Name');
		
		$description = $form->addElement('textarea', 'cartcategory_description', 'Description');
		$description->setCols(80);
		$description->setRows(10);
		
		$newImage = $form->addElement('file', 'cartcategory_image_upload', 'Category Image');
		$curImage = $form->addElement('dbimage', 'cartcategory_image', $this->getImage());
		
		$form->addElement('select', 'cartcategory_parent_id', 'Parent Category', self::toArray());
		
		$added = $form->addElement('text', 'cartcategory_date_added', 'Date Added');
		$added->freeze();
		
		$modified = $form->addElement('text', 'cartcategory_last_modified', 'Date Last Modified');
		$modified->freeze();
		
		$form->addElement('select', 'cartcategory_status', 'Status', Form::statusArray());
		$form->addElement('submit', 'cartcategory_submit', 'Submit');

		if (isset($_REQUEST['cartcategory_submit']) && $form->validate() && $form->isSubmitted()) {
			$this->setName($form->exportValue('cartcategory_name'));
			$this->setDescription($form->exportValue('cartcategory_description'));
			$this->setImage($form->exportValue('cartcategory_image'));
			$this->setParent_id($form->exportValue('cartcategory_parent_id'));
			$this->setDate_added($form->exportValue('cartcategory_date_added'));
			$this->setLast_modified($form->exportValue('cartcategory_last_modified'));
			$this->setStatus($form->exportValue('cartcategory_status'));
			
			if ($newImage->isUploadedFile()) {
				$im = new Image();
				$id = $im->insert($newImage->getValue());
				$this->setImage($im);
				
				$curImage->setSource($this->getImage()->getId());
			}
			
			$this->save();
		}

		return $form;
		
	}
	
	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getCartCategorys($limiter = null) {
		$sql = 'select `categories_id` from cart_categories';
		
		if (!is_null($limiter)) {
			$i = 0;
			$sql .= ' where ';
			foreach ($limiter as $key => $item) {
				$i++;
				$sql .= ' `' . $key . '`="' . $item . '"';
				if ($i < count($limiter)) {
					$sql .= ' and';
				}
			}
		}
		
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new CartCategory($result['categories_id']);
		}
		
		return $results;
	}
	
	public static function &toArray($roots = null,&$menu = array('0' => '[ Top Level Item ]'),$depth = 0) {
		if (is_null( $roots ))
			$roots = self::getCartCategorys(array('parent_id' => 0));
		foreach ( $roots as $root ) {
			$menu [$root->getId()] = str_repeat( '&nbsp;', $depth * 5 ) . '- ' . $root->getName();
			if (! is_null( $root->getSubCategories() )) {
				self::toArray( $root->getSubCategories(), $menu, $depth + 1 );
			}
		}
		return $menu;
	}
	
	public function getCatManufacturers() {
		$sql = 'SELECT m.manufacturers_id FROM cart_products p LEFT JOIN cart_manufacturers m ON (p.manufacturers_id = m.manufacturers_id) where p.master_categories_id=' . $this->getId() . ' group by m.manufacturers_id';
		$r = Database::singleton()->query_fetch_all($sql);
		
		foreach ($r as &$man) {
			$man = new CartManufacturer($man['manufacturers_id']);
		}
		return ($r);
	}
	
	public function getCountCatProducts() {
		$sql = 'select count(products_id) as `count` from cart_products_to_categories where categories_id=' . $this->getId();
		$rs = Database::singleton()->query_fetch($sql);
		
		return $rs['count'];
	}
	
}
?>