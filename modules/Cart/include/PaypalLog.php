<?php
/**
 * PaypalLog
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
class PaypaLog {

	/**
	 * Variable associated with `id` column in table.
	 *
	 * @var string
	 */
	protected $id = null;
	
	/**
	 * Variable associated with `title` column in table.
	 *
	 * @var string
	 */
	protected $IPN = null;
	
	/**
	 * Variable associated with `image` column in table.
	 *
	 * @var string
	 */
	protected $verified = null;
	
	/**
	 * Variable associated with `sample` column in table.
	 *
	 * @var string
	 */
	protected $validated = null;
	
	/**
	 * Create an instance of the PaypalLog class.
	 * 
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template Book object is returned.
	 *
	 * @param int $id
	 * @return Book object
	 */
	public function __construct( $id = null ) {
		if (!is_null($id)) {
			$sql = 'select * from paypal_requests where id=' . $id;
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->setId($result['id']);
			$this->setIPN($result['IPN']);
			$this->setVerified($result['verified']);
			$this->setValidated($result['validated']);
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
	 * Returns the object's IPN
	 *
	 * @return string
	 */
	public function getIPN() {
		return $this->IPN;
	}

	/**
	 * Returns the object's Verified
	 *
	 * @return string
	 */
	public function getVerified() {
		return $this->verified;
	}

	/**
	 * Returns the object's validated
	 *
	 * @return string
	 */
	public function getValidated() {
		return $this->validated;
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
	public function setIPN( $IPN ) {
		$this->IPN = $IPN;
	}

	/**
	 * Sets the object's verified
	 *
	 * @param string $image New $this->image value
	 */
	public function setVerified( $verified ) {
		$this->verified = $verified;
	}

	/**
	 * Sets the object's Validated
	 *
	 * @param string $sample New $this->sample value
	 */
	public function setValidated( $Validated ) {
		$this->Validated = $Validated;
	}
	
	/**
	 * Save the object in the database
	 */
	public function save() {
		if (!is_null($this->getId())) {
			$sql = 'update paypal_requests set ';
		} else {
			$sql = 'insert into paypal_requests set ';
		}
		if (!is_null($this->getIPN())) {
			$sql .= '`IPN`="' . e($this->getIPN()) . '", ';
		}
		if (!is_null($this->getVerified())) {
			$sql .= '`verified`="' . e($this->getVerified()) . '", ';
		}
		if (!is_null($this->getValidated())) {
			$sql .= '`validated`="' . e($this->getValidated()) . '", ';
		}
		if (!is_null($this->getId())) {
			$sql .= 'id="' . e($this->getId()) . '" where id="' . e($this->getId()) . '"';
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
		$sql = 'delete from paypal_requests where id="' . e($this->getId()) . '"';
		Database::singleton()->query($sql);
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/Book') {
	}
	
	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllPaypalRequests() {
		$sql = 'select `id` from paypal_requests';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new PaypaLog($result['id']);
		}
		
		return $results;
	}
	
}
?>