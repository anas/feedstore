<?php
	
class CreditCard extends Payment {
	
	public static $card_types = array(
					'visa'=>'Visa',
					'mastercard'=>'Mastercard',
					'amex'=>'American Express',
					'discover'=>'Discover'
				);
	
	public static function getForm($form) {
		
		$form->addElement('select', 'card_type', 'Credit Card Type', self::$card_types);
		$form->addElement('text', 'card_number', 'Credit Card Number');
		
		$exp_date = array(
			'format' => 'm / Y',
			'minYear' => date('Y'),
			'maxYear' => date('Y') + 10
		);
		
		$form->addElement('date', 'card_exp', 'Expiry Date', $exp_date);
		$form->addElement('text', 'card_ccid', 'CCID');
		$form->addElement('submit', 'cart_submit', 'Pay Now');
		
		$form->addRule('card_number', 'The number is invalid', new ValidCreditCard(), $form->exportValue('card_type'));
		$form->addRule('card_number', 'The number is empty', 'required', null, 'client');
		
		$form->validate();
		
		return $form;
	}
}

require_once 'HTML/QuickForm/Rule.php';
class ValidCreditCard extends HTML_QuickForm_Rule {

    function validate($value, $options) {
    	return self::number($value, $options);
    }
    

	public static function type($creditCard, $cardType) {
		switch (strtoupper($cardType)) {
			case 'MASTERCARD':
			case 'EUROCARD':
			case 'EUROCARD/MASTERCARD':
				$regex = '5[1-5][0-9]{14}';
				break;
			case 'VISA':
				$regex = '4([0-9]{12}|[0-9]{15})';
				break;
			case 'AMEX':
			case 'AMERICANEXPRESS':
			case 'AMERICAN EXPRESS':
				$regex = '3[47][0-9]{13}';
				break;
			case 'DINERS':
			case 'DINERSCLUB':
			case 'DINERS CLUB':
			case 'CARTEBLANCHE':
			case 'CARTE BLANCHE':
				$regex = '3(0[0-5][0-9]{11}|[68][0-9]{12})';
				break;
			case 'DISCOVER':
				$regex = '6011[0-9]{12}';
				break;
			case 'JCB':
				$regex = '(3[0-9]{15}|(2131|1800)[0-9]{11})';
				break;
			case 'ENROUTE':
				$regex = '2(014|149)[0-9]{11}';
				break;
			default:
				return false;
		}
		$regex = '/^' . $regex . '$/';

		$cc = str_replace(array('-', ' '), '', $creditCard);
		return (bool)preg_match($regex, $cc);
	}

	function cvv($cvv, $cardType) {
		switch (strtoupper($cardType)) {
			case 'MASTERCARD':
			case 'EUROCARD':
			case 'EUROCARD/MASTERCARD':
			case 'VISA':
			case 'DISCOVER':
				$digits = 3;
				break;
			case 'AMEX':
			case 'AMERICANEXPRESS':
			case 'AMERICAN EXPRESS':
				$digits = 4;
				break;
			default:
				return false;
		}

		if (strlen($cvv) == $digits
		&& strspn($cvv, '0123456789') == $digits) {
			return true;
		}

		return false;
	}

	public static function number($creditCard, $cardType = null) {
		$cc = str_replace(array('-', ' '), '', $creditCard);
		if (($len = strlen($cc)) < 13
		|| strspn($cc, '0123456789') != $len) {

			return false;
		}

		// Only apply the Luhn algorithm for cards other than enRoute
		// So check if we have a enRoute card now
		if (strlen($cc) != 15
		|| (substr($cc, 0, 4) != '2014'
		&& substr($cc, 0, 4) != '2149')) {

			if (!self::Luhn($cc)) {
				return false;
			}
		}

		if (is_string($cardType)) {
			return self::type($cc, $cardType);
		}

		return true;
	}

	public static function Luhn($number) {
		$len_number = strlen($number);
		$sum = 0;
		for ($k = $len_number % 2; $k < $len_number; $k += 2) {
			if ((intval($number{$k}) * 2) > 9) {
				$sum += (intval($number{$k}) * 2) - 9;
			} else {
				$sum += intval($number{$k}) * 2;
			}
		}
		for ($k = ($len_number % 2) ^ 1; $k < $len_number; $k += 2) {
			$sum += intval($number{$k});
		}
		return ($sum % 10) ? false : true;
	}
    
}

?>