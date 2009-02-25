<?php
/**
 * CartProductAttribute
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
class CartProductAttribute {

	/**
	 * Variable associated with `products_attributes_id` column in table.
	 *
	 * @var string
	 */
	protected $id = null;
	
	/**
	 * Variable associated with `products_id` column in table.
	 *
	 * @var string
	 */
	protected $productid = null;
	
	/**
	 * Variable associated with `options_id` column in table.
	 *
	 * @var string
	 */
	protected $optionsId = null;
	
	/**
	 * Variable associated with `options_values_id` column in table.
	 *
	 * @var string
	 */
	protected $valuesId = null;
	
	/**
	 * Variable associated with `options_values_price` column in table.
	 *
	 * @var string
	 */
	protected $valuesPrice = null;
	
	/**
	 * Variable associated with `price_prefix` column in table.
	 *
	 * @var string
	 */
	protected $pricePrefix = null;
	
	/**
	 * Variable associated with `products_options_sort_order` column in table.
	 *
	 * @var string
	 */
	protected $sort = null;
	
	/**
	 * Variable associated with `product_attribute_is_free` column in table.
	 *
	 * @var string
	 */
	protected $isFree = null;
	
	/**
	 * Variable associated with `products_attributes_weight` column in table.
	 *
	 * @var string
	 */
	protected $weight = null;
	
	/**
	 * Variable associated with `products_attributes_weight_prefix` column in table.
	 *
	 * @var string
	 */
	protected $weightPrefix = null;
	
	/**
	 * Variable associated with `attributes_display_only` column in table.
	 *
	 * @var string
	 */
	protected $displayOnly = null;
	
	/**
	 * Variable associated with `attributes_default` column in table.
	 *
	 * @var string
	 */
	protected $default = null;
	
	/**
	 * Variable associated with `attributes_discounted` column in table.
	 *
	 * @var string
	 */
	protected $discounted = null;
	
	/**
	 * Variable associated with `attributes_image` column in table.
	 *
	 * @var string
	 */
	protected $image = null;
	
	/**
	 * Variable associated with `attributes_price_base_included` column in table.
	 *
	 * @var string
	 */
	protected $priceBaseIncluded = null;
	
	/**
	 * Variable associated with `attributes_price_onetime` column in table.
	 *
	 * @var string
	 */
	protected $priceOneTime = null;
	
	/**
	 * Variable associated with `attributes_price_factor` column in table.
	 *
	 * @var string
	 */
	protected $priceFactor = null;
	
	/**
	 * Variable associated with `attributes_price_factor_offset` column in table.
	 *
	 * @var string
	 */
	protected $priceFactorOffset = null;
	
	/**
	 * Variable associated with `attributes_price_factor_onetime` column in table.
	 *
	 * @var string
	 */
	protected $priceFactorOnetime = null;
	
	/**
	 * Variable associated with `attributes_price_factor_onetime_offset` column in table.
	 *
	 * @var string
	 */
	protected $priceFactorOnetimeOffset = null;
	
	/**
	 * Variable associated with `attributes_qty_prices` column in table.
	 *
	 * @var string
	 */
	protected $qtyPrices = null;
	
	/**
	 * Variable associated with `attributes_qty_prices_onetime` column in table.
	 *
	 * @var string
	 */
	protected $qtyPricesOneTime = null;
	
	/**
	 * Variable associated with `attributes_price_words` column in table.
	 *
	 * @var string
	 */
	protected $priceWords = null;
	
	/**
	 * Variable associated with `attributes_price_words_free` column in table.
	 *
	 * @var string
	 */
	protected $priceWordsFree = null;
	
	/**
	 * Variable associated with `attributes_price_letters` column in table.
	 *
	 * @var string
	 */
	protected $priceLetters = null;
	
	/**
	 * Variable associated with `attributes_price_letters_free` column in table.
	 *
	 * @var string
	 */
	protected $priceLettersFree = null;
	
	/**
	 * Variable associated with `attributes_required` column in table.
	 *
	 * @var string
	 */
	protected $required = null;
	
	protected $inventory = null;
	
	/**
	 * Create an instance of the CartProductAttributes class.
	 * 
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template CartProductAttributes object is returned.
	 *
	 * @param int $products_attributes_id
	 * @return CartProductAttributes object
	 */
	public function __construct( $products_attributes_id = null ) {
		if (!is_null($products_attributes_id)) {
			$sql = 'select * from cart_products_attributes where products_attributes_id=' . $products_attributes_id;
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}

			$this->setId($result['products_attributes_id']);
			$this->setProductid($result['products_id']);
			$this->setOptionsId($result['options_id']);
			$this->setValue($result['options_values_id']);
			$this->setValuesPrice($result['options_values_price']);
			$this->setPricePrefix($result['price_prefix']);
			$this->setSort($result['products_options_sort_order']);
			$this->setIsFree($result['product_attribute_is_free']);
			$this->setWeight($result['products_attributes_weight']);
			$this->setWeightPrefix($result['products_attributes_weight_prefix']);
			$this->setDisplayOnly($result['attributes_display_only']);
			$this->setDefault($result['attributes_default']);
			$this->setDiscounted($result['attributes_discounted']);
			$this->setImage($result['attributes_image']);
			$this->setPriceBaseIncluded($result['attributes_price_base_included']);
			$this->setPriceOneTime($result['attributes_price_onetime']);
			$this->setPriceFactor($result['attributes_price_factor']);
			$this->setPriceFactorOffset($result['attributes_price_factor_offset']);
			$this->setPriceFactorOnetime($result['attributes_price_factor_onetime']);
			$this->setPriceFactorOnetimeOffset($result['attributes_price_factor_onetime_offset']);
			$this->setQtyPrices($result['attributes_qty_prices']);
			$this->setQtyPricesOneTime($result['attributes_qty_prices_onetime']);
			$this->setPriceWords($result['attributes_price_words']);
			$this->setPriceWordsFree($result['attributes_price_words_free']);
			$this->setPriceLetters($result['attributes_price_letters']);
			$this->setPriceLettersFree($result['attributes_price_letters_free']);
			$this->setRequired($result['attributes_required']);
			$this->setInventory($result['attributes_quantity']);
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
	 * Returns the object's Productid
	 *
	 * @return string
	 */
	public function getProductid() {
		return $this->productid;
	}

	/**
	 * Returns the object's OptionsId
	 *
	 * @return string
	 */
	public function getOptionsId() {
		return $this->optionsId;
	}

	/**
	 * Returns the object's ValuesId
	 *
	 * @return string
	 */
	public function getValue() {
		return $this->valuesId;
	}

	/**
	 * Returns the object's ValuesPrice
	 *
	 * @return string
	 */
	public function getValuesPrice() {
		return $this->valuesPrice;
	}

	/**
	 * Returns the object's PricePrefix
	 *
	 * @return string
	 */
	public function getPricePrefix() {
		return $this->pricePrefix;
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
	 * Returns the object's IsFree
	 *
	 * @return string
	 */
	public function getIsFree() {
		return $this->isFree;
	}

	/**
	 * Returns the object's Weight
	 *
	 * @return string
	 */
	public function getWeight() {
		return $this->weight;
	}

	/**
	 * Returns the object's WeightPrefix
	 *
	 * @return string
	 */
	public function getWeightPrefix() {
		return $this->weightPrefix;
	}

	/**
	 * Returns the object's DisplayOnly
	 *
	 * @return string
	 */
	public function getDisplayOnly() {
		return $this->displayOnly;
	}

	/**
	 * Returns the object's Default
	 *
	 * @return string
	 */
	public function getDefault() {
		return $this->default;
	}

	/**
	 * Returns the object's Discounted
	 *
	 * @return string
	 */
	public function getDiscounted() {
		return $this->discounted;
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
	 * Returns the object's PriceBaseIncluded
	 *
	 * @return string
	 */
	public function getPriceBaseIncluded() {
		return $this->priceBaseIncluded;
	}

	/**
	 * Returns the object's PriceOneTime
	 *
	 * @return string
	 */
	public function getPriceOneTime() {
		return $this->priceOneTime;
	}

	/**
	 * Returns the object's PriceFactor
	 *
	 * @return string
	 */
	public function getPriceFactor() {
		return $this->priceFactor;
	}

	/**
	 * Returns the object's PriceFactorOffset
	 *
	 * @return string
	 */
	public function getPriceFactorOffset() {
		return $this->priceFactorOffset;
	}

	/**
	 * Returns the object's PriceFactorOnetime
	 *
	 * @return string
	 */
	public function getPriceFactorOnetime() {
		return $this->priceFactorOnetime;
	}

	/**
	 * Returns the object's PriceFactorOnetimeOffset
	 *
	 * @return string
	 */
	public function getPriceFactorOnetimeOffset() {
		return $this->priceFactorOnetimeOffset;
	}

	/**
	 * Returns the object's QtyPrices
	 *
	 * @return string
	 */
	public function getQtyPrices() {
		return $this->qtyPrices;
	}

	/**
	 * Returns the object's QtyPricesOneTime
	 *
	 * @return string
	 */
	public function getQtyPricesOneTime() {
		return $this->qtyPricesOneTime;
	}

	/**
	 * Returns the object's PriceWords
	 *
	 * @return string
	 */
	public function getPriceWords() {
		return $this->priceWords;
	}

	/**
	 * Returns the object's PriceWordsFree
	 *
	 * @return string
	 */
	public function getPriceWordsFree() {
		return $this->priceWordsFree;
	}

	/**
	 * Returns the object's PriceLetters
	 *
	 * @return string
	 */
	public function getPriceLetters() {
		return $this->priceLetters;
	}

	/**
	 * Returns the object's PriceLettersFree
	 *
	 * @return string
	 */
	public function getPriceLettersFree() {
		return $this->priceLettersFree;
	}

	/**
	 * Returns the object's Required
	 *
	 * @return string
	 */
	public function getRequired() {
		return $this->required;
	}
	
	public function getInventory() {
		return $this->inventory;
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
	 * Sets the object's Productid
	 *
	 * @param string $productid New $this->productid value
	 */
	public function setProductid( $productid ) {
		$this->productid = $productid;
	}

	/**
	 * Sets the object's OptionsId
	 *
	 * @param string $optionsId New $this->optionsId value
	 */
	public function setOptionsId( $optionsId ) {
		$this->optionsId = new CartProductOption($optionsId);
	}

	/**
	 * Sets the object's ValuesId
	 *
	 * @param string $valuesId New $this->valuesId value
	 */
	public function setValue( $valuesId ) {
		$this->valuesId = new CartProductOptionValue($valuesId);
	}

	/**
	 * Sets the object's ValuesPrice
	 *
	 * @param string $valuesPrice New $this->valuesPrice value
	 */
	public function setValuesPrice( $valuesPrice ) {
		$this->valuesPrice = $valuesPrice;
	}

	/**
	 * Sets the object's PricePrefix
	 *
	 * @param string $pricePrefix New $this->pricePrefix value
	 */
	public function setPricePrefix( $pricePrefix ) {
		$this->pricePrefix = $pricePrefix;
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
	 * Sets the object's IsFree
	 *
	 * @param string $isFree New $this->isFree value
	 */
	public function setIsFree( $isFree ) {
		$this->isFree = $isFree;
	}

	/**
	 * Sets the object's Weight
	 *
	 * @param string $weight New $this->weight value
	 */
	public function setWeight( $weight ) {
		$this->weight = $weight;
	}

	/**
	 * Sets the object's WeightPrefix
	 *
	 * @param string $weightPrefix New $this->weightPrefix value
	 */
	public function setWeightPrefix( $weightPrefix ) {
		$this->weightPrefix = $weightPrefix;
	}

	/**
	 * Sets the object's DisplayOnly
	 *
	 * @param string $displayOnly New $this->displayOnly value
	 */
	public function setDisplayOnly( $displayOnly ) {
		$this->displayOnly = $displayOnly;
	}

	/**
	 * Sets the object's Default
	 *
	 * @param string $default New $this->default value
	 */
	public function setDefault( $default ) {
		$this->default = $default;
	}

	/**
	 * Sets the object's Discounted
	 *
	 * @param string $discounted New $this->discounted value
	 */
	public function setDiscounted( $discounted ) {
		$this->discounted = $discounted;
	}

	/**
	 * Sets the object's Image
	 *
	 * @param string $image New $this->image value
	 */
	public function setImage( $image ) {
		$this->image = @new Image($image);
	}

	/**
	 * Sets the object's PriceBaseIncluded
	 *
	 * @param string $priceBaseIncluded New $this->priceBaseIncluded value
	 */
	public function setPriceBaseIncluded( $priceBaseIncluded ) {
		$this->priceBaseIncluded = $priceBaseIncluded;
	}

	/**
	 * Sets the object's PriceOneTime
	 *
	 * @param string $priceOneTime New $this->priceOneTime value
	 */
	public function setPriceOneTime( $priceOneTime ) {
		$this->priceOneTime = $priceOneTime;
	}

	/**
	 * Sets the object's PriceFactor
	 *
	 * @param string $priceFactor New $this->priceFactor value
	 */
	public function setPriceFactor( $priceFactor ) {
		$this->priceFactor = $priceFactor;
	}

	/**
	 * Sets the object's PriceFactorOffset
	 *
	 * @param string $priceFactorOffset New $this->priceFactorOffset value
	 */
	public function setPriceFactorOffset( $priceFactorOffset ) {
		$this->priceFactorOffset = $priceFactorOffset;
	}

	/**
	 * Sets the object's PriceFactorOnetime
	 *
	 * @param string $priceFactorOnetime New $this->priceFactorOnetime value
	 */
	public function setPriceFactorOnetime( $priceFactorOnetime ) {
		$this->priceFactorOnetime = $priceFactorOnetime;
	}

	/**
	 * Sets the object's PriceFactorOnetimeOffset
	 *
	 * @param string $priceFactorOnetimeOffset New $this->priceFactorOnetimeOffset value
	 */
	public function setPriceFactorOnetimeOffset( $priceFactorOnetimeOffset ) {
		$this->priceFactorOnetimeOffset = $priceFactorOnetimeOffset;
	}

	/**
	 * Sets the object's QtyPrices
	 *
	 * @param string $qtyPrices New $this->qtyPrices value
	 */
	public function setQtyPrices( $qtyPrices ) {
		$this->qtyPrices = $qtyPrices;
	}

	/**
	 * Sets the object's QtyPricesOneTime
	 *
	 * @param string $qtyPricesOneTime New $this->qtyPricesOneTime value
	 */
	public function setQtyPricesOneTime( $qtyPricesOneTime ) {
		$this->qtyPricesOneTime = $qtyPricesOneTime;
	}

	/**
	 * Sets the object's PriceWords
	 *
	 * @param string $priceWords New $this->priceWords value
	 */
	public function setPriceWords( $priceWords ) {
		$this->priceWords = $priceWords;
	}

	/**
	 * Sets the object's PriceWordsFree
	 *
	 * @param string $priceWordsFree New $this->priceWordsFree value
	 */
	public function setPriceWordsFree( $priceWordsFree ) {
		$this->priceWordsFree = $priceWordsFree;
	}

	/**
	 * Sets the object's PriceLetters
	 *
	 * @param string $priceLetters New $this->priceLetters value
	 */
	public function setPriceLetters( $priceLetters ) {
		$this->priceLetters = $priceLetters;
	}

	/**
	 * Sets the object's PriceLettersFree
	 *
	 * @param string $priceLettersFree New $this->priceLettersFree value
	 */
	public function setPriceLettersFree( $priceLettersFree ) {
		$this->priceLettersFree = $priceLettersFree;
	}

	/**
	 * Sets the object's Required
	 *
	 * @param string $required New $this->required value
	 */
	public function setRequired( $required ) {
		$this->required = $required;
	}
	
	public function setInventory($q) {
		$this->inventory = $q;
	}


	/**
	 * Save the object in the database
	 */
	public function save() {
		if (!is_null($this->getId())) {
			$sql = 'update cart_products_attributes set ';
		} else {
			$sql = 'insert into cart_products_attributes set ';
		}
		if (!is_null($this->getProductid())) {
			$sql .= '`products_id`="' . e($this->getProductid()) . '", ';
		}
		if (!is_null($this->getOptionsId())) {
			$sql .= '`options_id`="' . e($this->getOptionsId()->getId()) . '", ';
		}
		if (!is_null($this->getValue())) {
			$sql .= '`options_values_id`="' . e($this->getValue()->getId()) . '", ';
		}
		if (!is_null($this->getValuesPrice())) {
			$sql .= '`options_values_price`="' . e($this->getValuesPrice()) . '", ';
		}
		if (!is_null($this->getPricePrefix())) {
			$sql .= '`price_prefix`="' . e($this->getPricePrefix()) . '", ';
		}
		if (!is_null($this->getSort())) {
			$sql .= '`products_options_sort_order`="' . e($this->getSort()) . '", ';
		}
		if (!is_null($this->getIsFree())) {
			$sql .= '`product_attribute_is_free`="' . e($this->getIsFree()) . '", ';
		}
		if (!is_null($this->getWeight())) {
			$sql .= '`products_attributes_weight`="' . e($this->getWeight()) . '", ';
		}
		if (!is_null($this->getWeightPrefix())) {
			$sql .= '`products_attributes_weight_prefix`="' . e($this->getWeightPrefix()) . '", ';
		}
		if (!is_null($this->getDisplayOnly())) {
			$sql .= '`attributes_display_only`="' . e($this->getDisplayOnly()) . '", ';
		}
		if (!is_null($this->getDefault())) {
			$sql .= '`attributes_default`="' . e($this->getDefault()) . '", ';
		}
		if (!is_null($this->getDiscounted())) {
			$sql .= '`attributes_discounted`="' . e($this->getDiscounted()) . '", ';
		}
		if (!is_null($this->getImage())) {
			$sql .= '`attributes_image`="' . e($this->getImage()->getId()) . '", ';
		}
		if (!is_null($this->getPriceBaseIncluded())) {
			$sql .= '`attributes_price_base_included`="' . e($this->getPriceBaseIncluded()) . '", ';
		}
		if (!is_null($this->getPriceOneTime())) {
			$sql .= '`attributes_price_onetime`="' . e($this->getPriceOneTime()) . '", ';
		}
		if (!is_null($this->getPriceFactor())) {
			$sql .= '`attributes_price_factor`="' . e($this->getPriceFactor()) . '", ';
		}
		if (!is_null($this->getPriceFactorOffset())) {
			$sql .= '`attributes_price_factor_offset`="' . e($this->getPriceFactorOffset()) . '", ';
		}
		if (!is_null($this->getPriceFactorOnetime())) {
			$sql .= '`attributes_price_factor_onetime`="' . e($this->getPriceFactorOnetime()) . '", ';
		}
		if (!is_null($this->getPriceFactorOnetimeOffset())) {
			$sql .= '`attributes_price_factor_onetime_offset`="' . e($this->getPriceFactorOnetimeOffset()) . '", ';
		}
		if (!is_null($this->getQtyPrices())) {
			$sql .= '`attributes_qty_prices`="' . e($this->getQtyPrices()) . '", ';
		}
		if (!is_null($this->getQtyPricesOneTime())) {
			$sql .= '`attributes_qty_prices_onetime`="' . e($this->getQtyPricesOneTime()) . '", ';
		}
		if (!is_null($this->getPriceWords())) {
			$sql .= '`attributes_price_words`="' . e($this->getPriceWords()) . '", ';
		}
		if (!is_null($this->getPriceWordsFree())) {
			$sql .= '`attributes_price_words_free`="' . e($this->getPriceWordsFree()) . '", ';
		}
		if (!is_null($this->getPriceLetters())) {
			$sql .= '`attributes_price_letters`="' . e($this->getPriceLetters()) . '", ';
		}
		if (!is_null($this->getPriceLettersFree())) {
			$sql .= '`attributes_price_letters_free`="' . e($this->getPriceLettersFree()) . '", ';
		}
		if (!is_null($this->getRequired())) {
			$sql .= '`attributes_required`="' . e($this->getRequired()) . '", ';
		}
		if (!is_null($this->getInventory())) {
			$sql .= '`attributes_quantity`="' . e($this->getInventory()) . '", ';
		}
		if (!is_null($this->getId())) {
			$sql .= 'products_attributes_id="' . e($this->getId()) . '" where products_attributes_id="' . e($this->getId()) . '"';
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
		$sql = 'delete from cart_products_attributes where products_attributes_id="' . e($this->getId()) . '"';
		Database::singleton()->query($sql);
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/CartProductAttributes') {
		$form = new Form('CartProductAttributes_addedit', 'post', $target);
		
		$form->setConstants( array ( 'section' => 'addedit' ) );
		$form->addElement( 'hidden', 'section' );
		
		if (!is_null($this->getId())) {
			$form->setConstants( array ( 'cartproductattributes_products_attributes_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'cartproductattributes_products_attributes_id' );
			
			$defaultValues ['cartproductattributes_productid'] = $this->getProductid();
			$defaultValues ['cartproductattributes_optionsId'] = $this->getOptionsId()->getId();
			$defaultValues ['cartproductattributes_valuesId'] = $this->getValues()->getId();
			$defaultValues ['cartproductattributes_valuesPrice'] = $this->getValuesPrice();
			$defaultValues ['cartproductattributes_pricePrefix'] = $this->getPricePrefix();
			$defaultValues ['cartproductattributes_sort'] = $this->getSort();
			$defaultValues ['cartproductattributes_isFree'] = $this->getIsFree();
			$defaultValues ['cartproductattributes_weight'] = $this->getWeight();
			$defaultValues ['cartproductattributes_weightPrefix'] = $this->getWeightPrefix();
			$defaultValues ['cartproductattributes_displayOnly'] = $this->getDisplayOnly();
			$defaultValues ['cartproductattributes_default'] = $this->getDefault();
			$defaultValues ['cartproductattributes_discounted'] = $this->getDiscounted();
			$defaultValues ['cartproductattributes_image'] = $this->getImage()->getId();
			$defaultValues ['cartproductattributes_priceBaseIncluded'] = $this->getPriceBaseIncluded();
			$defaultValues ['cartproductattributes_priceOneTime'] = $this->getPriceOneTime();
			$defaultValues ['cartproductattributes_priceFactor'] = $this->getPriceFactor();
			$defaultValues ['cartproductattributes_priceFactorOffset'] = $this->getPriceFactorOffset();
			$defaultValues ['cartproductattributes_priceFactorOnetime'] = $this->getPriceFactorOnetime();
			$defaultValues ['cartproductattributes_priceFactorOnetimeOffset'] = $this->getPriceFactorOnetimeOffset();
			$defaultValues ['cartproductattributes_qtyPrices'] = $this->getQtyPrices();
			$defaultValues ['cartproductattributes_qtyPricesOneTime'] = $this->getQtyPricesOneTime();
			$defaultValues ['cartproductattributes_priceWords'] = $this->getPriceWords();
			$defaultValues ['cartproductattributes_priceWordsFree'] = $this->getPriceWordsFree();
			$defaultValues ['cartproductattributes_priceLetters'] = $this->getPriceLetters();
			$defaultValues ['cartproductattributes_priceLettersFree'] = $this->getPriceLettersFree();
			$defaultValues ['cartproductattributes_required'] = $this->getRequired();
			$defaultValues ['cartproductattributes_quantity'] = $this->getInventory();

			$form->setDefaults( $defaultValues );
		}
					
		$form->addElement('text', 'cartproductattributes_productid', 'productid');
		$form->addElement('text', 'cartproductattributes_optionsId', 'optionsId');
		$form->addElement('text', 'cartproductattributes_valuesId', 'valuesId');
		$form->addElement('text', 'cartproductattributes_valuesPrice', 'valuesPrice');
		$form->addElement('text', 'cartproductattributes_pricePrefix', 'pricePrefix');
		$form->addElement('text', 'cartproductattributes_sort', 'sort');
		$form->addElement('text', 'cartproductattributes_isFree', 'isFree');
		$form->addElement('text', 'cartproductattributes_weight', 'weight');
		$form->addElement('text', 'cartproductattributes_weightPrefix', 'weightPrefix');
		$form->addElement('text', 'cartproductattributes_displayOnly', 'displayOnly');
		$form->addElement('text', 'cartproductattributes_default', 'default');
		$form->addElement('text', 'cartproductattributes_discounted', 'discounted');
		$form->addElement('text', 'cartproductattributes_image', 'image');
		$form->addElement('text', 'cartproductattributes_priceBaseIncluded', 'priceBaseIncluded');
		$form->addElement('text', 'cartproductattributes_priceOneTime', 'priceOneTime');
		$form->addElement('text', 'cartproductattributes_priceFactor', 'priceFactor');
		$form->addElement('text', 'cartproductattributes_priceFactorOffset', 'priceFactorOffset');
		$form->addElement('text', 'cartproductattributes_priceFactorOnetime', 'priceFactorOnetime');
		$form->addElement('text', 'cartproductattributes_priceFactorOnetimeOffset', 'priceFactorOnetimeOffset');
		$form->addElement('text', 'cartproductattributes_qtyPrices', 'qtyPrices');
		$form->addElement('text', 'cartproductattributes_qtyPricesOneTime', 'qtyPricesOneTime');
		$form->addElement('text', 'cartproductattributes_priceWords', 'priceWords');
		$form->addElement('text', 'cartproductattributes_priceWordsFree', 'priceWordsFree');
		$form->addElement('text', 'cartproductattributes_priceLetters', 'priceLetters');
		$form->addElement('text', 'cartproductattributes_priceLettersFree', 'priceLettersFree');
		$form->addElement('text', 'cartproductattributes_required', 'required');
		$form->addElement('submit', 'cartproductattributes_submit', 'Submit');

		if ($form->validate() && $form->isSubmitted()) {
			$this->setProductid($form->exportValue('cartproductattributes_productid'));
			$this->setOptionsId($form->exportValue('cartproductattributes_optionsId'));
			$this->setValue($form->exportValue('cartproductattributes_valuesId'));
			$this->setValuesPrice($form->exportValue('cartproductattributes_valuesPrice'));
			$this->setPricePrefix($form->exportValue('cartproductattributes_pricePrefix'));
			$this->setSort($form->exportValue('cartproductattributes_sort'));
			$this->setIsFree($form->exportValue('cartproductattributes_isFree'));
			$this->setWeight($form->exportValue('cartproductattributes_weight'));
			$this->setWeightPrefix($form->exportValue('cartproductattributes_weightPrefix'));
			$this->setDisplayOnly($form->exportValue('cartproductattributes_displayOnly'));
			$this->setDefault($form->exportValue('cartproductattributes_default'));
			$this->setDiscounted($form->exportValue('cartproductattributes_discounted'));
			$this->setImage($form->exportValue('cartproductattributes_image'));
			$this->setPriceBaseIncluded($form->exportValue('cartproductattributes_priceBaseIncluded'));
			$this->setPriceOneTime($form->exportValue('cartproductattributes_priceOneTime'));
			$this->setPriceFactor($form->exportValue('cartproductattributes_priceFactor'));
			$this->setPriceFactorOffset($form->exportValue('cartproductattributes_priceFactorOffset'));
			$this->setPriceFactorOnetime($form->exportValue('cartproductattributes_priceFactorOnetime'));
			$this->setPriceFactorOnetimeOffset($form->exportValue('cartproductattributes_priceFactorOnetimeOffset'));
			$this->setQtyPrices($form->exportValue('cartproductattributes_qtyPrices'));
			$this->setQtyPricesOneTime($form->exportValue('cartproductattributes_qtyPricesOneTime'));
			$this->setPriceWords($form->exportValue('cartproductattributes_priceWords'));
			$this->setPriceWordsFree($form->exportValue('cartproductattributes_priceWordsFree'));
			$this->setPriceLetters($form->exportValue('cartproductattributes_priceLetters'));
			$this->setPriceLettersFree($form->exportValue('cartproductattributes_priceLettersFree'));
			$this->setRequired($form->exportValue('cartproductattributes_required'));
			$this->save();
		}

		return $form;
		
	}
	
	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllCartProductAttributess() {
		$sql = 'select `products_attributes_id` from cart_products_attributes';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new CartProductAttributes($result['products_attributes_id']);
		}
		
		return $results;
	}
	
}
?>