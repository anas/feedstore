<?php
class ProductProperties extends ECommProduct{
	public function __construct(){
		$this->pluginName = "Product Properties";
		$this->pluginDetails = "Any non-standard property goes here: Pallet count, weight, and weight unit";
	}
	
	public function adminHookBeforeDisplayForm(&$product, &$form){
		$productProperty = ProductPropertiesTbl::getPropertiesBasedOnProductId($product->getId());
		
		$palletCount = $form->createElement('text', 'product_pallet_count', "Pallet Count");
		$weight = $form->createElement('text', 'product_weight', "Weight");
		$weightUnit = $form->createElement('select', 'product_weight_unit', "Weight Unit",array('KG'=>'KG','Cubic Feet'=>'Cubic Feet','Cubic Yards'=>'Cubic Yards','LB'=>'LB'));
		
		$form->insertElementBefore($palletCount, "product_details");
		$form->insertElementBefore($weight, "product_details");
		$form->insertElementBefore($weightUnit, "product_details");
		
		$defaultValue = array();
		$defaultValue["product_pallet_count"] = $productProperty->getPalletCount();
		$defaultValue["product_weight"] = number_format($productProperty->getWeight(), 2);
		$defaultValue["product_weight_unit"] = $productProperty->getWeightUnit();
		$form->setDefaults($defaultValue);
		
		$form->addRule('product_pallet_count', "Pallet count cannot be empty", 'required', null, 'client');
		$form->addRule('product_weight', "Weight cannot be empty", 'required', null, 'client');
		$form->addRule('product_weight_unit', "Weight unit cannot be empty", 'required', null, 'client');
	}
	
	public function adminHookAfterSave(&$product, &$form){
		$productProperty = ProductPropertiesTbl::getPropertiesBasedOnProductId($product->getId());
		$productProperty->setProduct($product->getId());
		$productProperty->setPalletCount($_REQUEST["product_pallet_count"]);
		$productProperty->setWeight($_REQUEST["product_weight"]);
		$productProperty->setWeightUnit($_REQUEST["product_weight_unit"]);
		$productProperty->save();
	}
	
	public function adminHookBeforeDisplayOrder(&$orderDetail){
	}
	
	public function clientHookBeforeDisplayProduct(&$product, &$ecommModule){
	}
	
	public function clientHookBeforeDisplayCartItem(&$cartItem, &$ecommModule){
	}
}

include_once(SITE_ROOT.'/core/DBColumn.php');
include_once(SITE_ROOT.'/core/DBColumns.php');
class ProductPropertiesTbl extends DBRow {
	function createTable() {
		$cols = array(
			'id?',
			DBColumn::make('!integer', 'product', 'Product'),
			DBColumn::make('!integer', 'pallet_count', 'Pallet Count'),
			DBColumn::make('!float', 'weight', 'Weight'),
			DBColumn::make('!select', 'weight_unit', 'Weight Unit', array('KG'=>'KG','Cubic Feet'=>'Cubic Feet','Cubic Yards'=>'Cubic Yards','LB'=>'LB')),
		);
		return new DBTable("ecomm_product_properties", __CLASS__, $cols);
	}
	
	public static function getPropertiesBasedOnProductId($productId){
		if (!$productId)
			return new ProductPropertiesTbl();
		$sql = 'select `id` from ecomm_product_properties where product = "' . e($productId) . '"';
		$result = Database::singleton()->query_fetch($sql);
		return new ProductPropertiesTbl($result['id']);
	}
	
	static function getQuickFormPrefix() {return 'product_';}
}
DBRow::init('ProductPropertiesTbl');
?>