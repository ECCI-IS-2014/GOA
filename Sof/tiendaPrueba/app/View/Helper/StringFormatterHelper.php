<?php

App::uses('AppHelper', 'View/Helper');

class StringFormatterHelper extends AppHelper {
    public $helpers = array('Html');

    /*
     * Recibe un numero int o float y un simbolo de moneda y devuelve una cadena con formato correcto de precio "dinero"
     */
    public function formatCurrency($number, $currency) {

        $number = floatval($number);
    	return $currency . number_format ($number, 2, '.', ',');

	}

	public function hideCardNumber($card_num) {
		if(strlen($card_num) == 16) {
			return substr_replace($card_num, "************", 0, 12);
		}
		else {
			return "not valid";
		}
	}

	public function formatCardNumber($card_num, $separator) {
		if(strlen($card_num) == 16) {
			return substr_replace(substr_replace(substr_replace($card_num, $separator, 4, 0), $separator, 9, 0), $separator, 14, 0);
		}
		else {
			return "not valid";
		}
	}
	
	public function formatWeight ($number, $unit) {
	
		$number = floatval($number);
		return number_format ($number, 2, '.', ',') . ' ' . $unit;
	}
	
	public function formatVolume ($number, $unit) {
	
		$number = floatval($number);
		return number_format ($number, 2, '.', ',') . ' ' . $unit . '<sup>3</sup>';
	}

}
