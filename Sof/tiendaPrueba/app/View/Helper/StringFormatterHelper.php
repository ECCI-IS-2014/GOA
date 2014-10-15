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

}
