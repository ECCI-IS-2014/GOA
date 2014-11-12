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

	public function formatCardLastNumbers($card_num) {
		if(strlen($card_num) == 16) {
			return substr($card_num, 12, 4);
		}
		else {
			return "not valid";
		}
	}

	public function formatDateMY($date) {
		if(strlen($date) == 10) {
			$months = array('','January','February','March','April','May','June','July','August','September','October','November','December');
			$year = substr($date, 0, 4);
			$month = substr($date, 5, 2);
			$monthNum = intval($month);
			return $months[$monthNum].' '.$year;
		}
		else {
			return "not valid";
		}
	}

	public function formatDateMDY($date) {
		if(strlen($date) == 10) {
			$months = array('','January','February','March','April','May','June','July','August','September','October','November','December');
			$year = substr($date, 0, 4);
			$month = substr($date, 5, 2);
			$day = substr($date, 8, 2);
			$monthNum = intval($month);
			return $months[$monthNum].' '.$day.', '.$year;
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
