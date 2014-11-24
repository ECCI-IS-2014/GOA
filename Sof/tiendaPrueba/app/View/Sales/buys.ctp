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

         <?php echo $this->Html->css('checkout'); ?>
         <?php echo $this->Html->script('currency'); ?>
    </head>

    <div id="head"> <?php echo $this->fetch('header1'); ?> </div>

    <div class="bill" style = "margin-left:25%;">
            <img src = "http://i.imgur.com/izLAJTe.png" />
            <p style="font-weight:bold;  margin-left:10%;">Bill Number:&nbsp; <?php echo $this->Session->read('sale_id');?></p>
            <p style="font-weight:bold;  margin-left:10%;">Date:&nbsp; <?php echo h($sale['Sale']['created']); ?>
            <p style="font-weight:bold;  margin-left:10%;">User:&nbsp; <?php echo h($sale['User']['name']); ?> <?php echo $this->Session->read('Auth.User.last_name'); ?> </p>
            <p style="font-weight:bold; margin-left:10%;">Delivery:&nbsp;</p>
            <div id="delivery" style = "margin-left:20%; margin-bottom:3%; font-size: 15px;">
                <h1> <p style="display:inline; font-weight:bold">Country:&nbsp</p><?php echo $address['Address']['country'];?></h1>
                <h1> <p style="display:inline;font-weight:bold">City:&nbsp</p><?php echo $address['Address']['city'];?></h1>
                <h1> <p style="display:inline;font-weight:bold">State:&nbsp</p><?php echo $address['Address']['state'];?></h1>
                <h1> <p style="display:inline;font-weight:bold">Street:&nbsp</p><?php echo $address['Address']['street'];?></h1>
            </div>

            <p style="font-weight:bold;  margin-left:10%;">Payment Method:&nbsp;</p>
            <h1 style="font-size: 15px; margin-left:20%;"> 
                Credit Card: <?php echo h($payment_method['CreditCard']['brand']).'<br> Last 4 numbers: '.$this->StringFormatter->formatCardLastNumbers($payment_method['CreditCard']['card_number']);
                //echo h($sale['Sale']['address_id']);
                ?>
            </h1>

            <p style="font-weight:bold; margin-left:10%;margin-top:20px;">Products:&nbsp;</p>
            <div style="font-size: 15px; margin-left:20%;">
                <div id="bodyCart">
                    <?php
                        $currency =   h($sale['Sale']['currency']);
                        if ( $totalCartProducts > 0 ) {
                           echo $this->CatalogGenerator->formatSaleFact($prodCarts, $numProducts, $currency);
                        }
                    ?>
                </div>
            </div>
            <?php
                $currency = h($sale['Sale']['currency']);

                $symbol = '$';
                if($currency == 'Euro') {
                    $symbol = '€';
                } elseif($currency == 'Colon') {
                    $symbol = '¢';
                }
            ?>
            <?php

            ?>
            <p style="font-weight:bold;  margin-left:10%;">Currency:&nbsp;   <?php echo h($sale['Sale']['currency']); ?> </p>
            <p style="font-weight:bold;  margin-left:10%;">SubTotal:&nbsp; <?php echo $symbol . h($sale['Sale']['subtotal']); ?></p>
            <p style="font-weight:bold;  margin-left:10%;">Shipping:&nbsp; <?php echo $symbol . h($sale['Sale']['shipping']); ?></p>
            <p style="font-weight:bold;  margin-left:10%;">Tax:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo '+'.$symbol .h($sale['Sale']['tax']); ?></p>
            <p style="font-weight:bold;  margin-left:10%;">Frequent Customer Discount:&nbsp;</p> <h1 style="font-size: 15px; margin-left:19%;font-weight:bold;"> <?php echo '-'.$symbol .h($sale['Sale']['frequenly_costumer_discount']); ?> </h1>
            <p style="font-weight:bold;  margin-left:10%;">Total:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <?php echo $symbol .h($sale['Sale']['total']); ?> </p>

    </div>

    <button id="PayButton" style = "float:left; margin-left:50%; margin-bottom:5%;">
       <a href=<?php echo $this->Html->url(array('controller' => 'sales','action' => 'viewPdf'))?>>Create PDF</a>
    </button>
    
    <div style="clear:both"></div>

    <div id="foot"><?php echo $this->fetch('footer1'); ?></div>

</html>

