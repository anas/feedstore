<?php
/**
 * CartShippingRate
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
class CartShippingRate {

	/**
	 * Variable associated with `id` column in table.
	 *
	 * @var string
	 */
	protected $id = null;
	
	/**
	 * Variable associated with `state_id` column in table.
	 *
	 * @var string
	 */
	protected $state = null;
	
	/**
	 * Variable associated with `country_id` column in table.
	 *
	 * @var string
	 */
	protected $country = null;
	
	/**
	 * Variable associated with `upper_bound` column in table.
	 *
	 * @var string
	 */
	protected $upper_bound = null;
	
	/**
	 * Variable associated with `cost` column in table.
	 *
	 * @var string
	 */
	protected $cost = null;
	
	/**
	 * Create an instance of the CartShippingRate class.
	 * 
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template CartShippingRate object is returned.
	 *
	 * @param int $id
	 * @return CartShippingRate object
	 */
	public function __construct( $id = null ) {
		if (!is_null($id)) {
			$sql = 'select cart_shipping_rate.*, states.code as s_code, states.name as s_name, countries.codetwo as c_code, countries.name as c_name 
				from cart_shipping_rate
				LEFT JOIN states ON cart_shipping_rate.state_id=states.id
				LEFT JOIN countries ON cart_shipping_rate.country_id=countries.id 
				where cart_shipping_rate.id=' . e($id);
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->setId($result['id']);
			$this->setState($result['state_id']);
			$this->setCountry($result['country_id']);
			$this->setUpper_bound($result['upper_bound']);
			$this->setCost($result['cost']);
			
			$this->countryname = $result['c_name'];
			$this->statename = $result['s_name'];}
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
	 * Returns the object's State
	 *
	 * @return string
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * Returns the object's Country
	 *
	 * @return string
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * Returns the object's Upper_bound
	 *
	 * @return string
	 */
	public function getUpper_bound() {
		return $this->upper_bound;
	}

	/**
	 * Returns the object's Cost
	 *
	 * @return string
	 */
	public function getCost() {
		return $this->cost;
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
	 * Sets the object's State
	 *
	 * @param string $state New $this->state value
	 */
	public function setState( $state ) {
		$this->state = $state;
	}

	/**
	 * Sets the object's Country
	 *
	 * @param string $country New $this->country value
	 */
	public function setCountry( $country ) {
		$this->country = $country;
	}

	/**
	 * Sets the object's Upper_bound
	 *
	 * @param string $upper_bound New $this->upper_bound value
	 */
	public function setUpper_bound( $upper_bound ) {
		$this->upper_bound = $upper_bound;
	}

	/**
	 * Sets the object's Cost
	 *
	 * @param string $cost New $this->cost value
	 */
	public function setCost( $cost ) {
		$this->cost = $cost;
	}


	/**
	 * Save the object in the database
	 */
	public function save() {
		if (!is_null($this->getId())) {
			$sql = 'update cart_shipping_rate set ';
		} else {
			$sql = 'insert into cart_shipping_rate set ';
		}
		if (!is_null($this->getState())) {
			$sql .= '`state_id`="' . e($this->getState()) . '", ';
		}
		if (!is_null($this->getCountry())) {
			$sql .= '`country_id`="' . e($this->getCountry()) . '", ';
		}
		if (!is_null($this->getUpper_bound())) {
			$sql .= '`upper_bound`="' . e($this->getUpper_bound()) . '", ';
		}
		if (!is_null($this->getCost())) {
			$sql .= '`cost`="' . e($this->getCost()) . '", ';
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
		$sql = 'delete from cart_shipping_rate where id="' . e($this->getId()) . '"';
		Database::singleton()->query($sql);
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/Cart') {
		$form = new Form('CartShippingRate_addedit', 'post', $target);
		
		$form->setConstants( array ( 'section' => 'shipping' ) );
		$form->addElement( 'hidden', 'section' );
		$form->setConstants( array ( 'action' => 'addedit' ) );
		$form->addElement( 'hidden', 'action' );
		
		if (!is_null($this->getId())) {
			$form->setConstants( array ( 'cartshippingrate_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'cartshippingrate_id' );
			
			$defaultValues ['cartshippingrate_state'] = $this->getState();
			$defaultValues ['cartshippingrate_country'] = $this->getCountry();
			$defaultValues ['cartshippingrate_cost'] = $this->getCost();

			$form->setDefaults( $defaultValues );
		}
		$countrySelect = array(
			'onchange' => 'selectCountry();',
			'id' => 'cartshippingrate_country'
		);
		
		$form->addElement('select', 'cartshippingrate_country', 'Country', Form::getCountryArray(), $countrySelect);
		$form->addElement('select', 'cartshippingrate_state', 'Province/State', Form::getStatesArray("Canada"));
		$form->addElement('text', 'cartshippingrate_cost', 'Shipping Cost');
		$form->addElement('submit', 'cartshippingrate_submit', 'Submit');

		if ($form->validate() && $form->isSubmitted()) {
			$selectedCountry = $form->exportValue('cartshippingrate_country');
			//Only if the selected country is Canada, insert the selected state.
			if (CartShippingRate::hasState($selectedCountry))
				$selectedState = $form->exportValue('cartshippingrate_state');
			else
				$selectedState = 0;
			$this->setCountry($selectedCountry);
			$this->setState($selectedState);
			$this->setCost($form->exportValue('cartshippingrate_cost'));
			$this->save();
		}

		return $form;
		
	}
	
	//This function takes a country as a parameter and returns whether it has states or not.
	//In this example, only Canada has states/provinces. All the other countries do not have states/provinces 
	public static function hasState($countryID){
		if (!$countryID)
			return false;
		$sql = "select name from countries where id=" . e($countryID);
		$r = Database::singleton()->query_fetch($sql);
		if ($r['name'] == "Canada")
			return true;
		return false;
	}
	
	public static function getRateTo($address) {
		$sql = 'select id from cart_shipping_rate where state_id=' . e($address->getState()) . ' and country_id=' . e($address->getCountry());
		$r = Database::singleton()->query_fetch($sql);
		$sr = new CartShippingRate($r['id']);
		return $sr->getCost();
	}
	
	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllCartShippingRates() {
		$sql = 'select `id` from cart_shipping_rate order by country_id';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new CartShippingRate($result['id']);
		}
		
		return $results;
	}
	
}
?>