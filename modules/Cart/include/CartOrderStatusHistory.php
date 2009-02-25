<?php
/**
 * CartOrderStatusHistory
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
class CartOrderStatusHistory {

	/**
	 * Variable associated with `orders_status_history_id` column in table.
	 *
	 * @var string
	 */
	protected $id = null;
	
	/**
	 * Variable associated with `orders_id` column in table.
	 *
	 * @var string
	 */
	protected $orderId = null;
	
	/**
	 * Variable associated with `orders_status_id` column in table.
	 *
	 * @var string
	 */
	protected $status = null;
	
	/**
	 * Variable associated with `date_added` column in table.
	 *
	 * @var string
	 */
	protected $date_added = null;
	
	/**
	 * Variable associated with `customer_notified` column in table.
	 *
	 * @var string
	 */
	protected $customer_notified = null;
	
	/**
	 * Variable associated with `comments` column in table.
	 *
	 * @var string
	 */
	protected $comments = null;
	
	/**
	 * Create an instance of the CartOrderStatusHistory class.
	 * 
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template CartOrderStatusHistory object is returned.
	 *
	 * @param int $orders_status_history_id
	 * @return CartOrderStatusHistory object
	 */
	public function __construct( $orders_status_history_id = null ) {
		if (!is_null($orders_status_history_id)) {
			$sql = 'select * from cart_orders_status_history where orders_status_history_id=' . $orders_status_history_id;
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->setId($result['orders_status_history_id']);
			$this->setOrderId($result['orders_id']);
			$this->setStatus($result['orders_status_id']);
			$this->setDate_added($result['date_added']);
			$this->setCustomer_notified($result['customer_notified']);
			$this->setComments($result['comments']);
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
	 * Returns the object's OrderId
	 *
	 * @return string
	 */
	public function getOrderId() {
		return $this->orderId;
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
	 * Returns the object's Date_added
	 *
	 * @return string
	 */
	public function getDate_added() {
		return $this->date_added;
	}

	/**
	 * Returns the object's Customer_notified
	 *
	 * @return string
	 */
	public function getCustomer_notified() {
		return $this->customer_notified;
	}

	/**
	 * Returns the object's Comments
	 *
	 * @return string
	 */
	public function getComments() {
		return $this->comments;
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
	 * Sets the object's OrderId
	 *
	 * @param string $orderId New $this->orderId value
	 */
	public function setOrderId( $orderId ) {
		$this->orderId = $orderId;
	}

	/**
	 * Sets the object's Status
	 *
	 * @param string $status New $this->status value
	 */
	public function setStatus( $status ) {
		$this->status = new CartOrderStatus($status);
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
	 * Sets the object's Customer_notified
	 *
	 * @param string $customer_notified New $this->customer_notified value
	 */
	public function setCustomer_notified( $customer_notified ) {
		$this->customer_notified = $customer_notified;
	}

	/**
	 * Sets the object's Comments
	 *
	 * @param string $comments New $this->comments value
	 */
	public function setComments( $comments ) {
		$this->comments = $comments;
	}


	/**
	 * Save the object in the database
	 */
	public function save() {
		if (!is_null($this->getId())) {
			$sql = 'update cart_orders_status_history set ';
		} else {
			$sql = 'insert into cart_orders_status_history set ';
		}
		if (!is_null($this->getOrderId())) {
			$sql .= '`orders_id`="' . e($this->getOrderId()) . '", ';
		}
		if (!is_null($this->getStatus())) {
			$sql .= '`orders_status_id`="' . e($this->getStatus()->getId()) . '", ';
		}
		if (!is_null($this->getDate_added())) {
			$sql .= '`date_added`="' . e($this->getDate_added()) . '", ';
		}
		if (!is_null($this->getCustomer_notified())) {
			$sql .= '`customer_notified`="' . e($this->getCustomer_notified()) . '", ';
		}
		if (!is_null($this->getComments())) {
			$sql .= '`comments`="' . e($this->getComments()) . '", ';
		}
		if (!is_null($this->getId())) {
			$sql .= 'orders_status_history_id="' . e($this->getId()) . '" where orders_status_history_id="' . e($this->getId()) . '"';
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
		$sql = 'delete from cart_orders_status_history where orders_status_history_id="' . e($this->getId()) . '"';
		Database::singleton()->query($sql);
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/CartOrderStatusHistory') {
		$form = new Form('CartOrderStatusHistory_addedit', 'post', $target);
		
		$form->setConstants( array ( 'section' => 'addedit' ) );
		$form->addElement( 'hidden', 'section' );
		
		if (!is_null($this->getId())) {
			$form->setConstants( array ( 'cartorderstatushistory_orders_status_history_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'cartorderstatushistory_orders_status_history_id' );
			
			$defaultValues ['cartorderstatushistory_orderId'] = $this->getOrderId();
			$defaultValues ['cartorderstatushistory_status'] = $this->getStatus()->getId();
			$defaultValues ['cartorderstatushistory_date_added'] = $this->getDate_added();
			$defaultValues ['cartorderstatushistory_customer_notified'] = $this->getCustomer_notified();
			$defaultValues ['cartorderstatushistory_comments'] = $this->getComments();

			$form->setDefaults( $defaultValues );
		}
					
		$form->addElement('text', 'cartorderstatushistory_orderId', 'orderId');
		$form->addElement('text', 'cartorderstatushistory_status', 'status');
		$form->addElement('text', 'cartorderstatushistory_date_added', 'date_added');
		$form->addElement('text', 'cartorderstatushistory_customer_notified', 'customer_notified');
		$form->addElement('text', 'cartorderstatushistory_comments', 'comments');
		$form->addElement('submit', 'cartorderstatushistory_submit', 'Submit');

		if ($form->validate() && $form->isSubmitted()) {
			$this->setOrderId($form->exportValue('cartorderstatushistory_orderId'));
			$this->setStatus($form->exportValue('cartorderstatushistory_status'));
			$this->setDate_added($form->exportValue('cartorderstatushistory_date_added'));
			$this->setCustomer_notified($form->exportValue('cartorderstatushistory_customer_notified'));
			$this->setComments($form->exportValue('cartorderstatushistory_comments'));
			$this->save();
		}

		return $form;
		
	}
	
	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllCartOrderStatusHistorys() {
		$sql = 'select `orders_status_history_id` from cart_orders_status_history';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new CartOrderStatusHistory($result['orders_status_history_id']);
		}
		
		return $results;
	}
	
}
?>