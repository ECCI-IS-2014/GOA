<?php

App::uses('AppHelper', 'View/Helper');

class CatalogGeneratorHelper extends AppHelper {
    public $helpers = array('Html', 'StringFormatter');

    /*
     * Recibe un array de productos, y devuelve una cadena con los divs que representan los productos
     */
    public function formatProducts($products) {

    	echo $this->Html->css('catalogs');

    	$result_string = '';

    	foreach ($products as $key => $prod) {
    		$result_string = $result_string . 	"<div class='catalog_item'>" .

                                                    $this->Html->image('product_icons/'.$prod['Product']['image'], array('alt' => 'CakePHP', 'class' => 'product_photo')) .
    												//"<img class='product_photo' src='" . $this->webroot . "/img/product_icons/placeholder.png' />" .

    												"<div class='info_panel'>" .

    													"<p class='catalog_title1'>" . $prod['Product']['name'] . "</p>" .

    													"<div class='cat_text_container'><span class='catalog_title2'>" . 'Price: ' . "</span><span class='catalog_text1'>" . $this->StringFormatter->formatCurrency($prod['Product']['price'], '$') . "</span></div>" .

    													"<div class='cat_text_container'><span class='catalog_title2'>" . 'In stock now: ' . "</span><span class='catalog_text1'>" . $prod['Product']['quantity'] . "</span></div>" .

                                                        "<div class='cat_id_container'><span class='catalog_id'>".'Product id:' . $prod['Product']['id'] . "</span></div>" .

                                                        "<div class='cat_button_container'>"."<a href='".$this->Html->url(array("controller" => "products","action" => "productInside","id"=>"")).$prod['Product']['id']."'>".'View'."</a>"."</div>".


                                                        $this->displayRatingBox($prod['Product']['rating']) .

    												"</div>" .


    											"</div>";
    	}

    	return $result_string;

	}

    /*
     * Recibe un int del 0 al 5 y devuelve una cadena con la representacion HTML en forma de estrellas
     */
	public function displayRatingBox($value) {

		$value = intval($value);
        $result_string = '';
        $num_stars = 5;

		if($value >= 0 && $value <= $num_stars) {
			
            for($i = 0; $i < $value; $i++) {
                $result_string = $result_string . "<img src='" . $this->webroot . "/img/star_icon_full.png' />";
            }

            for($i = 0; $i < $num_stars-$value; $i++) {
                $result_string = $result_string . "<img src='" . $this->webroot . "/img/star_icon_empty.png' />";
            }

		}

        $result_string = "<div class='rating_box'>" . $result_string . "</div>";

        return $result_string;

	}

}



//$prod['Product'] : Array ( [id] => 1 [category_id] => 8 [name] => sandalias [price] => 2500.00 [quantity] => 14 [image] => placeholder [status] => [rating] => 3 )