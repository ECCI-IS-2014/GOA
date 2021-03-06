<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->element('footers'); ?>
        <?php echo $this->element('headers'); ?>
        <?php echo $this->element('panel'); ?>
        <?php echo $this->element('button'); ?>
        <?php echo $this->element('sidebar'); ?>
        <?php echo $this->Html->css('sidebar'); ?>
        <?php echo $this->Html->css('footers'); ?>
        <?php echo $this->Html->css('headers'); ?>
        <?php echo $this->Html->css('panel'); ?>
        <?php echo $this->Html->css('button'); ?>
        <?php echo $this->Html->css('catalogs'); ?>
    </head>
	
    <div id= "head"> <?php echo $this->fetch('header1'); ?> </div>

    <div id="content">

        <div id="content_wrapper" style="position:relative;">
            
            <div id="bodyCart">
                <?php
                if ( $totalCartProducts > 0 ) {
                    
                    echo $this->CatalogGenerator->formatCart($prodCarts, $numProducts, 30 );
                    
                } else { ?>

                    <div>
                        <br/>
                        <h1 style="font-size: 18px; text-align: center;">
                            Your Cart is empty at the moment, what are you waiting to add some items?!
                        </h1>
                        <div style="font-size: 18px; text-align: center;"><img src = "http://i.imgur.com/P7ssHqI.gif" /></div>
                    </div>

                <?php } ?>

                <div id="total">
                    <b>Total: </b>
                    <?php 
                        $total = 0;
                        if (count($prodCarts) > 1) {
                            for($i = 1; $i < count($prodCarts); $i++) {
                                if ($prodCarts[$i]['Product']['discount'] == 0) {
                                    $price = $prodCarts[$i]['Product']['price'];
                                } else {
                                    $price = $prodCarts[$i]['Product']['price'] - ($prodCarts[$i]['Product']['price']*$prodCarts[$i]['Product']['discount'])/100;
                                }
                                $total = $total + $price * $numProducts[$i];
                            }
                        }
                        echo $this->StringFormatter->formatCurrency( $total, '$'); 
                    ?>
                </div>

                <?php if ( $totalCartProducts > 0 ): ?>
                <div>
                    <button id="PayButton" style = "float:left; margin-left:50%; margin-bottom:5%;">
                        <a href=<?php  echo $this->Html->url(array('controller' => 'sales','action' => 'checkout')); ?>>Check Out</a>
                    </button>
                </div>
                <?php endif ?>

            </div>

        </div>

    </div>

    <div id="foot"> <?php echo $this->fetch('footer1'); ?>  </div>
</html>