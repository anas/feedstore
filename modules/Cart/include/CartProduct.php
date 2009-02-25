<?php
require_once('CartCategory.php');

//error_reporting(E_ALL);

/**
 * CartProduct
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
class CartProduct {

	/**
	 * Variable associated with `products_id` column in table.
	 *
	 * @var string
	 */
	protected $id = null;

	/**
	 * Variable associated with `products_type` column in table.
	 *
	 * @var string
	 */
	protected $type = null;

	/**
	 * Variable associated with `products_quantity` column in table.
	 *
	 * @var string
	 */
	protected $quantity = null;
	
	protected $pallet_count = null;

	/**
	 * Variable associated with `products_model` column in table.
	 *
	 * @var string
	 */
	protected $model = null;

	/**
	 * Variable associated with `products_image` column in table.
	 *
	 * @var string
	 */
	protected $image = null;

	/**
	 * Variable associated with `products_price` column in table.
	 *
	 * @var string
	 */
	protected $price = null;

	/**
	 * Variable associated with `products_virtual` column in table.
	 *
	 * @var string
	 */
	protected $virtual = null;

	/**
	 * Variable associated with `products_date_added` column in table.
	 *
	 * @var string
	 */
	protected $date_added = null;

	/**
	 * Variable associated with `products_last_modified` column in table.
	 *
	 * @var string
	 */
	protected $lastModified = null;

	/**
	 * Variable associated with `products_date_available` column in table.
	 *
	 * @var string
	 */
	protected $dateAvailable = null;

	/**
	 * Variable associated with `products_weight` column in table.
	 *
	 * @var string
	 */
	protected $weight = null;
	
	protected $weight_unit = null;

	/**
	 * Variable associated with `products_status` column in table.
	 *
	 * @var string
	 */
	protected $status = null;

	/**
	 * Variable associated with `products_tax_class_id` column in table.
	 *
	 * @var string
	 */
	protected $taxClass = null;

	/**
	 * Variable associated with `manufacturers_id` column in table.
	 *
	 * @var string
	 */
	protected $manufacturer = null;

	/**
	 * Variable associated with `products_ordered` column in table.
	 *
	 * @var string
	 */
	protected $ordered = null;

	/**
	 * Variable associated with `products_quantity_order_min` column in table.
	 *
	 * @var string
	 */
	protected $orderMin = null;

	/**
	 * Variable associated with `products_quantity_order_units` column in table.
	 *
	 * @var string
	 */
	protected $orderUnits = null;

	/**
	 * Variable associated with `products_priced_by_attribute` column in table.
	 *
	 * @var string
	 */
	protected $pricedByAttribute = null;

	/**
	 * Variable associated with `product_is_free` column in table.
	 *
	 * @var string
	 */
	protected $isFree = null;

	/**
	 * Variable associated with `product_is_call` column in table.
	 *
	 * @var string
	 */
	protected $isCall = null;

	/**
	 * Variable associated with `products_quantity_mixed` column in table.
	 *
	 * @var string
	 */
	protected $quantityMixed = null;

	/**
	 * Variable associated with `product_is_always_free_shipping` column in table.
	 *
	 * @var string
	 */
	protected $isAlwaysFreeShipping = null;

	/**
	 * Variable associated with `products_qty_box_status` column in table.
	 *
	 * @var string
	 */
	protected $qtyBoxStatus = null;

	/**
	 * Variable associated with `products_quantity_order_max` column in table.
	 *
	 * @var string
	 */
	protected $qtyOrderMax = null;

	/**
	 * Variable associated with `products_sort_order` column in table.
	 *
	 * @var string
	 */
	protected $sortOrder = null;

	/**
	 * Variable associated with `products_discount_type` column in table.
	 *
	 * @var string
	 */
	protected $discountType = null;

	/**
	 * Variable associated with `products_discount_type_from` column in table.
	 *
	 * @var string
	 */
	protected $discountTypeFrom = null;

	/**
	 * Variable associated with `products_price_sorter` column in table.
	 *
	 * @var string
	 */
	protected $priceSorter = null;

	/**
	 * Variable associated with `master_categories_id` column in table.
	 *
	 * @var string
	 */
	protected $category = null;

	/**
	 * Variable associated with `products_mixed_discount_quantity` column in table.
	 *
	 * @var string
	 */
	protected $mixedDiscountQty = null;

	/**
	 * Variable associated with `metatags_title_status` column in table.
	 *
	 * @var string
	 */
	protected $titleStatus = null;

	/**
	 * Variable associated with `metatags_products_name_status` column in table.
	 *
	 * @var string
	 */
	protected $nameStatus = null;

	/**
	 * Variable associated with `metatags_model_status` column in table.
	 *
	 * @var string
	 */
	protected $modelStatus = null;

	/**
	 * Variable associated with `metatags_price_status` column in table.
	 *
	 * @var string
	 */
	protected $priceStatus = null;

	/**
	 * Variable associated with `metatags_title_tagline_status` column in table.
	 *
	 * @var string
	 */
	protected $taglineStatus = null;

	/**
	 * Variable associated with `language_id` column in table.
	 *
	 * @var string
	 */
	protected $languageId = null;

	/**
	 * Variable associated with `products_name` column in table.
	 *
	 * @var string
	 */
	protected $name = null;

	/**
	 * Variable associated with `products_description` column in table.
	 *
	 * @var string
	 */
	protected $description = null;

	/**
	 * Variable associated with `products_url` column in table.
	 *
	 * @var string
	 */
	protected $url = null;

	/**
	 * Variable associated with `products_viewed` column in table.
	 *
	 * @var string
	 */
	protected $viewed = null;

	protected $attribute_id = null;
	
	protected $accessory_of = null;
	
	/**
	 * Create an instance of the CartProduct class.
	 *
	 * This takes the primary key as a parameter and builds the object around the
	 * returned row. If the parameter is null, not specified or the row does not
	 * exist then a blank template CartProduct object is returned.
	 *
	 * @param int $products_id
	 * @return CartProduct object
	 */
	public function __construct( $products_id = null ) {
		if (!is_null($products_id)) {
			@list($pid, $attid) = @explode(':', $products_id);
			if ($attid) {
				$this->attribute_id = $attid;
			}
			
			$sql = 'select p.*, pd.* from cart_products p LEFT JOIN (cart_products_description pd) ON (p.products_id = pd.products_id) where p.products_id=' . $pid;
			if (!$result = Database::singleton()->query_fetch($sql)) {
				return false;
			}
			
			$this->setId($result['products_id']);
			$this->setType($result['products_type']);
			$this->setQuantity($result['products_quantity']);
			$this->setPalletCount($result['products_pallet_count']);
			//$this->setModel($result['products_model']);
			$this->setImage($result['products_image']);
			$this->setPrice($result['products_price']);
			//$this->setVirtual($result['products_virtual']);
			$this->setDate_added($result['products_date_added']);
			$this->setLastModified($result['products_last_modified']);
			$this->setDateAvailable($result['products_date_available']);
			$this->setWeight($result['products_weight']);
			$this->setWeightUnit($result['products_weight_unit']);
			$this->setStatus($result['products_status']);
			$this->setTaxClass($result['products_tax_class_id']);
			$this->setManufacturer($result['manufacturers_id']);
			$this->setOrdered($result['products_ordered']);
			$this->setOrderMin($result['products_quantity_order_min']);
			$this->setOrderUnits($result['products_quantity_order_units']);
			$this->setPricedByAttribute($result['products_priced_by_attribute']);
			$this->setIsFree($result['product_is_free']);
			$this->setIsCall($result['product_is_call']);
			$this->setQuantityMixed($result['products_quantity_mixed']);
			$this->setIsAlwaysFreeShipping($result['product_is_always_free_shipping']);
			$this->setQtyBoxStatus($result['products_qty_box_status']);
			$this->setQtyOrderMax($result['products_quantity_order_max']);
			$this->setSortOrder($result['products_sort_order']);
			$this->setDiscountType($result['products_discount_type']);
			$this->setDiscountTypeFrom($result['products_discount_type_from']);
			$this->setPriceSorter($result['products_price_sorter']);
			$this->setCategory($result['master_categories_id']);
			$this->setMixedDiscountQty($result['products_mixed_discount_quantity']);
			$this->setTitleStatus($result['metatags_title_status']);
			$this->setNameStatus($result['metatags_products_name_status']);
			$this->setModelStatus($result['metatags_model_status']);
			$this->setPriceStatus($result['metatags_price_status']);
			$this->setTaglineStatus($result['metatags_title_tagline_status']);
				
			$this->setLanguageId($result['language_id']);
			$this->setName($result['products_name']);
			$this->setDescription($result['products_description']);
			//$this->setUrl($result['products_url']);
			$this->setViewed($result['products_viewed']);
			
		}
	}
	
	public function getAltImages() {
		if (!$this->getId())
			return array();
		$sql = 'select * from cart_products_images where product_id=' . e($this->getId());
		$rs = Database::singleton()->query_fetch_all($sql);
		return $rs;
	}
	
	public function getAttributes() {
		$sql = 'select products_attributes_id, options_id from cart_products_attributes where products_id=' . e($this->getId()) . ' order by options_id asc, products_options_sort_order asc';
		$r = Database::singleton()->query_fetch_all($sql);
		
		$array = array();
		foreach ($r as &$a) {
			$cur =& $array[$a['options_id']][];
			$cur = new CartProductAttribute($a['products_attributes_id']);
			$a = new CartProductAttribute($a['products_attributes_id']);
		}
		return $array;
	}
	
	public function getOptions() {
		if (!$this->getId())
			return array();
		$sql = 'select products_attributes_id, options_id from cart_products_attributes where products_id=' . e($this->getId()) . ' order by options_id asc, products_options_sort_order asc';
		$r = Database::singleton()->query_fetch_all($sql);
		foreach ($r as &$a) {
			$a = new CartProductAttribute($a['products_attributes_id']);
		}
		return $r;
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
	 * Returns the object's Type
	 *
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Returns the object's Quantity
	 *
	 * @return string
	 */
	public function getQuantity() {
		return $this->quantity;
	}

	public function getPalletCount(){
		return $this->pallet_count;
	}
	
	/**
	 * Returns the object's Model
	 *
	 * @return string
	 */
	public function getModel() {
		return $this->model;
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
	 * Returns the object's Price
	 *
	 * @return string
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * Returns the object's Virtual
	 *
	 * @return string
	 */
	public function getVirtual() {
		return $this->virtual;
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
	 * Returns the object's LastModified
	 *
	 * @return string
	 */
	public function getLastModified() {
		return $this->lastModified;
	}

	/**
	 * Returns the object's DateAvailable
	 *
	 * @return string
	 */
	public function getDateAvailable() {
		return $this->dateAvailable;
	}

	/**
	 * Returns the object's Weight
	 *
	 * @return string
	 */
	public function getWeight() {
		return $this->weight;
	}

	public function getWeightUnit() {
		return $this->weight_unit;
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
	 * Returns the object's TaxClass
	 *
	 * @return string
	 */
	public function getTaxClass() {
		return $this->taxClass;
	}

	/**
	 * Returns the object's Manufacturer
	 *
	 * @return string
	 */
	public function getManufacturer() {
		return $this->manufacturer;
	}

	/**
	 * Returns the object's Ordered
	 *
	 * @return string
	 */
	public function getOrdered() {
		return $this->ordered;
	}

	/**
	 * Returns the object's OrderMin
	 *
	 * @return string
	 */
	public function getOrderMin() {
		return $this->orderMin;
	}

	/**
	 * Returns the object's OrderUnits
	 *
	 * @return string
	 */
	public function getOrderUnits() {
		return $this->orderUnits;
	}

	/**
	 * Returns the object's PricedByAttribute
	 *
	 * @return string
	 */
	public function getPricedByAttribute() {
		return $this->pricedByAttribute;
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
	 * Returns the object's IsCall
	 *
	 * @return string
	 */
	public function getIsCall() {
		return $this->isCall;
	}

	/**
	 * Returns the object's QuantityMixed
	 *
	 * @return string
	 */
	public function getQuantityMixed() {
		return $this->quantityMixed;
	}

	/**
	 * Returns the object's IsAlwaysFreeShipping
	 *
	 * @return string
	 */
	public function getIsAlwaysFreeShipping() {
		return $this->isAlwaysFreeShipping;
	}

	/**
	 * Returns the object's QtyBoxStatus
	 *
	 * @return string
	 */
	public function getQtyBoxStatus() {
		return $this->qtyBoxStatus;
	}

	/**
	 * Returns the object's QtyOrderMax
	 *
	 * @return string
	 */
	public function getQtyOrderMax() {
		return $this->qtyOrderMax;
	}

	/**
	 * Returns the object's SortOrder
	 *
	 * @return string
	 */
	public function getSortOrder() {
		return $this->sortOrder;
	}

	/**
	 * Returns the object's DiscountType
	 *
	 * @return string
	 */
	public function getDiscountType() {
		return $this->discountType;
	}

	/**
	 * Returns the object's DiscountTypeFrom
	 *
	 * @return string
	 */
	public function getDiscountTypeFrom() {
		return $this->discountTypeFrom;
	}

	/**
	 * Returns the object's PriceSorter
	 *
	 * @return string
	 */
	public function getPriceSorter() {
		return $this->priceSorter;
	}

	/**
	 * Returns the object's Category
	 *
	 * @return string
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * Returns the object's MixedDiscountQty
	 *
	 * @return string
	 */
	public function getMixedDiscountQty() {
		return $this->mixedDiscountQty;
	}

	/**
	 * Returns the object's TitleStatus
	 *
	 * @return string
	 */
	public function getTitleStatus() {
		return $this->titleStatus;
	}

	/**
	 * Returns the object's NameStatus
	 *
	 * @return string
	 */
	public function getNameStatus() {
		return $this->nameStatus;
	}

	/**
	 * Returns the object's ModelStatus
	 *
	 * @return string
	 */
	public function getModelStatus() {
		return $this->modelStatus;
	}

	/**
	 * Returns the object's PriceStatus
	 *
	 * @return string
	 */
	public function getPriceStatus() {
		return $this->priceStatus;
	}

	/**
	 * Returns the object's TaglineStatus
	 *
	 * @return string
	 */
	public function getTaglineStatus() {
		return $this->taglineStatus;
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
	 * Returns the object's Description
	 *
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Returns the object's Url
	 *
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * Returns the object's Viewed
	 *
	 * @return string
	 */
	public function getViewed() {
		return $this->viewed;
	}
	
	public function getAttId() {
		if (!is_null($this->attribute_id)) {
			return $this->attribute_id;
		}
		return false;
	}

	/*public function getAccessories() {
		$sql = 'select acc_product from cart_accessories where `parent_product`=' . $this->getId();
		$rs = Database::singleton()->query_fetch_all($sql);
		
		foreach ($rs as &$r) {
			$r = new CartProduct($r['acc_product']);
		}
		return $rs;
	}*/
	
	/*public function getAccessoryOf() {
		//First, make sure that we are editing an existing product, NOT adding a new product
		//If we are adding a new product, it means that this product is not an accessory yet.
		if (!$this->getId())
			return array();
		if (is_null($this->accessory_of)) {
			$sql = 'select parent_product from cart_accessories where acc_product=' . $this->getId();
			$r = Database::singleton()->query_fetch_all($sql);
		
			foreach ($r as &$p) {
				$p = new CartProduct($p['parent_product']);
			}
			$this->accessory_of = $r;
		}
		
		return $this->accessory_of;
	}*/
	
	/**
	 * Sets the object's Id
	 *
	 * @param string $id New $this->id value
	 */
	public function setId( $id ) {
		$this->id = $id;
	}

	/**
	 * Sets the object's Type
	 *
	 * @param string $type New $this->type value
	 */
	public function setType( $type ) {
		$this->type = new CartProductType($type);
	}

	/**
	 * Sets the object's Quantity
	 *
	 * @param string $quantity New $this->quantity value
	 */
	public function setQuantity( $quantity ) {
		$this->quantity = $quantity;
	}
	
	public function setPalletCount($pallet_count){
		$this->pallet_count = $pallet_count;
	}

	/**
	 * Sets the object's Model
	 *
	 * @param string $model New $this->model value
	 */
	public function setModel( $model ) {
		$this->model = $model;
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
	 * Sets the object's Price
	 *
	 * @param string $price New $this->price value
	 */
	public function setPrice( $price ) {
		$this->price = $price;
	}

	/**
	 * Sets the object's Virtual
	 *
	 * @param string $virtual New $this->virtual value
	 */
	public function setVirtual( $virtual ) {
		$this->virtual = $virtual;
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
	 * Sets the object's LastModified
	 *
	 * @param string $lastModified New $this->lastModified value
	 */
	public function setLastModified( $lastModified ) {
		$this->lastModified = $lastModified;
	}

	/**
	 * Sets the object's DateAvailable
	 *
	 * @param string $dateAvailable New $this->dateAvailable value
	 */
	public function setDateAvailable( $dateAvailable ) {
		$this->dateAvailable = $dateAvailable;
	}

	/**
	 * Sets the object's Weight
	 *
	 * @param string $weight New $this->weight value
	 */
	public function setWeight( $weight ) {
		$this->weight = $weight;
	}

	public function setWeightUnit( $weight_unit ) {
		$this->weight_unit = $weight_unit;
	}
	
	/**
	 * Sets the object's Status
	 *
	 * @param string $status New $this->status value
	 */
	public function setStatus( $status ) {
		$this->status = $status;
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
	 * Sets the object's Manufacturer
	 *
	 * @param string $manufacturer New $this->manufacturer value
	 */
	public function setManufacturer( $manufacturer ) {
		$this->manufacturer = new CartManufacturer($manufacturer);
	}

	/**
	 * Sets the object's Ordered
	 *
	 * @param string $ordered New $this->ordered value
	 */
	public function setOrdered( $ordered ) {
		$this->ordered = $ordered;
	}

	/**
	 * Sets the object's OrderMin
	 *
	 * @param string $orderMin New $this->orderMin value
	 */
	public function setOrderMin( $orderMin ) {
		$this->orderMin = $orderMin;
	}

	/**
	 * Sets the object's OrderUnits
	 *
	 * @param string $orderUnits New $this->orderUnits value
	 */
	public function setOrderUnits( $orderUnits ) {
		$this->orderUnits = $orderUnits;
	}

	/**
	 * Sets the object's PricedByAttribute
	 *
	 * @param string $pricedByAttribute New $this->pricedByAttribute value
	 */
	public function setPricedByAttribute( $pricedByAttribute ) {
		$this->pricedByAttribute = $pricedByAttribute;
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
	 * Sets the object's IsCall
	 *
	 * @param string $isCall New $this->isCall value
	 */
	public function setIsCall( $isCall ) {
		$this->isCall = $isCall;
	}

	/**
	 * Sets the object's QuantityMixed
	 *
	 * @param string $quantityMixed New $this->quantityMixed value
	 */
	public function setQuantityMixed( $quantityMixed ) {
		$this->quantityMixed = $quantityMixed;
	}

	/**
	 * Sets the object's IsAlwaysFreeShipping
	 *
	 * @param string $isAlwaysFreeShipping New $this->isAlwaysFreeShipping value
	 */
	public function setIsAlwaysFreeShipping( $isAlwaysFreeShipping ) {
		$this->isAlwaysFreeShipping = $isAlwaysFreeShipping;
	}

	/**
	 * Sets the object's QtyBoxStatus
	 *
	 * @param string $qtyBoxStatus New $this->qtyBoxStatus value
	 */
	public function setQtyBoxStatus( $qtyBoxStatus ) {
		$this->qtyBoxStatus = $qtyBoxStatus;
	}

	/**
	 * Sets the object's QtyOrderMax
	 *
	 * @param string $qtyOrderMax New $this->qtyOrderMax value
	 */
	public function setQtyOrderMax( $qtyOrderMax ) {
		$this->qtyOrderMax = $qtyOrderMax;
	}

	/**
	 * Sets the object's SortOrder
	 *
	 * @param string $sortOrder New $this->sortOrder value
	 */
	public function setSortOrder( $sortOrder ) {
		$this->sortOrder = $sortOrder;
	}

	/**
	 * Sets the object's DiscountType
	 *
	 * @param string $discountType New $this->discountType value
	 */
	public function setDiscountType( $discountType ) {
		$this->discountType = $discountType;
	}

	/**
	 * Sets the object's DiscountTypeFrom
	 *
	 * @param string $discountTypeFrom New $this->discountTypeFrom value
	 */
	public function setDiscountTypeFrom( $discountTypeFrom ) {
		$this->discountTypeFrom = $discountTypeFrom;
	}

	/**
	 * Sets the object's PriceSorter
	 *
	 * @param string $priceSorter New $this->priceSorter value
	 */
	public function setPriceSorter( $priceSorter ) {
		$this->priceSorter = $priceSorter;
	}

	/**
	 * Sets the object's Category
	 *
	 * @param string $category New $this->category value
	 */
	public function setCategory( $category ) {
		$this->category = new CartCategory($category);
	}

	/**
	 * Sets the object's MixedDiscountQty
	 *
	 * @param string $mixedDiscountQty New $this->mixedDiscountQty value
	 */
	public function setMixedDiscountQty( $mixedDiscountQty ) {
		$this->mixedDiscountQty = $mixedDiscountQty;
	}

	/**
	 * Sets the object's TitleStatus
	 *
	 * @param string $titleStatus New $this->titleStatus value
	 */
	public function setTitleStatus( $titleStatus ) {
		$this->titleStatus = $titleStatus;
	}

	/**
	 * Sets the object's NameStatus
	 *
	 * @param string $nameStatus New $this->nameStatus value
	 */
	public function setNameStatus( $nameStatus ) {
		$this->nameStatus = $nameStatus;
	}

	/**
	 * Sets the object's ModelStatus
	 *
	 * @param string $modelStatus New $this->modelStatus value
	 */
	public function setModelStatus( $modelStatus ) {
		$this->modelStatus = $modelStatus;
	}

	/**
	 * Sets the object's PriceStatus
	 *
	 * @param string $priceStatus New $this->priceStatus value
	 */
	public function setPriceStatus( $priceStatus ) {
		$this->priceStatus = $priceStatus;
	}

	/**
	 * Sets the object's TaglineStatus
	 *
	 * @param string $taglineStatus New $this->taglineStatus value
	 */
	public function setTaglineStatus( $taglineStatus ) {
		$this->taglineStatus = $taglineStatus;
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
	 * Sets the object's Description
	 *
	 * @param string $description New $this->description value
	 */
	public function setDescription( $description ) {
		$this->description = $description;
	}

	/**
	 * Sets the object's Url
	 *
	 * @param string $url New $this->url value
	 */
	public function setUrl( $url ) {
		$this->url = $url;
	}

	/**
	 * Sets the object's Viewed
	 *
	 * @param string $viewed New $this->viewed value
	 */
	public function setViewed( $viewed ) {
		$this->viewed = $viewed;
	}

	/*public function setAccessoryOf( $p_id ) {
		if ($p_id != 0 && $p_id[0] != 0) {
			$this->accessory_of = array();
			foreach ($p_id as $p) {
				$this->accessory_of[] = new CartProduct($p);
			}
		} else {
			$this->accessory_of = null;
		}
	}
	*/
	public function getSpecials() {
		require_once('CartSpecial.php');
		$sql = 'select specials_id from cart_specials where products_id=' . e($this->getId());
		if (!is_null($r = @Database::singleton()->query_fetch($sql)) && ($r)) {
			return new CartSpecial($r['specials_id']);
		}
		return false;
	}
	
	public function getFinalPrice() {
		$special = $this->getSpecials();
		if (!is_null($special) && ($special != false)) {
			return $special->getNew_products_price();
		}
		return $this->getPrice();
	}
	
	public function getOptimizationTips() {
		$warnings = array();
		if (is_null($this->getImage()->getId())) {
			$warnings[] = 'No Product Image';
		}
		
		if (count($warnings) > 0) {
			return $warnings;
		}
		return false;
	}

	/**
	 * Save the object in the database
	 */
	public function save() {
		if (!is_null($this->getId())) {
			$sql = 'update cart_products set ';
		} else {
			$sql = 'insert into cart_products set ';
		}
		if (!is_null($this->getType())) {
			$sql .= '`products_type`="' . e($this->getType()->getId()) . '", ';
		}
		if (!is_null($this->getQuantity())) {
			$sql .= '`products_quantity`="' . e($this->getQuantity()) . '", ';
		}
		if (!is_null($this->getPalletCount())){
			$sql .= '`products_pallet_count`="' . e($this->getPalletCount()) . '", ';
		}
		/*
		if (!is_null($this->getModel())) {
			$sql .= '`products_model`="' . e($this->getModel()) . '", ';
		}
		*/
		if (!is_null($this->getImage()) && !is_null($this->getImage()->getId())) {
			$sql .= '`products_image`="' . e($this->getImage()->getId()) . '", ';
		}
		if (!is_null($this->getPrice())) {
			$sql .= '`products_price`="' . e($this->getPrice()) . '", ';
		}
		/*
		if (!is_null($this->getVirtual())) {
			$sql .= '`products_virtual`="' . e($this->getVirtual()) . '", ';
		}
		*/
		if (!is_null($this->getDate_added())) {
			$sql .= '`products_date_added`="' . e($this->getDate_added()) . '", ';
		}
		if (!is_null($this->getLastModified())) {
			$sql .= '`products_last_modified`="' . e($this->getLastModified()) . '", ';
		}
		if (!is_null($this->getDateAvailable())) {
			$sql .= '`products_date_available`="' . e($this->getDateAvailable()) . '", ';
		}
		if (!is_null($this->getWeight())) {
			$sql .= '`products_weight`="' . e($this->getWeight()) . '", ';
		}
		if (!is_null($this->getWeightUnit())) {
			$sql .= '`products_weight_unit`="' . e($this->getWeightUnit()) . '", ';
		}
		if (!is_null($this->getStatus())) {
			$sql .= '`products_status`="' . e($this->getStatus()) . '", ';
		}
		if (!is_null($this->getTaxClass())) {
			$sql .= '`products_tax_class_id`="' . e($this->getTaxClass()->getId()) . '", ';
		}
		if (!is_null($this->getManufacturer())) {
			$sql .= '`manufacturers_id`="' . e($this->getManufacturer()->getId()) . '", ';
		}
		if (!is_null($this->getOrdered())) {
			$sql .= '`products_ordered`="' . e($this->getOrdered()) . '", ';
		}
		if (!is_null($this->getOrderMin())) {
			$sql .= '`products_quantity_order_min`="' . e($this->getOrderMin()) . '", ';
		}
		if (!is_null($this->getOrderUnits())) {
			$sql .= '`products_quantity_order_units`="' . e($this->getOrderUnits()) . '", ';
		}
		if (!is_null($this->getPricedByAttribute())) {
			$sql .= '`products_priced_by_attribute`="' . e($this->getPricedByAttribute()) . '", ';
		}
		if (!is_null($this->getIsFree())) {
			$sql .= '`product_is_free`="' . e($this->getIsFree()) . '", ';
		}
		if (!is_null($this->getIsCall())) {
			$sql .= '`product_is_call`="' . e($this->getIsCall()) . '", ';
		}
		if (!is_null($this->getQuantityMixed())) {
			$sql .= '`products_quantity_mixed`="' . e($this->getQuantityMixed()) . '", ';
		}
		if (!is_null($this->getIsAlwaysFreeShipping())) {
			$sql .= '`product_is_always_free_shipping`="' . e($this->getIsAlwaysFreeShipping()) . '", ';
		}
		if (!is_null($this->getQtyBoxStatus())) {
			$sql .= '`products_qty_box_status`="' . e($this->getQtyBoxStatus()) . '", ';
		}
		if (!is_null($this->getQtyOrderMax())) {
			$sql .= '`products_quantity_order_max`="' . e($this->getQtyOrderMax()) . '", ';
		}
		if (!is_null($this->getSortOrder())) {
			$sql .= '`products_sort_order`="' . e($this->getSortOrder()) . '", ';
		}
		if (!is_null($this->getDiscountType())) {
			$sql .= '`products_discount_type`="' . e($this->getDiscountType()) . '", ';
		}
		if (!is_null($this->getDiscountTypeFrom())) {
			$sql .= '`products_discount_type_from`="' . e($this->getDiscountTypeFrom()) . '", ';
		}
		if (!is_null($this->getPriceSorter())) {
			$sql .= '`products_price_sorter`="' . e($this->getPriceSorter()) . '", ';
		}
		if (!is_null($this->getCategory())) {
			$sql .= '`master_categories_id`="' . e($this->getCategory()->getId()) . '", ';
		}
		if (!is_null($this->getMixedDiscountQty())) {
			$sql .= '`products_mixed_discount_quantity`="' . e($this->getMixedDiscountQty()) . '", ';
		}
		if (!is_null($this->getTitleStatus())) {
			$sql .= '`metatags_title_status`="' . e($this->getTitleStatus()) . '", ';
		}
		if (!is_null($this->getNameStatus())) {
			$sql .= '`metatags_products_name_status`="' . e($this->getNameStatus()) . '", ';
		}
		if (!is_null($this->getModelStatus())) {
			$sql .= '`metatags_model_status`="' . e($this->getModelStatus()) . '", ';
		}
		if (!is_null($this->getPriceStatus())) {
			$sql .= '`metatags_price_status`="' . e($this->getPriceStatus()) . '", ';
		}
		if (!is_null($this->getTaglineStatus())) {
			$sql .= '`metatags_title_tagline_status`="' . e($this->getTaglineStatus()) . '", ';
		}
		if (!is_null($this->getId())) {
			$sql .= 'products_id="' . e($this->getId()) . '" where products_id="' . e($this->getId()) . '"';
		} else {
			$sql = trim($sql, ', ');
		}
		Database::singleton()->query($sql);
		$id = Database::singleton()->lastInsertedID();
		
		if (!is_null($this->getId())) {
			$sql = 'update cart_products_description set ';
		} else {
			$sql = 'insert into cart_products_description set ';
		}
		if (!is_null($this->getId())) {
			$sql .= '`products_id`="' . e($this->getId()) . '", ';
		}
		if (!is_null($this->getName())) {
			$sql .= '`products_name`="' . e($this->getName()) . '", ';
		}
		if (!is_null($this->getDescription())) {
			$sql .= '`products_description`="' . e($this->getDescription()) . '", ';
		}
		/*
		if (!is_null($this->getUrl())) {
			$sql .= '`products_url`="' . e($this->getUrl()) . '", ';
		}
		*/
		if (!is_null($this->getViewed())) {
			$sql .= '`products_viewed`="' . e($this->getViewed()) . '", ';
		}
		if (!is_null($this->getLanguageId())) {
			$sql .= 'language_id="' . e($this->getLanguageId()) . '" where products_id="' . e($this->getId()) . '"';
		} else {
			$sql = trim($sql, ', ');
		}
		Database::singleton()->query($sql);
		
		if (is_null($this->getId())) {
			$this->setId($id);
			self::__construct($this->getId());
		}
		
		$sql = 'replace into cart_products_to_categories set products_id=' . e($this->getId()) . ', categories_id=' . e($this->getCategory()->getId());
		Database::singleton()->query($sql);
		
		/*
		$sql = 'delete from cart_accessories where acc_product=' . e($this->getId());
		Database::singleton()->query($sql);
		
		$sql = 'delete from cart_accessories where acc_product="' . e($this->getId()) . '"';
		Database::singleton()->query($sql);
		if ($this->getAccessoryOf() != null) {
			foreach ($this->getAccessoryOf() as $p) {
				$sql = 'insert into cart_accessories set acc_product=' . e($this->getId()) . ', parent_product=' . e($p->getId());
				Database::singleton()->query($sql);
			}
		}
		*/
	}

	/**
	 * Delete the object from the database
	 */
	public function delete() {
		$sql = 'delete from cart_products where products_id="' . e($this->getId()) . '"';
		Database::singleton()->query($sql);
		
		$sql = 'delete from cart_products_description where products_id="' . e($this->getId()) . '"';
		Database::singleton()->query($sql);
		
		$sql = 'delete from cart_products_to_categories where products_id="' . e($this->getId()) . '"';
		Database::singleton()->query($sql);
	}

	/**
	 * Get an Add/Edit form for the object.
	 *
	 * @param string $target Post target for form submission
	 */
	public function getAddEditForm($target = '/admin/Cart') {
		$form = new Form('CartProduct_addedit', 'post', $target, '', array('class'=>'admin'));

		$form->setConstants( array ( 'section' => 'products' ) );
		$form->addElement( 'hidden', 'section' );
		
		$form->setConstants( array ( 'action' => 'addedit' ) );
		$form->addElement( 'hidden', 'action' );
		
		if (!is_null($this->getId())) {
			$form->setConstants( array ( 'cartproduct_products_id' => $this->getId() ) );
			$form->addElement( 'hidden', 'cartproduct_products_id' );
				
			$defaultValues ['cartproduct_type'] = $this->getType()->getId();
			$defaultValues ['cartproduct_quantity'] = $this->getQuantity();
			$defaultValues ['cartproduct_pallet_count'] = $this->getPalletCount();
			//$defaultValues ['cartproduct_model'] = $this->getModel();
			$defaultValues ['cartproduct_image'] = $this->getImage()->getId();
			$defaultValues ['cartproduct_price'] = $this->getPrice();
			//$defaultValues ['cartproduct_virtual'] = $this->getVirtual();
			$defaultValues ['cartproduct_date_added'] = $this->getDate_added();
			$defaultValues ['cartproduct_lastModified'] = $this->getLastModified();
			$defaultValues ['cartproduct_dateAvailable'] = $this->getDateAvailable();
			$defaultValues ['cartproduct_weight'] = $this->getWeight();
			$defaultValues ['cartproduct_weight_unit'] = $this->getWeightUnit();
			$defaultValues ['cartproduct_status'] = $this->getStatus();
			$defaultValues ['cartproduct_taxClass'] = $this->getTaxClass()->getId();
			$defaultValues ['cartproduct_manufacturer'] = $this->getManufacturer()->getId();
			$defaultValues ['cartproduct_ordered'] = $this->getOrdered();
			$defaultValues ['cartproduct_orderMin'] = $this->getOrderMin();
			$defaultValues ['cartproduct_orderUnits'] = $this->getOrderUnits();
			$defaultValues ['cartproduct_pricedByAttribute'] = $this->getPricedByAttribute();
			$defaultValues ['cartproduct_isFree'] = $this->getIsFree();
			$defaultValues ['cartproduct_isCall'] = $this->getIsCall();
			$defaultValues ['cartproduct_quantityMixed'] = $this->getQuantityMixed();
			$defaultValues ['cartproduct_isAlwaysFreeShipping'] = $this->getIsAlwaysFreeShipping();
			$defaultValues ['cartproduct_qtyBoxStatus'] = $this->getQtyBoxStatus();
			$defaultValues ['cartproduct_qtyOrderMax'] = $this->getQtyOrderMax();
			$defaultValues ['cartproduct_sortOrder'] = $this->getSortOrder();
			$defaultValues ['cartproduct_discountType'] = $this->getDiscountType();
			$defaultValues ['cartproduct_discountTypeFrom'] = $this->getDiscountTypeFrom();
			$defaultValues ['cartproduct_priceSorter'] = $this->getPriceSorter();
			$defaultValues ['cartproduct_category'] = $this->getCategory()->getId();
			$defaultValues ['cartproduct_mixedDiscountQty'] = $this->getMixedDiscountQty();
			$defaultValues ['cartproduct_titleStatus'] = $this->getTitleStatus();
			$defaultValues ['cartproduct_nameStatus'] = $this->getNameStatus();
			$defaultValues ['cartproduct_modelStatus'] = $this->getModelStatus();
			$defaultValues ['cartproduct_priceStatus'] = $this->getPriceStatus();
			$defaultValues ['cartproduct_taglineStatus'] = $this->getTaglineStatus();
			$defaultValues ['cartproduct_name'] = $this->getName();
			$defaultValues ['cartproduct_description'] = $this->getDescription();
			//$defaultValues ['cartproduct_url'] = $this->getUrl();
			//$defaultValues ['cartproduct_accessoryof'] = $this->getAccessoryOf()->getId();
		} else {
			/*******************************************************/
			//The following few lines assign the default values to the elements.
			//It is very important especially for adjusting the layout 
			$defaultValues ['cartproduct_date_added'] = "&nbsp;";
			$defaultValues ['cartproduct_lastModified'] = "&nbsp;";
			//$defaultValues ['cartproduct_virtual'] = 0;
			/*******************************************************/
		}
		$form->setDefaults( $defaultValues );

		$form->addElement('header','product_details','Product Details');
		
		$form->addElement('text', 'cartproduct_name', 'Name');
		$desc = $form->addElement('tinymce', 'cartproduct_description', 'Description');
		
		//$form->addElement('text', 'cartproduct_url', 'Link URL');
		
		
		/*
		$products = CartProduct::toArray();
		$products[0] = "Not an Accessory";
		$acc = $form->addElement('select', 'cartproduct_accessoryof', 'Accessory Of', $products);
		$acc->setMultiple(true);
		
		$accs = array();

		foreach ($this->getAccessoryOf() as $p) {
			$accs[] = $p->getId();
		}
		
		$acc->setSelected($accs);
		*/
		$form->addElement('select', 'cartproduct_manufacturer', 'Supplier', CartManufacturer::toArray());
		
		$form->addElement('select', 'cartproduct_category', 'Category', CartCategory::toArray());
		require_once('CartProductType.php');
		$form->addElement('select', 'cartproduct_type', 'Product Type', @CartProductType::toArray());
		
		$form->addElement('text', 'cartproduct_quantity', 'Stock Qty');
		$form->addElement('text', 'cartproduct_pallet_count', 'Pallet Count');
		//$form->addElement('text', 'cartproduct_model', 'Model #');
		
		$newImage = $form->addElement('file', 'cartproduct_image_upload', 'Product Image');
		
		if ($this->getImage()) {
			$curImage = $form->addElement('dbimage', 'cartproduct_image', $this->getImage()->getId());
		}
		
		$form->addElement('text', 'cartproduct_price', 'Price ($)');
		//$form->addElement('select', 'cartproduct_virtual', 'Virtual Product', Form::booleanArray());
		$form->addElement('static', 'cartproduct_date_added', 'Date Added');
		$form->addElement('static', 'cartproduct_lastModified', 'Last Modified');
		$form->addElement('text', 'cartproduct_dateAvailable', 'Date Availible');
		$form->addElement('text', 'cartproduct_weight', 'Weight per bag');
		$form->addElement('select', 'cartproduct_weight_unit', 'Weight Unit',CartProduct::getAvailableWeightUnits());
		
		$form->addElement('select', 'cartproduct_taxClass', 'Tax Class', CartTaxClass::toArray());
		
		//$form->addElement('text', 'cartproduct_ordered', 'ordered');
		$form->addElement('text', 'cartproduct_orderMin', 'Minimum Order Quantity');
		$form->addElement('select', 'cartproduct_status', 'Status', Form::statusArray());
		
		$form->addElement('header', 'alt_images', 'Alternate Product Images');
		foreach ($this->getAltImages() as $image) {
			$form->addElement('html', '
				<div style="float: right;" id="delete_altimage_div_' . $image['id'] . '">
					<input type="image" src="/images/admin/cross.gif" name="delete_altimage" onclick="return !deleteAltImage(' . $image['id'] . ');" />
				</div>
			');
			$form->addElement('dbimage', 'cartproduct_altimage_' . $image['id'], $image['image_id']);
		}
		$newAltImage = $form->addElement('file', 'cartproduct_altimage_upload', 'New Alternate Product Image');
		
		$options = $this->getOptions();
		foreach ($options as $option) {
			$form->addElement('header','product_options_' . $option->getId(),'Product Options: ' . $option->getOptionsId()->getName());
			$form->addElement('static', 'value_' . $option->getId(), $option->getOptionsId()->getName(), $option->getValue()->getName());
			$form->addElement('text', 'attprice[' . $option->getId() . ']', 'Additional Price');
			$form->addElement('text', 'inventory[' . $option->getId() . ']', 'Inventory');
			$form->addElement('html', '
				<div style="float: right;">
					<input type="image" src="/images/admin/cross.gif" name="delete_att" onclick="return !deleteAtt(' . $option->getId() . ');" />
				</div>
			');
			$defaultValues ['attprice[' . $option->getId() . ']'] = $option->getValuesPrice();
			$defaultValues ['inventory[' . $option->getId() . ']'] = $option->getInventory();
		}
		
		$form->addElement('header','new_product_options','New Product Option');
		$form->addElement('select', 'newoption', 'Option', CartProductOption::toArray(), array('onclick' => 'getValues(this);'));
		$form->addElement('select', 'newvalue', 'Value', array());
		$form->addElement('text', 'newattprice', 'Additional Price');
		$form->addElement('text', 'newinventory', 'Inventory');
		
		$form->setDefaults( $defaultValues );
		
		if (isset($_REQUEST['cartproduct_submit']) && $form->validate() && $form->isSubmitted()) {
			$this->setName($form->exportValue('cartproduct_name'));
			$this->setDescription($form->exportValue('cartproduct_description'));
			//$this->setUrl($form->exportValue('cartproduct_url'));
			$this->setType($form->exportValue('cartproduct_type'));
			$this->setQuantity($form->exportValue('cartproduct_quantity'));
			$this->setPalletCount($form->exportValue('cartproduct_pallet_count'));
			//$this->setModel($form->exportValue('cartproduct_model'));
			$this->setImage($form->exportValue('cartproduct_image_upload'));
			$this->setPrice($form->exportValue('cartproduct_price'));
			//$this->setVirtual($form->exportValue('cartproduct_virtual'));
			$this->setDate_added($form->exportValue('cartproduct_date_added'));
			$this->setLastModified(date('Y-m-d H:i:s'));
			$this->setDateAvailable($form->exportValue('cartproduct_dateAvailable'));
			$this->setWeight($form->exportValue('cartproduct_weight'));
			$this->setWeightUnit($form->exportValue('cartproduct_weight_unit'));
			$this->setStatus($form->exportValue('cartproduct_status'));
			$this->setTaxClass($form->exportValue('cartproduct_taxClass'));
			$this->setManufacturer($form->exportValue('cartproduct_manufacturer'));
			
			//$this->setAccessoryOf($form->exportValue('cartproduct_accessoryof'));
			//$this->setOrdered($form->exportValue('cartproduct_ordered'));
			
			if ($form->exportValue('cartproduct_orderMin') <= 0) {
				$this->setOrderMin(1);
			} else {
				$this->setOrderMin($form->exportValue('cartproduct_orderMin'));
			}
			
			$this->setCategory($form->exportValue('cartproduct_category'));
			
			/*
			$this->setOrderUnits($form->exportValue('cartproduct_orderUnits'));
			$this->setPricedByAttribute($form->exportValue('cartproduct_pricedByAttribute'));
			$this->setIsFree($form->exportValue('cartproduct_isFree'));
			$this->setIsCall($form->exportValue('cartproduct_isCall'));
			$this->setQuantityMixed($form->exportValue('cartproduct_quantityMixed'));
			$this->setIsAlwaysFreeShipping($form->exportValue('cartproduct_isAlwaysFreeShipping'));
			$this->setQtyBoxStatus($form->exportValue('cartproduct_qtyBoxStatus'));
			$this->setQtyOrderMax($form->exportValue('cartproduct_qtyOrderMax'));
			$this->setSortOrder($form->exportValue('cartproduct_sortOrder'));
			$this->setDiscountType($form->exportValue('cartproduct_discountType'));
			$this->setDiscountTypeFrom($form->exportValue('cartproduct_discountTypeFrom'));
			$this->setPriceSorter($form->exportValue('cartproduct_priceSorter'));
			$this->setMixedDiscountQty($form->exportValue('cartproduct_mixedDiscountQty'));
			$this->setTitleStatus($form->exportValue('cartproduct_titleStatus'));
			$this->setNameStatus($form->exportValue('cartproduct_nameStatus'));
			$this->setModelStatus($form->exportValue('cartproduct_modelStatus'));
			$this->setPriceStatus($form->exportValue('cartproduct_priceStatus'));
			$this->setTaglineStatus($form->exportValue('cartproduct_taglineStatus'));
			*/
			
			if ($newImage->isUploadedFile()) {
				$im = new Image();
				$id = $im->insert($newImage->getValue());
				$this->setImage($id);
				
				//$curImage->setSource($this->getImage()->getId()); 
			}
			
			$this->save();
			
			if ($newAltImage->isUploadedFile()) {
				$im = new Image();
				$id = $im->insert($newAltImage->getValue());
				
				$sql = 'insert into cart_products_images set product_id=' . $this->getId() . ', image_id=' . $id;
				Database::singleton()->query($sql);
			}

			if (is_array(@$_REQUEST['attprice'])){
				foreach (@$_REQUEST['attprice'] as $key => $value) {
					$att = new CartProductAttribute($key);
					$att->setValuesPrice($value);
					$att->setInventory($_REQUEST['inventory'][$key]);
					$att->save();
				}
			}
			
			if (isset($_REQUEST['newvalue']) && isset($_REQUEST['newoption']) && isset($_REQUEST['newattprice'])) {
				$a = new CartProductAttribute();
				$a->setProductid($this->getId());
				$a->setOptionsId($_REQUEST['newoption']);
				$a->setValue($_REQUEST['newvalue']);
				$a->setValuesPrice($_REQUEST['newattprice']);
				$a->setInventory($_REQUEST['newinventory']);
				$a->save();
			}
		}
		
		
		$form->addElement('header','product_submit','Save Product');
		$form->addElement('submit', 'cartproduct_submit', 'Submit');

		return $form;

	}
	
	public function getAddToCartForm() {
		$form = new Form('product_addtocart', 'post', '/store/cart/', null, array('onchange' => 'updateProduct(this);'));
		
		$form->setConstants( array ( 'action' => 'add' ) );
		$form->addElement( 'hidden', 'action' );
		
		$form->setConstants( array ( 'productId' => $this->getId() ) );
		$form->addElement( 'hidden', 'productId' );
		
		$defaults['productQuantity'] = $this->getOrderMin();
		$defaults['productPalletCount'] = $this->getPalletCount();
		
		$price = $this->getFinalPrice();
		
		$atts = $this->getAttributes();

		if (isset($_REQUEST['productQuantity'])) {
			$price *= $_REQUEST['productQuantity'];
		} else {
			$price *= $this->getOrderMin();
		}
		$opts = $this->getOptions();
		$types = array();
		foreach ($opts as $opt) {
			$types[$opt->getOptionsId()->getId()][] = $opt;
		}
		foreach ($types as $key => $atts) {
			$attributes_elements = array();
			if (isset($_REQUEST['att'][$key])) {
				$setopt = new CartProductAttribute($_REQUEST['att'][$key]);
				$price += $setopt->getValuesPrice();
			}
		}
		//$form->addElement('image', 'buy', '/modules/Cart/images/buyBtn.jpg');
		
		$form->addElement('html', '<h3 class="productPrice">$' . $price . '</h3>');
		
		foreach ($types as $key => $atts) {
			$attributes_elements = array();
			foreach ($atts as $att) {
				if ($att->getInventory() <= 0) {
					continue;
				}
				$attributes_elements[$att->getId()] = $att->getValue()->getName(); //$form->createElement('select', $att->getOptionsId()->getName(), array());
			}
			if (count($attributes_elements) > 0) {
				$form->addElement('select','att[' . $key . ']',$att->getOptionsId()->getName(),$attributes_elements);
			}
		}
		/*
		$attributes_elements = array();
		foreach ($atts as &$att) {
			$array = array();
			foreach ($att as $option) {
				$array[$option->getValue()->getId()] = $option->getValue()->getName();
			}
			$attributes_elements[] = $form->createElement('select', $att[0]->getOptionsId()->getId(), 
				$att[0]->getOptionsId()->getName(), $array);
			
			if (isset($_REQUEST['att'])) {
				$attribute = new CartProductAttribute($_REQUEST['att'][$att[0]->getOptionsId()->getId()]);
				$price += $attribute->getValuesPrice();
			}
		}
		if ($atts) $form->addGroup($attributes_elements,'att',$attribute->getOptionsId()->getName(),' ');
		*/
		
		
		$form->setDefaults($defaults);
		
		$qty = array();
		for ($i = $this->getOrderMin(); $i < $this->getOrderMin() + 99; $i++) {
			$qty[$i] = $i;
		}
		$form->addElement('select', 'productQuantity', 'Quantity', $qty);
		
		$form->addElement('html', '<div class="element"><input id="buy" name="buy" type="image" src="/modules/Cart/images/addToCart.jpg" /></div><br /><br />');
		return $form;
	}

	/**
	 * Return an array of all existing objects of this type in the database
	 */
	public static function getAllCartProducts($from = null, $limit = null) {
		$sql = 'select cart_products.`products_id` from cart_products
				left join cart_products_description on cart_products.products_id = cart_products_description.products_id
				order by products_name';

		if (!is_null($from) && !is_null($limit)) {
			$sql .= ' limit ' . ($from - 1) . ', ' . ($limit);
		}
		
		$results = Database::singleton()->query_fetch_all($sql);

		foreach ($results as &$result) {
			$result = new CartProduct($result['products_id']);
		}
		return $results;
	}
	
	public static function getCountCartProducts() {
		$sql = 'select count(*) as count from cart_products';
		$result = Database::singleton()->query_fetch($sql);
		return $result['count'];
	}
	
	public static function getCountCartProductsByCat($catid) {
		$sql = 'select count(*) as count from cart_products_to_categories where categories_id=' . $catid;
		$result = Database::singleton()->query_fetch($sql);
		return $result['count'];
	}

	public static function getCategoryProducts($id, $from = null, $limit = null) {
		$sql = 'select cart_products_to_categories.products_id from cart_products_to_categories
				left join cart_products_description on cart_products_description.products_id = cart_products_to_categories.products_id
				where categories_id="' . e($id) . '"
				order by products_name';
		if (!is_null($from) && !is_null($limit)) {
			$sql .= ' limit ' . ($from - 1) . ', ' . ($limit);
		}
		
		$products = Database::singleton()->query_fetch_all($sql);
		foreach ($products as &$product) {
			$product = new CartProduct($product['products_id']);
		}
		return $products;
	}
	
	public static function toArray($search = null) {
		//$types = self::getAllCartProducts();
		$sql = 'select products_id, products_name from cart_products_description';
		if ($search != null) {
			$sql .= ' where products_name LIKE "%' . $search . '%"';
		}
		$sql .= ' order by products_name';
		
		$rs = Database::singleton()->query_fetch_all($sql);
		
		$array = array();
		//return $array;
		$array[0] = 'NONE';
		foreach ($rs as $type) {
			$array[$type['products_id']] = $type['products_name'];
		}
		
		return $array;
	}
	
	public static function searchProducts($supplier = null, $category = null, $product_type = null, $from = null, $limit = null){
		$sql = 'select cart_products.`products_id` from cart_products
				left join cart_products_description on cart_products.products_id = cart_products_description.products_id
				where 1=1';
		if ($supplier){
			$sql .= ' and manufacturers_id = "' . e($supplier) . '"';
		}
		if ($category){
			$sql .= ' and master_categories_id = "' . e($category) . '"';
		}
		if ($product_type){
			$sql .= ' and products_type = "' . e($product_type) . '"';
		}
		$sql .= " order by products_name";
		if (!is_null($from) && !is_null($limit)) {
			$sql .= ' limit ' . ($from - 1) . ', ' . ($limit);
		}
		$results = Database::singleton()->query_fetch_all($sql);

		foreach ($results as &$result) {
			$result = new CartProduct($result['products_id']);
		}
		return $results;
	}
	
	public static function getAvailableWeightUnits(){
		return array('KG'=>'KG','Cubic Feet'=>'Cubic Feet','Cubic Yards'=>'Cubic Yards','LB'=>'LB');
	}
}
?>
