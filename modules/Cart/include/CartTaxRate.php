<?php
require_once('CartTaxClass.php');

/**
 * CartTaxRate
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
class CartTaxRate {

	/**
	 * Variable associated with `tax_rates_id` column in table.
	 *
	 * @var string
	 */
	protected $id = null;
	
	/**
	 * Variable associated with `tax_zone_id` column in table.
	 *
	 * @var string
	 */
	protected $zone = null;
	
	/**
	 * Variable associated with `tax_class_id` column in table.
	 *
	 * @var string
	 */
	protected $taxClass = null;
	
	/**
	 * Variable associated with `tax_priority` column in table.
	 *
	 * @var string
	 */
	protected $tax_priority = null;
	
	/**
	 * Variable associated with `tax_rate` column in table.
	 *
	 * @var string
	 */
	protected $rate = null;
	
	/**
	 * Variable associated with `tax_description` column in table.
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
	 * Create an instance of the CartTaxRate class.
	 * 
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template CartTaxRate object is returned.
	 *
	 * @param int $tax_rates_id
	 * @return CartTaxRate object
	 */
	public function __construct( $tax_rates_id = null ) {
		if (!is_null($tax_rates_id)) {
			$sql = 'select * from cart_tax_rates where tax_rates_id=' . $tax_rates_id;
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->setId($result['tax_rates_id']);
			$this->setZone($result['tax_zone_id']);
			$this->setTaxClass($result['tax_class_id']);
			$this->setTax_priority($result['tax_priority']);
			$this->setRate($result['tax_rate']);
			$this->setDescription($result['tax_description']);
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
	 * Returns the object's Zone
	 *
	 * @return string
	 */
	public function getZone() {
		return $this->zone;
	}
	
	public function getZoneName() {
		$sql = 'select s.name as state, c.name as country from states s LEFT JOIN countries c ON (s.country = c.id) where s.id=' . e($this->getZone());
		$r = Database::singleton()->query_fetch($sql);
		return $r['state'] . ', ' . $r['country'];
	}

	/**
	 * Returns the object's TaxClass
	 *
	 * @return string
	 */
	public function getTaxClass() {
		return $this->taxClass;
	}

	/**
	 * Returns the object's Tax_priority
	 *
	 * @return string
	 */
	public function getTax_priority() {
		return $this->tax_priority;
	}

	/**
	 * Returns the object's Rate
	 *
	 * @return string
	 */
	public function getRate() {
		return $this->rate;
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
	 * Sets the object's Zone
	 *
	 * @param string $zone New $this->zone value
	 */
	public function setZone( $zone ) {
		$this->zone = $zone;
	}

	/**
	 * Sets the object's TaxClass
	 *
	 * @param string $taxClass New $this->taxClass value
	 */
	public function setTaxClass( $taxClass ) {
		$this->taxClass = new CartTaxClass($taxClass);
	}

	/**
	 * Sets the object's Tax_priority
	 *
	 * @param string $tax_priority New $this->tax_priority value
	 */
	public function setTax_priority( $tax_priority ) {
		$this->tax_priority = $tax_priority;
	}

	/**
	 * Sets the object's Rate
	 *
	 * @param string $rate New $this->rate value
	 */
	public function setRate( $rate ) {
		$this->rate = $rate;
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
			$sql = 'update cart_tax_rates set ';
		} else {
			$sql = 'insert into cart_tax_rates set ';
		}
		if (!is_null($this->getZone())) {
			$sql .= '`tax_zone_id`="' . e($this->getZone()) . '", ';
		}
		if (!is_null($this->getTaxClass())) {
			$sql .= '`tax_class_id`="' . e($this->getTaxClass()->getId()) . '", ';
		}
		if (!is_null($this->getTax_priority())) {
			$sql .= '`tax_priority`="' . e($this->getTax_priority()) . '", ';
		}
		if (!is_null($this->getRate())) {
			$sql .= '`tax_rate`="' . e($this->getRate()) . '", ';
		}
		if (!is_null($this->getDescription())) {
			$sql .= '`tax_description`="' . e($this->getDescription()) . '", ';
		}
		if (!is_null($this->getLast_modified())) {
			$sql .= '`last_modified`="' . e($this->getLast_modified()) . '", ';
		}
		if (!is_null($this->getDate_added())) {
			$sql .= '`date_added`="' . e($this->getDate_added()) . '", ';
		}
		if (!is_null($this->getId())) {
			$sql .= 'tax_rates_id="' . e($this->getId()) . '" where tax_rates_id="' . e($this->getId()) . '"';
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
		$sql = 'delete from cart_tax_rates where tax_rates_id="' . e($this->getId()) . '"';
		Database::singleton()->query($sql);
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/Cart') {
		$form = new Form('CartTaxRate_addedit', 'post', $target);
		
		$form->setConstants( array ( 'section' => 'tax_rates' ) );
		$form->addElement( 'hidden', 'section' );
		
		$form->setConstants( array ( 'action' => 'addedit' ) );
		$form->addElement( 'hidden', 'action' );
		
		if (!is_null($this->getId())) {
			$form->setConstants( array ( 'carttaxrate_tax_rates_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'carttaxrate_tax_rates_id' );
			
			$defaultValues ['carttaxrate_zone'] = $this->getZone();
			$defaultValues ['carttaxrate_taxClass'] = $this->getTaxClass()->getId();
			//$defaultValues ['carttaxrate_tax_priority'] = $this->getTax_priority();
			$defaultValues ['carttaxrate_rate'] = $this->getRate();
			$defaultValues ['carttaxrate_description'] = $this->getDescription();
			//$defaultValues ['carttaxrate_last_modified'] = $this->getLast_modified();
			//$defaultValues ['carttaxrate_date_added'] = $this->getDate_added();

			$form->setDefaults( $defaultValues );
		}
					
		$form->addElement('select', 'carttaxrate_zone', 'Zone', Form::getStatesArray());
		$form->addElement('select', 'carttaxrate_taxClass', 'Tax Class', CartTaxClass::toArray());
		//$form->addElement('text', 'carttaxrate_tax_priority', 'tax_priority');
		$form->addElement('text', 'carttaxrate_rate', 'Tax Rate (%)');
		$form->addElement('text', 'carttaxrate_description', 'Description');
		//$form->addElement('text', 'carttaxrate_last_modified', 'last_modified');
		//$form->addElement('text', 'carttaxrate_date_added', 'date_added');
		$form->addElement('submit', 'carttaxrate_submit', 'Submit');
		
		$form->addRule( 'carttaxrate_rate', 'Please enter a Tax Rate', 'required', null );
		$form->addRule( 'carttaxrate_description', 'Please enter a Description', 'required', null );

		if ($form->validate() && $form->isSubmitted()) {
			$this->setZone($form->exportValue('carttaxrate_zone'));
			$this->setTaxClass($form->exportValue('carttaxrate_taxClass'));
			//$this->setTax_priority($form->exportValue('carttaxrate_tax_priority'));
			$this->setRate($form->exportValue('carttaxrate_rate'));
			$this->setDescription($form->exportValue('carttaxrate_description'));
			//$this->setLast_modified($form->exportValue('carttaxrate_last_modified'));
			//$this->setDate_added($form->exportValue('carttaxrate_date_added'));
			$this->save();
		}

		return $form;
		
	}
	
	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllCartTaxRates() {
		$sql = 'select `tax_rates_id` from cart_tax_rates';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new CartTaxRate($result['tax_rates_id']);
		}
		
		return $results;
	}
	
	public static function getTaxRate($class, $zone) {
		if (!$class)
			return new CartTaxRate(0);
		if (!$zone || !$zone->getState())
			return new CartTaxRate(0);
		$sql = 'select `tax_rates_id` from cart_tax_rates where `tax_zone_id`=' . $zone->getState() . ' and `tax_class_id`=' . $class->getId();
		//echo $sql;exit;
		$r = Database::singleton()->query_fetch($sql);
		
		return new CartTaxRate($r['tax_rates_id']);
	}
}
?>