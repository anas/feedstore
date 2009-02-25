<?php
/**
 * analytics
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
class analytics {

	/**
	 * Variable associated with `id` column in table.
	 *
	 * @var string
	 */
	protected $id = null;
	
	/**
	 * Variable associated with `content` column in table.
	 *
	 * @var string
	 */
	protected $content = null;
	
	/**
	 * Variable associated with `timestamp` column in table.
	 *
	 * @var string
	 */
	protected $timestamp = null;
	
	/**
	 * Create an instance of the analytics class.
	 * 
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template analytics object is returned.
	 *
	 * @param int $id
	 * @return analytics object
	 */
	public function __construct( $id = null ) {
		if (!is_null($id)) {
			$sql = 'select * from analytics where id=' . $id;
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->setId($result['id']);
			$this->setContent($result['content']);
			$this->setTimestamp($result['timestamp']);
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
	 * Returns the object's Content
	 *
	 * @return string
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * Returns the object's Timestamp
	 *
	 * @return string
	 */
	public function getTimestamp() {
		return $this->timestamp;
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
	 * Sets the object's Content
	 *
	 * @param string $content New $this->content value
	 */
	public function setContent( $content ) {
		$this->content = $content;
	}

	/**
	 * Sets the object's Timestamp
	 *
	 * @param string $timestamp New $this->timestamp value
	 */
	public function setTimestamp( $timestamp ) {
		$this->timestamp = $timestamp;
	}


	/**
	 * Save the object in the database
	 */
	public function save() {
		if (!is_null($this->getId())) {
			$sql = 'update analytics set ';
		} else {
			$sql = 'insert into analytics set ';
		}
		if (!is_null($this->getContent())) {
			$sql .= '`content`="' . e($this->getContent()) . '", ';
		}
		/*if (!is_null($this->getTimestamp())) {
			$sql .= '`timestamp`="' . $this->getTimestamp() . '", ';
		}*/
		if (!is_null($this->getId())) {
			$sql .= 'id="' . $this->getId() . '" where id="' . $this->getId() . '"';
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
		$sql = 'delete from analytics where id="' . $this->getId() . '"';
		Database::singleton()->query($sql);
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/Analytics') {
		$form = new Form('analytics_addedit', 'post', $target);
		
		$form->setConstants( array ( 'section' => 'addedit' ) );
		$form->addElement( 'hidden', 'section' );
		
		if (!is_null($this->getId())) {
			$form->setConstants( array ( 'analytics_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'analytics_id' );
			
			$defaultValues ['analytics_content'] = $this->getContent();
			$defaultValues ['analytics_timestamp'] = $this->getTimestamp();

			$form->setDefaults( $defaultValues );
		}
		$form->addElement('html','<br /><span style="color:red; padding-left:125px;">Paste your code below</span>');		
		$form->addElement('textarea', 'analytics_content', 'content', array('rows' => 15, 'cols' => 80));
		//$form->addElement('text', 'analytics_timestamp', 'timestamp');
		$form->addElement('submit', 'analytics_submit', 'Submit');

		if ($form->validate() && $form->isSubmitted()) {
			$this->setContent($form->exportValue('analytics_content'));
			$this->setTimestamp($form->exportValue('analytics_timestamp'));
			$this->save();
		}

		return $form;
		
	}
	
	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllAnalyticss() {
		$sql = 'select `id` from analytics';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new Analytics($result['id']);
		}
		
		return $results;
	}
	
}
?>