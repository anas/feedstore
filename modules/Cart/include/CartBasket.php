<?php
/**
 * CartBasket
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
class CartBasket {

	/**
	 * Variable associated with `customers_basket_id` column in table.
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
	 * Variable associated with `customers_basket_quantity` column in table.
	 *
	 * @var string
	 */
	protected $quantity = null;
	
	/**
	 * Variable associated with `final_price` column in table.
	 *
	 * @var string
	 */
	protected $price = null;
	
	/**
	 * Variable associated with `customers_basket_date_added` column in table.
	 *
	 * @var string
	 */
	protected $date = null;
	
	/**
	 * Create an instance of the CartBasket class.
	 * 
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template CartBasket object is returned.
	 *
	 * @param int $customers_basket_id
	 * @return CartBasket object
	 */
	public function __construct( $customers_basket_id = null ) {
		if (!is_null($customers_basket_id)) {
			$sql = 'select * from cart_customers_basket where customers_basket_id=' . $customers_basket_id;
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->setId($result['customers_basket_id']);
			$this->setUser($result['customers_id']);
			$this->setProduct($result['products_id']);
			$this->setQuantity($result['customers_basket_quantity']);
			$this->setPrice($result['final_price']);
			$this->setDate($result['customers_basket_date_added']);
		}
	}

	public function getAttribute() {
		return CartBasketAttribute::getByUniqId($this->getProduct()->getId() . ':' . $this->getProduct()->getAttId());
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
	 * Returns the object's Quantity
	 *
	 * @return string
	 */
	public function getQuantity() {
		return $this->quantity;
	}

	/**
	 * Returns the object's Price
	 *
	 * @return string
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * Returns the object's Date
	 *
	 * @return string
	 */
	public function getDate() {
		return $this->date;
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
		require_once('CartProduct.php');
		$this->product = new CartProduct($product);
	}

	/**
	 * Sets the object's Quantity
	 *
	 * @param string $quantity New $this->quantity value
	 */
	public function setQuantity( $quantity ) {
		$this->quantity = $quantity;
	}

	/**
	 * Sets the object's Price
	 *
	 * @param string $price New $this->price value
	 */
	public function setPrice( $price ) {
		$this->price = $price;
	}

	/**
	 * Sets the object's Date
	 *
	 * @param string $date New $this->date value
	 */
	public function setDate( $date ) {
		$this->date = $date;
	}


	/**
	 * Save the object in the database
	 */
	public function save() {
		if (!is_null($this->getId())) {
			$sql = 'update cart_customers_basket set ';
		} else {
			$sql = 'insert into cart_customers_basket set ';
		}
		if (!is_null($this->getUser())) {
			$sql .= '`customers_id`="' . e($this->getUser()->getId()) . '", ';
		}
		if (!is_null($this->getProduct()) && !$this->getProduct()->getAttId()) {
			$sql .= '`products_id`="' . e($this->getProduct()->getId()) . '", ';
		} else if (!is_null($this->getProduct())) {
			$sql .= '`products_id`="' . e($this->getProduct()->getId() . ':' . $this->getProduct()->getAttId()) . '", ';
		}
		if (!is_null($this->getQuantity())) {
			$sql .= '`customers_basket_quantity`="' . e($this->getQuantity()) . '", ';
		}
		if (!is_null($this->getPrice())) {
			$sql .= '`final_price`="' . e($this->getPrice()) . '", ';
		}
		if (!is_null($this->getDate())) {
			$sql .= '`customers_basket_date_added`="' . e($this->getDate()) . '", ';
		} else {
			$sql .= '`customers_basket_date_added`="' . e(date('Ymd')) . '", ';
		}
		if (!is_null($this->getId())) {
			$sql .= 'customers_basket_id="' . e($this->getId()) . '" where customers_basket_id="' . e($this->getId()) . '"';
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
		$sql = 'delete from cart_customers_basket where customers_basket_id="' . e($this->getId()) . '"';
		Database::singleton()->query($sql);
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/CartBasket') {
		$form = new Form('CartBasket_addedit', 'post', $target);
		
		$form->setConstants( array ( 'section' => 'addedit' ) );
		$form->addElement( 'hidden', 'section' );
		
		if (!is_null($this->getId())) {
			$form->setConstants( array ( 'cartbasket_customers_basket_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'cartbasket_customers_basket_id' );
			
			$defaultValues ['cartbasket_user'] = $this->getUser()->getId();
			$defaultValues ['cartbasket_product'] = $this->getProduct();
			$defaultValues ['cartbasket_quantity'] = $this->getQuantity();
			$defaultValues ['cartbasket_price'] = $this->getPrice();
			$defaultValues ['cartbasket_date'] = $this->getDate();

			$form->setDefaults( $defaultValues );
		}
					
		$form->addElement('text', 'cartbasket_user', 'user');
		$form->addElement('text', 'cartbasket_product', 'product');
		$form->addElement('text', 'cartbasket_quantity', 'quantity');
		$form->addElement('text', 'cartbasket_price', 'price');
		$form->addElement('text', 'cartbasket_date', 'date');
		$form->addElement('submit', 'cartbasket_submit', 'Submit');

		if ($form->validate() && $form->isSubmitted()) {
			$this->setUser($form->exportValue('cartbasket_user'));
			$this->setProduct($form->exportValue('cartbasket_product'));
			$this->setQuantity($form->exportValue('cartbasket_quantity'));
			$this->setPrice($form->exportValue('cartbasket_price'));
			$this->setDate($form->exportValue('cartbasket_date'));
			$this->save();
		}

		return $form;
		
	}
	
	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllCartBaskets() {
		$sql = 'select `customers_basket_id` from cart_customers_basket';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new CartBasket($result['customers_basket_id']);
		}
		
		return $results;
	}
	
	public static function getUserCartBaskets($uid = null) {
		if (!is_null($uid)) {
			$sql = 'select `customers_basket_id` from cart_customers_basket where customers_id=' . e($uid);
			$results = Database::singleton()->query_fetch_all($sql);
			foreach ($results as &$result) {
				$result = new CartBasket($result['customers_basket_id']);
			}
		}
		
		if (isset($_SESSION['cart_basket'])) {
			foreach ($_SESSION['cart_basket'] as $result) {
				$results[] = $result;
			}
		}
		
		return @$results;
	}
	
}
?>