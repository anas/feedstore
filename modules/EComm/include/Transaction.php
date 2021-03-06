<?php
include_once(SITE_ROOT.'/core/DBColumn.php');
include_once(SITE_ROOT.'/core/DBColumns.php');

class Transaction extends DBRow {
	function createTable() {
		$cols = array(
			'id?',
			DBColumn::make('text', 'tid', 'Transaction ID'), 
			DBColumn::make('integer', 'session', 'Session ID'),
			DBColumn::make('integer', 'user', 'User'),
			DBColumn::make('text', 'phone', 'Phone number'), 
			DBColumn::make('text', 'shipping_street', 'Shipping street'), 
			DBColumn::make('text', 'shipping_city', 'Shipping City'), 
			DBColumn::make('text', 'shipping_postal', 'Shipping Postal'), 
			DBColumn::make('text', 'shipping_province', 'Shipping Province'), 
			DBColumn::make('text', 'shipping_country', 'Shipping Country'), 
			DBColumn::make('text', 'billing_street', 'Billing Street'), 
			DBColumn::make('text', 'billing_city', 'Billing City'), 
			DBColumn::make('text', 'billing_postal', 'Billing Postal'), 
			DBColumn::make('text', 'billing_province', 'Billing Province'), 
			DBColumn::make('text', 'billing_country', 'Billing Country'), 
			DBColumn::make('text', 'cost_subtotal', 'Sub Total'), 
			DBColumn::make('text', 'cost_tax', 'Tax'), 
			DBColumn::make('text', 'cost_shipping', 'Shipping Cost'), 
			DBColumn::make('text', 'cost_total', 'Total'), 
			DBColumn::make('text', 'ip', 'IP Address'), 
			DBColumn::make('text', 'shipping_class', 'Shipping Class'), 
			DBColumn::make('text', 'payment_class', 'Payment Class'), 
			DBColumn::make('text', 'created', 'Timestamp'),
			DBColumn::make('textarea', 'delivery_instructions', 'Delivery Instructions'),
			DBColumn::make('text', 'status', 'Status'),
		);
		return new DBTable("ecomm_transaction", __CLASS__, $cols);
	}
	
	//The following functions have to be overridden because we want to display only two numbers after the decimal
	public function getCostSubtotal(){
		return number_format($this->get("cost_subtotal"), 2);
	}
	
	public function getCostTax(){
		return number_format($this->get("cost_tax"), 2);
	}
	
	public function getCostShipping(){
		return number_format($this->get("cost_shipping"), 2);
	}
	
	public function getCostTotal(){
		return number_format($this->get("cost_total"), 2);
	}
	
	public static function getTransactionBasedOnTID($tid){
		$sql = 'select `id` from ecomm_transaction  where tid like "' . e($tid) . '"';
		$result = Database::singleton()->query_fetch($sql);
		$obj = new Transaction($result['id']);
		return $obj;
	}
	
	public static function generateNewTID(){
		srand ((double) microtime( ) * 1000000);
		$tid = "";
		for ($i = 0; $i < 30; $i++)
			$tid .= rand(1, 9);
		return $tid;
	}
	
	public static function getAll(){
		$sql = 'select `id` from ecomm_transaction';
		$results = Database::singleton()->query_fetch_all($sql);
		
		foreach ($results as &$result) {
			$result = new Transaction($result['id']);
		}
		return $results;
	}
	static function getQuickFormPrefix() {return 'transaction_';}
}
DBRow::init('Transaction');
?>