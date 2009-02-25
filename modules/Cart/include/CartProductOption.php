<?php
/**
 * CartProductOption
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
class CartProductOption {

	/**
	 * Variable associated with `products_options_id` column in table.
	 *
	 * @var string
	 */
	protected $id = null;
	
	/**
	 * Variable associated with `language_id` column in table.
	 *
	 * @var string
	 */
	protected $languageId = null;
	
	/**
	 * Variable associated with `products_options_name` column in table.
	 *
	 * @var string
	 */
	protected $name = null;
	
	/**
	 * Variable associated with `products_options_sort_order` column in table.
	 *
	 * @var string
	 */
	protected $sort = null;
	
	/**
	 * Variable associated with `products_options_type` column in table.
	 *
	 * @var string
	 */
	protected $type = null;
	
	/**
	 * Variable associated with `products_options_length` column in table.
	 *
	 * @var string
	 */
	protected $length = null;
	
	/**
	 * Variable associated with `products_options_comment` column in table.
	 *
	 * @var string
	 */
	protected $comment = null;
	
	/**
	 * Variable associated with `products_options_size` column in table.
	 *
	 * @var string
	 */
	protected $size = null;
	
	/**
	 * Variable associated with `products_options_images_per_row` column in table.
	 *
	 * @var string
	 */
	protected $imagesPerRow = null;
	
	/**
	 * Variable associated with `products_options_images_style` column in table.
	 *
	 * @var string
	 */
	protected $imagesStyle = null;
	
	/**
	 * Variable associated with `products_options_rows` column in table.
	 *
	 * @var string
	 */
	protected $rows = null;
	
	/**
	 * Create an instance of the CartProductOption class.
	 * 
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template CartProductOption object is returned.
	 *
	 * @param int $language_id
	 * @return CartProductOption object
	 */
	public function __construct( $products_options_id = null ) {
		if (!is_null($products_options_id)) {
			$sql = 'select * from cart_products_options where products_options_id=' . $products_options_id;
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->setId($result['products_options_id']);
			$this->setLanguageId($result['language_id']);
			$this->setName($result['products_options_name']);
			$this->setSort($result['products_options_sort_order']);
			$this->setType($result['products_options_type']);
			$this->setLength($result['products_options_length']);
			$this->setComment($result['products_options_comment']);
			$this->setSize($result['products_options_size']);
			$this->setImagesPerRow($result['products_options_images_per_row']);
			$this->setImagesStyle($result['products_options_images_style']);
			$this->setRows($result['products_options_rows']);
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
	 * Returns the object's LanguageId
	 *
	 * @return string
	 */
	public function getLanguageId() {
		return $this->languageId;
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
	 * Returns the object's Sort
	 *
	 * @return string
	 */
	public function getSort() {
		return $this->sort;
	}

	/**
	 * Returns the object's Type
	 *
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Returns the object's Length
	 *
	 * @return string
	 */
	public function getLength() {
		return $this->length;
	}

	/**
	 * Returns the object's Comment
	 *
	 * @return string
	 */
	public function getComment() {
		return $this->comment;
	}

	/**
	 * Returns the object's Size
	 *
	 * @return string
	 */
	public function getSize() {
		return $this->size;
	}

	/**
	 * Returns the object's ImagesPerRow
	 *
	 * @return string
	 */
	public function getImagesPerRow() {
		return $this->imagesPerRow;
	}

	/**
	 * Returns the object's ImagesStyle
	 *
	 * @return string
	 */
	public function getImagesStyle() {
		return $this->imagesStyle;
	}

	/**
	 * Returns the object's Rows
	 *
	 * @return string
	 */
	public function getRows() {
		return $this->rows;
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
	 * Sets the object's LanguageId
	 *
	 * @param string $languageId New $this->languageId value
	 */
	public function setLanguageId( $languageId ) {
		$this->languageId = $languageId;
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
	 * Sets the object's Type
	 *
	 * @param string $type New $this->type value
	 */
	public function setType( $type ) {
		$this->type = $type;
	}

	/**
	 * Sets the object's Length
	 *
	 * @param string $length New $this->length value
	 */
	public function setLength( $length ) {
		$this->length = $length;
	}

	/**
	 * Sets the object's Comment
	 *
	 * @param string $comment New $this->comment value
	 */
	public function setComment( $comment ) {
		$this->comment = $comment;
	}

	/**
	 * Sets the object's Size
	 *
	 * @param string $size New $this->size value
	 */
	public function setSize( $size ) {
		$this->size = $size;
	}

	/**
	 * Sets the object's ImagesPerRow
	 *
	 * @param string $imagesPerRow New $this->imagesPerRow value
	 */
	public function setImagesPerRow( $imagesPerRow ) {
		$this->imagesPerRow = $imagesPerRow;
	}

	/**
	 * Sets the object's ImagesStyle
	 *
	 * @param string $imagesStyle New $this->imagesStyle value
	 */
	public function setImagesStyle( $imagesStyle ) {
		$this->imagesStyle = $imagesStyle;
	}

	/**
	 * Sets the object's Rows
	 *
	 * @param string $rows New $this->rows value
	 */
	public function setRows( $rows ) {
		$this->rows = $rows;
	}

	
	public function getOptionsValues() {
		$sql = 'select `products_options_values_id` from cart_products_options_values_to_products_options where products_options_id=' . e($this->getId());
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new CartProductOptionValue($result['products_options_values_id']);
		}
		
		return $results;
	}

	/**
	 * Save the object in the database
	 */
	public function save() {
		if (!is_null($this->getId())) {
			$sql = 'update cart_products_options set ';
		} else {
			$sql = 'insert into cart_products_options set ';
		}
		if (!is_null($this->getLanguageId())) {
			$sql .= '`language_id`="' . e($this->getLanguageId()) . '", ';
		}
		if (!is_null($this->getName())) {
			$sql .= '`products_options_name`="' . e($this->getName()) . '", ';
		}
		if (!is_null($this->getSort())) {
			$sql .= '`products_options_sort_order`="' . e($this->getSort()) . '", ';
		}
		if (!is_null($this->getType())) {
			$sql .= '`products_options_type`="' . e($this->getType()) . '", ';
		}
		if (!is_null($this->getLength())) {
			$sql .= '`products_options_length`="' . e($this->getLength()) . '", ';
		}
		if (!is_null($this->getComment())) {
			$sql .= '`products_options_comment`="' . e($this->getComment()) . '", ';
		}
		if (!is_null($this->getSize())) {
			$sql .= '`products_options_size`="' . e($this->getSize()) . '", ';
		}
		if (!is_null($this->getImagesPerRow())) {
			$sql .= '`products_options_images_per_row`="' . e($this->getImagesPerRow()) . '", ';
		}
		if (!is_null($this->getImagesStyle())) {
			$sql .= '`products_options_images_style`="' . e($this->getImagesStyle()) . '", ';
		}
		if (!is_null($this->getRows())) {
			$sql .= '`products_options_rows`="' . e($this->getRows()) . '", ';
		}
		if (!is_null($this->getId())) {
			$sql .= 'products_options_id="' . e($this->getId()) . '" where products_options_id="' . e($this->getId()) . '"';
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
		$sql = 'delete from cart_products_options where products_options_id="' . e($this->getId()) . '"';
		Database::singleton()->query($sql);
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/Cart') {
		$form = new Form('CartProductOption_addedit', 'post', $target);
		
		$form->setConstants( array ( 'section' => 'attributes' ) );
		$form->addElement( 'hidden', 'section' );
		$form->setConstants( array ( 'action' => 'addedit' ) );
		$form->addElement( 'hidden', 'action' );
		if (!is_null($this->getId())) {
			$form->setConstants( array ( 'cartproductoption_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'cartproductoption_id' );
			
			$defaultValues ['cartproductoption_language_id'] = $this->getLanguageId();
			$defaultValues ['cartproductoption_name'] = $this->getName();
			$defaultValues ['cartproductoption_sort'] = $this->getSort();
			$defaultValues ['cartproductoption_type'] = $this->getType();
			$defaultValues ['cartproductoption_length'] = $this->getLength();
			$defaultValues ['cartproductoption_comment'] = $this->getComment();
			$defaultValues ['cartproductoption_size'] = $this->getSize();
			$defaultValues ['cartproductoption_imagesPerRow'] = $this->getImagesPerRow();
			$defaultValues ['cartproductoption_imagesStyle'] = $this->getImagesStyle();
			$defaultValues ['cartproductoption_rows'] = $this->getRows();

			$form->setDefaults( $defaultValues );
		}
					
		$form->addElement('text', 'cartproductoption_name', 'Name');
		$form->addElement('text', 'cartproductoption_comment', 'Comment');
		$form->addElement('submit', 'cartproductoption_submit', 'Submit');

		if ($form->validate() && $form->isSubmitted() && isset($_REQUEST['cartproductoption_submit'])) {
			$this->setName($form->exportValue('cartproductoption_name'));
			$this->setComment($form->exportValue('cartproductoption_comment'));
			$this->save();
		}

		return $form;
		
	}
	
	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllCartProductOptions() {
		$sql = 'select `products_options_id` from cart_products_options';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new CartProductOption($result['products_options_id']);
		}
		
		return $results;
	}
	
	public static function toArray() {
		$options = self::getAllCartProductOptions();
		
		$a = array();
		foreach ($options as $option) {
			$a[$option->getId()] = $option->getName();
		}
		return $a;
	}
	
	public function getValues() {
		$sql = 'select products_options_values_id from cart_products_options_values_to_products_options where products_options_id=' . e($this->getId());
		$rs = Database::singleton()->query_fetch_all($sql);
		
		$a = array();
		foreach ($rs as $r) {
			$r = new CartProductOptionValue($r['products_options_values_id']);
			$cur =& $a[];
			$cur['id'] = $r->getId();
			$cur['value'] = $r->getName();
			
		}
		return $a;
	}
	
}
?>