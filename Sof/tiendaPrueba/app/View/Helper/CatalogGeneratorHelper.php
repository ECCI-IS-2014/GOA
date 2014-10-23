<?php

App::uses('AppHelper', 'View/Helper');

class CatalogGeneratorHelper extends AppHelper {
    public $helpers = array('Html', 'StringFormatter');

    /*
     * Recibe un array de productos, y devuelve una cadena con los divs que representan los productos
     */
    public function formatProducts($products, $limit = null) {

    	echo $this->Html->css('catalogs');

    	$result_string = '<div>';

        for($i = 0; $i < count($products); $i++) {

            if( $i < $limit || is_null($limit) ) {

                $result_string = $result_string .   "<div class='catalog_item'>" .

                                                        $this->Html->image('product_icons/'.$products[$i]['Product']['image'], array('alt' => 'CakePHP', 'class' => 'product_photo')) .
                                                        //"<img class='product_photo' src='" . $this->webroot . "/img/product_icons/placeholder.png' />" .

                                                        "<div class='info_panel'>" .

                                                            "<p class='catalog_title1'>" . $products[$i]['Product']['name'] . "</p>" .

                                                            "<div class='cat_text_container'><span class='catalog_title2'>" . 'Price: ' . "</span><span class='catalog_text1'>" . $this->StringFormatter->formatCurrency($products[$i]['Product']['price'], '$') . "</span></div>" .

                                                            "<div class='cat_text_container'><span class='catalog_title2'>" . 'In stock now: ' . "</span><span class='catalog_text1'>" . $products[$i]['Product']['quantity'] . "</span></div>" .

                                                            "<div class='cat_id_container'><span class='catalog_id'>".'Product id:' . $products[$i]['Product']['id'] . "</span></div>" .

                                                            "<div class='cat_button_container'>"."<a href='".$this->Html->url(array("controller" => "products","action" => "productInside","id"=>"")).$products[$i]['Product']['id']."'>".'View'."</a>"."</div>".

                                                            $this->displayRatingBox($products[$i]['Product']['rating']) .

                                                        "</div>" .

                                                    "</div>";

            }

        }

    	return $result_string . '</div>';

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


    public function formatWishes($wishes, $limit = null)
    {
        echo $this->Html->css('catalogs');

        $result_string = '<div>';
        for($i = 0; $i < count($wishes); $i++) {

            if( $i < $limit || is_null($limit) ) {



                $result_string = $result_string
                    ."<div class='wish_item'>".
                    $this->Html->image('product_icons/'.$wishes[$i]['Product']['image'], array('alt' => 'CakePHP', 'class' => 'p_photo','style'=>'height:100%; width:8%; float:left;')) .
                    "<div class='infoPan' style='margin-bottom: 1.5%;'>".
                    "<p style='font-weight:bold; float:left; margin-left:2%;'>".'Name:'."</p >"."<p style='width:40%; margin-bottom:0%; margin-right:0%;'> ".$wishes[$i]['Product']['name']."</p>"."<button id='addCartButt'>".'Add to Cart'."</button>"."<div>"."</div>".
                    "<br>".
                    "<p style='font-weight:bold; float:left; margin-left:2%;'>".'Price:'."</p>"."<p style='width:40%; margin-bottom:0%; margin-right:0%; float:left;'> " .$this->StringFormatter->formatCurrency($wishes[$i]['Product']['price'], '$')."</p>"."<button id='deleteWishListButton'>"."<a href=".$this->Html->url(array('controller' => 'wishes','action' => 'delete', 'id'=>$wishes[$i]['Product']['id'])).">".'Delete'."</a>"."</button>"."<div>"."</div>".
                    "<br>".
                    "<div id='ratingHolder' style='margin-left: 10%;'>".$this->displayRatingBox($wishes[$i]['Product']['rating'])."</div>".
                    "</div>".
                    "<div style='clear:both'>"."</div>".


                    "<hr>".

                    "</div>";



            }

        }

        return $result_string . '</div>';



    }

}



//$prod['Product'] : Array ( [id] => 1 [category_id] => 8 [name] => sandalias [price] => 2500.00 [quantity] => 14 [image] => placeholder [status] => [rating] => 3 )