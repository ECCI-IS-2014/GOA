<?php

App::uses('AppHelper', 'View/Helper');

class CatalogGeneratorHelper extends AppHelper {
    public $helpers = array('Html', 'StringFormatter');

    /*
     * Recibe un array de productos, y devuelve una cadena con los divs que representan los productos
     */
    public function formatProducts($products, $limit = null) {

    	echo $this->Html->css('catalogs');

    	$result_string = '<div type="catalog">';

        for($i = 0; $i < count($products); $i++) {

            if( $i < $limit || is_null($limit) ) {
			
				if ($products[$i]['Product']['discount'] == 0) {
					$price = $products[$i]['Product']['price'];
				} else {
					$price = $products[$i]['Product']['price'] - ($products[$i]['Product']['price']*$products[$i]['Product']['discount'])/100;
				}

                $result_string = $result_string .   "<div class='catalog_item'>" .

                                                        "<a href='".$this->Html->url(array("controller" => "products","action" => "productInside","id"=>"")).$products[$i]['Product']['id']."'>".
                                                            
															"<div class='link'>" .
															
																$this->Html->image('product_icons/'.$products[$i]['Product']['image'], array('alt' => 'CakePHP', 'class' => 'product_photo')) .

																"<div class='info_panel'>" .

																	"<p class='catalog_title1'>" . $products[$i]['Product']['name'] . "</p>" .

																	"<div class='cat_text_container'><span class='catalog_title2'>" . 'Price: ' . "</span><span class='catalog_text1'>" . $this->StringFormatter->formatCurrency($price, '$') . "</span></div>" .

																	"<div class='cat_text_container'><span class='catalog_title2'>" . 'In stock now: ' . "</span><span class='catalog_text1'>" . $products[$i]['Product']['quantity'] . "</span></div>" .

																	$this->displayRatingBox($products[$i]['Product']['rating']) .

																"</div>" .
															
															"</div>" .
														
														"</a>".

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

            if ($wishes[$i]['Product']['discount'] == 0) {
                $price = $wishes[$i]['Product']['price'];
            } else {
                $price = $wishes[$i]['Product']['price'] - ($wishes[$i]['Product']['price']*$wishes[$i]['Product']['discount'])/100;
            }

            if ($wishes[$i]['Product']['enable_product'] == 0) {
                // El producto esta deshabilitado
                $result_string = $result_string.
                    "<div class='wish_item'>".
                        "<a href='".$this->Html->url(array("controller" => "products","action" => "productInside","id"=>"")).$wishes[$i]['Product']['id']."'>".
                            $this->Html->image('product_icons/'.$wishes[$i]['Product']['image'], array('alt' => 'CakePHP', 'class' => 'p_photo','style'=>'height:100%; width:8%; float:left;')) .
                        "</a>".
                        "<div class='infoPan' style='margin-bottom: 1.5%;'>".
                            "<p style='font-weight:bold; float:left; margin-left:2%;'>Name:&nbsp;</p >".
                            "<p style='width:40%; margin-bottom:0%; margin-right:0%;'>".$wishes[$i]['Product']['name']."</p>".
                            "<div></div>".
                            "<br>".
                            "<p style='font-weight:bold; float:left; margin-left:2%;'>Price:&nbsp;</p>".
                            "<p style='width:40%; margin-bottom:0%; margin-right:0%; float:left;'> ".$this->StringFormatter->formatCurrency($price, '$')."</p>".
                            "<button id='deleteWishListButton'>"."<a href=".$this->Html->url(array('controller' => 'wishes','action' => 'delete', 'id'=>$wishes[$i]['Product']['id']),array(), __('Are you sure you want to delete this wish from your wishlist?')).">".'Delete'."</a>"."</button>".
                            "<div>"."</div>".                    
                            "<br>".
                            "<p style='font-weight:bold; float:left; margin-left:10%; width:500px; color:red;'>We are sorry this product is disabled, we are having problems with the company that distributes this product.</p>".
                        "</div>".
                        "<div style='clear:both'></div>".
                        "<hr>".
                    "</div>";

            } elseif ($wishes[$i]['Product']['quantity'] > 0) {
                // Hay del producto en stock
                $result_string = $result_string.
                    "<div class='wish_item'>".
                        "<a href='".$this->Html->url(array("controller" => "products","action" => "productInside","id"=>"")).$wishes[$i]['Product']['id']."'>".
                            $this->Html->image('product_icons/'.$wishes[$i]['Product']['image'], array('alt' => 'CakePHP', 'class' => 'p_photo','style'=>'height:100%; width:8%; float:left;')) .
                        "</a>".
                        "<div class='infoPan' style='margin-bottom: 1.5%;'>".
                            "<p style='font-weight:bold; float:left; margin-left:2%;'>Name:&nbsp;</p >".
                            "<p style='width:40%; margin-bottom:0%; margin-right:0%;'>".$wishes[$i]['Product']['name']."</p>".
                            "<button id='addCartButt'>"."<a href=".$this->Html->url(array('controller' => 'carts','action' => 'add','id'=>$wishes[$i]['Product']['id'])).">".'Add to cart'."</a>"."</button>".
                            "<div></div>".
                            "<br>".
                            "<p style='font-weight:bold; float:left; margin-left:2%;'>Price:&nbsp;</p>".
                            "<p style='width:40%; margin-bottom:0%; margin-right:0%; float:left;'>".$this->StringFormatter->formatCurrency($price, '$')."</p>".
                            "<button id='deleteWishListButton'>"."<a href=".$this->Html->url(array('controller' => 'wishes','action' => 'delete', 'id'=>$wishes[$i]['Product']['id']),array(), __('Are you sure you want to delete this wish of your wishlist?')).">".'Delete'."</a>"."</button>".
                            "<div></div>".
                            "<br>".
                            "<p style='font-weight:bold; float:left; margin-left:10%;'>In stock now:&nbsp;</p>".
                            "<p style='width:40%; margin-bottom:0%; margin-right:0%; float:left;'>".$wishes[$i]['Product']['quantity']."</p>".
                            "<br><br>".
                            "<div id='ratingHolder' style='margin-left: 10%; float:left;'>".$this->displayRatingBox($wishes[$i]['Product']['rating'])."</div>".
                            "<br>".
                        "</div>".
                        "<div style='clear:both'></div>".
                        "<hr>".
                    "</div>";

            } else {
                // El producto se acabo
                $result_string = $result_string.
                    "<div class='wish_item'>".
                        "<a href='".$this->Html->url(array("controller" => "products","action" => "productInside","id"=>"")).$wishes[$i]['Product']['id']."'>".
                            $this->Html->image('product_icons/'.$wishes[$i]['Product']['image'], array('alt' => 'CakePHP', 'class' => 'p_photo','style'=>'height:100%; width:8%; float:left;')) .
                        "</a>".
                        "<div class='infoPan' style='margin-bottom: 1.5%;'>".
                            "<p style='font-weight:bold; float:left; margin-left:2%;'>Name:&nbsp;</p >".
                            "<p style='width:40%; margin-bottom:0%; margin-right:0%;'>".$wishes[$i]['Product']['name']."</p>".
                            "<div></div>".
                            "<br>".
                            "<p style='font-weight:bold; float:left; margin-left:2%;'>Price:&nbsp;</p>".
                            "<p style='width:40%; margin-bottom:0%; margin-right:0%; float:left;'>".$this->StringFormatter->formatCurrency($price, '$')."</p>".
                            "<button id='deleteWishListButton'>"."<a href=".$this->Html->url(array('controller' => 'wishes','action' => 'delete', 'id'=>$wishes[$i]['Product']['id']),array(), __('Are you sure you want to delete this wish of your wishlist?')).">".'Delete'."</a>"."</button>".
                            "<div></div>".
                            "<br>".
                            "<p style='font-weight:bold; float:left; margin-left:2%; color: red;'>Out stock!</p>".
                            "<br><br>".
                            "<div id='ratingHolder' style='margin-left: 10%; float:left;'>".$this->displayRatingBox($wishes[$i]['Product']['rating'])."</div>".
                            "<br>".
                        "</div>".
                        "<div style='clear:both'>"."</div>".
                        "<hr>".
                    "</div>";
            }


        }

        return $result_string.'</div>';

    }

     //Método que muestra productos del carro.

    public function formatCart($prodCarts, $numProducts) {
        echo $this->Html->css('catalogs');
        $result_string = '<div>';
        
        for($i = 1; $i < count($prodCarts); $i++) {

            if ( $numProducts[$i] > 0 ) {
                if ($prodCarts[$i]['Product']['discount'] == 0) {
                    $price = $prodCarts[$i]['Product']['price'];
                } else {
                    $price = $prodCarts[$i]['Product']['price'] - ($prodCarts[$i]['Product']['price']*$prodCarts[$i]['Product']['discount'])/100;
                }

                $result_string = $result_string.
                    "<div class='cart_item'>".
                        "<a href='".$this->Html->url(array("controller" => "products","action" => "productInside","id"=>"")).$prodCarts[$i]['Product']['id']."'>".
                            $this->Html->image('product_icons/'.$prodCarts[$i]['Product']['image'], array('alt' => 'CakePHP', 'class' => 'p_photo','style'=>'height:100%; width:8%; float:left;')) .
                        "</a>".
                        "<div class='infoPan' style='margin-bottom: 1.5%;'>".
                            "<p style='font-weight:bold; float:left; margin-left:2%;'>".'Name:&nbsp;'."</p >".
                            "<p style='width:40%; margin-bottom:0%; margin-right:0%;'> ".
                                $prodCarts[$i]['Product']['name'].
                            "</p>".
                            "<button id='deleteCartButton'>".
                                "<a href=".$this->Html->url(array('controller' => 'carts','action' => 'delete', 'id'=>$prodCarts[$i]['Product']['id'])).">".
                                    'Delete'.
                                "</a>".
                            "</button>".
                            "<div>"."</div>".
                            "<p style='font-weight:bold; float:left; margin-left:2%;'>".'Price:&nbsp;'."</p>".
                            "<p style='width:40%; margin-bottom:0%; margin-right:0%; float:left;'> ".
                                $this->StringFormatter->formatCurrency($price, '$').
                            "</p>".
                            "<div>"."</div>".
                            "<br>".
                            "<br>".
                            '<form id="EditForm'. $prodCarts[$i]['Product']['id'] .'" method="post" action="'.$this->Html->url(array('controller' => 'carts','action' => 'edit', $prodCarts[$i]['Product']['id'])).'">'.
                                "<p style='font-weight:bold; float:left; margin-left:10%;'>".'&nbsp;Amount:&nbsp;'."</p>".
                                "<select name='cantidad'>";

                for ( $j = 1; $j <= $prodCarts[$i]['Product']['quantity']; ++$j ) {
                    if ( $j == $numProducts[$i] ) {
                        $result_string = $result_string .
                                    '<option value = "' . $j . '" selected>' . $j . '</option>';
                    } else {
                        $result_string = $result_string .
                                    '<option value = "' . $j . '">' . $j . '</option>';
                    }
                }
                            
                $result_string = $result_string.
                                "</select>".
                                '<span id="setCart" style="margin-left:5px; ">'.
                                    '<input type="submit" value="Set" style="font-size:16px; position:relative;top: -3px;"/>'.
                                '</span>'.
                            "</form>".
                            "<div>"."</div>".
                            "<br>".
                            "<p style='font-weight:bold; float:left; margin-left:10%;'>".'Total:&nbsp;'."</p>".
                            "<p style='width:40%; margin-bottom:0%; margin-right:0%; float:left;'> ".
                                $this->StringFormatter->formatCurrency($price * $numProducts[$i], '$').
                            "</p>".
                            "<div>"."</div>".
                            "<br>".
                        "</div>".
                        "<div style='clear:both'></div>".
                        "<hr>".

                    "</div>";
            }
        }

        return $result_string.'</div>';

    }



    // metodo que muestra productos en facturas


    public function formatSale($prodCarts, $numProducts) {
        echo $this->Html->css('catalogs');
        $result_string = '<div>';

        for($i = 1; $i < count($prodCarts); $i++) {

            if ( $numProducts[$i] > 0 ) {
			 if ($prodCarts[$i]['Product']['discount'] == 0) {
                    $price = $prodCarts[$i]['Product']['price'];
                } else {
                    $price = $prodCarts[$i]['Product']['price'] - ($prodCarts[$i]['Product']['price']*$prodCarts[$i]['Product']['discount'])/100;
                }
                $result_string = $result_string.
                    "<div class='cart_item' style='width: 650px;'>".
                    $this->Html->image('product_icons/'.$prodCarts[$i]['Product']['image'], array('alt' => 'CakePHP', 'class' => 'p_photo','style'=>'height:100%; width:12%; float:left;margin-bottom:25px;')) .
                    "<div class='infoPan' style='margin-bottom: 1.5%;'>".
                    "<p style='font-weight:bold; float:left; margin-left:2%;'>".'Name:&nbsp;'."</p >".
                    "<p style='width:60%; margin-bottom:0%; margin-right:0%;'> ".
                    $prodCarts[$i]['Product']['name'].
                    "</p>".
                    "<button id='deleteSaleButton'>".
                    "<a href=".$this->Html->url(array('controller' => 'sales','action' => 'delete', 'id'=>$prodCarts[$i]['Product']['id'])).">".
                    'Delete'.
                    "</a>".
                    "</button>".
                    "<div>"."</div>".
                    "<p style='font-weight:bold; float:left; margin-left:2%;'>".'Price:&nbsp;'."</p>".
                    "<p style='width:40%; margin-bottom:0%; margin-right:0%; float:left;' class='currency'> ".
                    $this->StringFormatter->formatCurrency($price , '$').
                    "</p>".
                    "<div>"."</div>".
                    "<br>".
                    "<br>".
                    "<p style='font-weight:bold; float:left; margin-left:2%;'>".'Amount:&nbsp;'."</p>".
                    "<p style='width:40%; margin-bottom:0%; margin-right:0%; float:left;'> ".
                    $numProducts[$i].
                    "</p>".
                    "<div>"."</div>".
                    "<br>".
                    "<br>".
                    "<p style='font-weight:bold; float:left; margin-left:14%;'>".'Total:&nbsp;'."</p>".
                    "<p style='width:40%; margin-bottom:0%; margin-right:0%; float:left;' class='currency'> ".
                    $this->StringFormatter->formatCurrency($price * $numProducts[$i], '$').
                    "</p>".
                    "<div>"."</div>".
                    "<br>".
                    "</div>".
                    "<div style='clear:both'></div>".
                    "<hr>".
                    "</div>";
            }
        }
        return $result_string.'</div>';
    }


    public function formatSaleFact($prodCarts, $numProducts, $currency) {
        echo $this->Html->css('catalogs');
        $result_string = '<div>';
        for($i = 1; $i < count($prodCarts); $i++) {
            if ( $numProducts[$i] > 0 ) {
			 if ($prodCarts[$i]['Product']['discount'] == 0) {
                    $price = $prodCarts[$i]['Product']['price'];
                } else {
                    $price = $prodCarts[$i]['Product']['price'] - ($prodCarts[$i]['Product']['price']*$prodCarts[$i]['Product']['discount'])/100;
                }
                $var = '$';
                if ($currency == "Colon") {
                    $price = $price * 539.37;
                    $var = '¢';
                } else if ($currency == "Euro") {
                    $price = $price * 0.80;
                    $var = '€';
                }
                $result_string = $result_string.
                    "<div class='cart_item' style='width: 650px;'>".
                    $this->Html->image('product_icons/'.$prodCarts[$i]['Product']['image'], array('alt' => 'CakePHP', 'class' => 'p_photo','style'=>'height:30%; width:8%; float:left;margin-bottom:25px;')) .
                    "<div class='infoPan' style='margin-bottom: 1%;'>".
                    "<p style='float:left; margin-left:2%;'>".$numProducts[$i].' units of '.$prodCarts[$i]['Product']['name']."</p >".
                    "<p style='float:left; margin-left:2%;'>".'&nbsp;'."</p>".
                    "<p style='width:40%; margin-bottom:0%; margin-right:0%; float:left;' class='currency'> ".
                    $this->StringFormatter->formatCurrency($price , $var).' p/u.'.
                    "</p>".
                    "<div>"."</div>".
                    "<br>".
                    "<br>".
                    "<p style='font-weight:bold; float:left; margin-left:2%;'>".'Total:&nbsp;'."</p>".
                    "<p style='width:40%; margin-bottom:0%; margin-right:0%; float:left;' class='currency'> ".
                    $this->StringFormatter->formatCurrency($price * $numProducts[$i], $var).
                    "</p>".
                    "</div>".
                    "<div style='clear:both'></div>".
                    "</div>";
            }
        }
        return $result_string.'</div>';
    }

    public function displayReviews($reviews, $limit = null)
    {
        echo $this->Html->css('catalogs');
        $result_string = '<div type="review" style="width:800px; margin:0 auto;">';

        if(count($reviews) > 0) {
            $result_string = $result_string . '<h3 style="margin-bottom: 35px;">Reviews for this product</h3>';
        }

        for($i = 0; $i < count($reviews); $i++) {
            if( $i < $limit || is_null($limit) ) {
                $namebox = "<span style='float:left;'>" . $reviews[$i]['User']['name'] . ":</span>";
                $ratingbox = "<div style='float:right;'>" . $this->displayRatingBox($reviews[$i]['Review']['rating']) . "</div>";
                if($reviews[$i]['Review']['description'] == 'null') {
                    $commentbox = "<p style='float:right; width:500px; min-height: 40px; margin-bottom: 50px;'></p>";
                }
                else {
                    if(strlen($reviews[$i]['Review']['description']) < 30) {
                        $commentbox = "<p style='float:right; width:500px; min-height: 40px; margin-bottom: 50px;'>" . $reviews[$i]['Review']['description'] . "</p>";
                    }
                    else {
                        $commentbox = "<p style='float:right; width:500px; min-height: 40px; margin-bottom: 50px;'>" . $reviews[$i]['Review']['description'] . "</p>";
                    }
                }
                $result_string = $result_string . "<div style='float:left; width:200px; height:140px;'>" . $namebox . $ratingbox . "</div>" . $commentbox . "<div style='clear:both'></div>";
            }
        }

        return $result_string . '</div>';

    }

    public function formatAddress($addresses, $limit = null)
    {
        echo $this->Html->css('catalogs');
        $result_string = '<div>';

        if(count($addresses)>0){
            for($i = 0; $i < count($addresses); $i++) {
                if( $i < $limit || is_null($limit) ) {
                    $result_string = $result_string."<div class='address_item'>".
                    "<input type='radio' name='addressSelector' style='margin-left:50%' value='".$addresses[$i]['Address']['id']."' class='addressSelect' id='".$addresses[$i]['Address']['id']."'>".
                    "<br>".
                    "<br>".
                    "<p style='font-weight:bold; display:inline;'>"."Country:"."</p>"."<p class='country' style='display:inline;'>".$addresses[$i]['Address']['country']."</p>".
                    "<br>".
                    "<br>".
                    "<p style='font-weight:bold; display:inline;'>"."State:"."</p>".$addresses[$i]['Address']['state']."</p>".
                    "<p style='font-weight:bold; display:inline;'>"."City:"."</p>".$addresses[$i]['Address']['city']."</p>".
                    "<p style='font-weight:bold; display:inline;'>"."Street:"."</p>".$addresses[$i]['Address']['street']."</p>".
                    "</div>";
                }
            }
        }

        $result_string = $result_string."<div style='clear:both'>"."</div>";

        return $result_string . '</div>';



    }

}



//$prod['Product'] : Array ( [id] => 1 [category_id] => 8 [name] => sandalias [price] => 2500.00 [quantity] => 14 [image] => placeholder [status] => [rating] => 3 )