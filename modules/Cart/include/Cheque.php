<?php

class Cheque extends Payment {
	
	public static function getForm($form) {
		
		$form->removeElement('cart_submit');
		$form->addElement('submit', 'cart_submit', 'Print Invoice');
		
		if ($form->validate() && $form->isSubmitted() && isset($_REQUEST['cart_submit'])) {
			self::process($form->exportValues());
		}
		
		return $form;
	}
	
	public function process($values) {
		$order = parent::process($values);
	}
	
}

?>