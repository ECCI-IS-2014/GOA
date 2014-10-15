<?php

App::uses('AppHelper', 'View/Helper');

class StringFormatterHelper extends AppHelper {
    public $helpers = array('Html');

    /*
     * Recibe un array de productos, y devuelve una cadena con los divs que representan los productos
     */
    public function formatCurrency($number, $currency) {

        $number = floatval($number);
    	return $currency . number_format ($number, 2, '.', ',');

	}

}
