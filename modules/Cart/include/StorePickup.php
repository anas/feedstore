<?php

class StorePickup extends Shipping {
	
	protected $base = 0.00;
	
	public function getCost() {
		return parent::getCost() + $this->base;
	}
	
}

?>