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
            <p style="font-weight:bold;  margin-left:10%;">Bill Number:&nbsp;</p> <h1 style="font-size: 15px; margin-left:20%;"> <?php echo $this->Session->read('sale_id');  ?> </h1>
            <p style="font-weight:bold;  margin-left:10%;">Date:&nbsp;</p> <h1 style="font-size: 15px; margin-left:20%;"> <?php echo h($sale['Sale']['created']); ?> </h1>
            <p style="font-weight:bold;  margin-left:10%;">User:&nbsp;</p> <h1 style="font-size: 15px; margin-left:20%;"> <?php echo $this->Html->link($sale['User']['name'], array('controller' => 'users', 'action' => 'profile')); ?> </h1>
            <p style="font-weight:bold; margin-left:10%;">Delivery:&nbsp;</p>
            <div id="delivery" style = "margin-left:20%; margin-bottom:3%; font-size: 15px;">
                <h1> San Jose, Costa Rica </h1>
                <h1> 8 Street, 13 Avenue Garden's S.A </h1>
                <h1> 3 floor, Dep 12 </h1>
            </div>

            <p style="font-weight:bold;  margin-left:10%;">Payment Method:&nbsp;</p>
            <h1 style="font-size: 15px; margin-left:20%;"> 
                <?php echo h($payment_method['CreditCard']['brand']).' **'.$this->StringFormatter->formatCardLastNumbers($payment_method['CreditCard']['card_number']); ?> 
            </h1>

            <p style="font-weight:bold; margin-left:10%;margin-top:20px;">Products:&nbsp;</p>
            <div style="font-size: 15px; margin-left:20%;">
                 <div id="bodyCart">
                         <?php
                            if ( $totalCartProducts > 0 ) {
                                echo $this->CatalogGenerator->formatSaleFact($prodCarts, $numProducts );
                            }
                         ?>
                  </div>
            </div>

            
            <p style="font-weight:bold;  margin-left:10%;">Currency:&nbsp;</p> <h1 style="font-size: 15px; margin-left:20%;"> <?php echo h($sale['Sale']['currency']); ?> </h1>
            <p style="font-weight:bold;  margin-left:10%;">SubTotal:&nbsp;</p> <h1 style="font-size: 15px; margin-left:20%;"> <?php echo h($sale['Sale']['subtotal']); ?> </h1>
            <p style="font-weight:bold;  margin-left:10%;">Tax:&nbsp;</p> <h1 style="font-size: 15px; margin-left:20%;"> <?php echo h($sale['Sale']['tax']); ?> </h1>
            <p style="font-weight:bold;  margin-left:10%;">Frequenly Costumer Discount:&nbsp;</p> <h1 style="font-size: 15px; margin-left:20%;"> <?php echo h($sale['Sale']['frequenly_costumer_discount']); ?> </h1>
            <p style="font-weight:bold;  margin-left:10%;">Total:&nbsp;</p> <h1 style="font-size: 15px; margin-left:20%;"> <?php echo h($sale['Sale']['total']); ?> </h1>

    </div>
        <button id="PayButton" style = "float:left; margin-left:10%; margin-bottom:5%;">
           <a href=<?php echo $this->Html->url(array('controller' => 'sales','action' => 'viewPdf'))?>>Create PDF</a>
        </button>
    <tbody>
    <div style="clear:both"></div>

    <div id="foot"><?php echo $this->fetch('footer1'); ?></div>

</html>

