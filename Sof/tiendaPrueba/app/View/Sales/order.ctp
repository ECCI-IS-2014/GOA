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

    <?php if (count($allSales) > 0) { ?>
        <?php foreach ($allSales as $sale): ?>
        <div class="bill" style = "margin-left:5%;">
            <!-- codigo -->
            <?php
                $currency = h($sale['Sale']['currency']);

                $symbol = '$';
                if($currency == 'Euro') {
                    $symbol = '€';
                } else {
                    if($currency == 'Colon') {
                        $symbol = '¢';
                    }
                }
            ?>

            <img src = "http://i.imgur.com/izLAJTe.png" />
            <p style="font-weight:bold;  margin-left:10%;">Order Status of bill number:&nbsp;  <?php echo h($sale['Sale']['id']); ?>
            <p style="font-weight:bold;  margin-left:10%;">Date:&nbsp; <?php echo h($sale['Sale']['created']); ?>
            <p style="font-weight:bold; margin-left:10%;margin-top:20px;">Products:&nbsp;</p>
            <div style="font-size: 15px; margin-left:20%;">
                 <div id="bodyCart">
                    <?php

                        $currency =   h($sale['Sale']['currency']);
                        $aux = $allProdBySales;
                        foreach ($aux as $prod):
                              if (h($prod['Sale']['id'])== h($sale['Sale']['id'])) {
                                 //echo h($prod['ProductSale']['id']);

                                    if (h($prod['ProductSale']['discount']) == 0) {
                                         $price = h($prod['ProductSale']['price']);
                                     } else {
                                         $price = h($prod['ProductSale']['price']) - (h($prod['ProductSale']['price'])*h($prod['ProductSale']['discount']))/100;
                                     }
                                     $var = '$';
                                     if ($currency == "Colon") {
                                         $price = $price * 539.37;
                                         $var = '¢';
                                     } else if ($currency == "Euro") {
                                         $price = $price * 0.80;
                                         $var = '€';
                                     }
                                     ?>
                                         <div class="cart_item" style="width: 650px;">
                                            <?php
                                                echo $this->Html->image('product_icons/'.h($prod['Product']['image']), array('alt' => 'CakePHP', 'class' => 'p_photo','style'=>'height:30%; width:8%; float:left;margin-bottom:25px;'));
                                            ?>
                                         <div class="infoPan" style="margin-bottom: 1%;">
                                         <p style="float:left; margin-left:2%;"> <?php echo $prod['ProductSale']['quantity'] ?> &nbsp units</p >

                                         <p style="width:40%; margin-bottom:0%; margin-right:0%; float:left;" class="currency">
                                                <?php echo ",&nbsp&nbsp".$this->StringFormatter->formatCurrency($price , $var)." p/u."; ?>
                                         </p>
                                         <div></div>
                                         <br><br>
                                         <p style="font-weight:bold; float:left; margin-left:2%;">Total:&nbsp</p>
                                         <p style="width:40%; margin-bottom:0%; margin-right:0%; float:left;" class="currency">
                                         <?php echo $this->StringFormatter->formatCurrency($price * $prod['ProductSale']['quantity'], $var); ?></p>
                                          </div>
                                         <div style='clear:both'></div>
                                         </div>
                                    <?php
                              }
                        endforeach;
                       /*if ( $totalCartProducts > 0 ) {
                           echo $this->CatalogGenerator->formatSaleFact($prodCarts, $numProducts, $currency);
                       }*/
                    ?>
                 </div>
            </div>
            <p style="font-weight:bold;  margin-left:10%;">Total:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;  <?php echo $symbol .h($sale['Sale']['total']); ?> </p>
            <h1 style="margin-left:9%;margin-top:10px;"><img src = "http://i.imgur.com/PYPOkLu.png" /><h1>

             <?php if  (h($sale['Sale']['tracking'])== "Not dispatched") { ?>

                 <p style=" margin-left:10%;margin-top:20px;"> <b/>Right now:</b>  Not Dispatched. Packing installations FutureStore. &nbsp;</p>
                 <p style=" margin-left:10%;margin-top:20px;"><b>Next installment:</b> Arrival at a mailBox. &nbsp;</p>
                <h1 style="margin-left:10%;"><img src = "http://i.imgur.com/qIoXxXY.png" /><h1>
              <?php } elseif  (h($sale['Sale']['tracking'])== "mailBox") { ?>
                   <p style=" margin-left:10%;margin-top:20px;"> <b/>Right now:</b>  Arrival at a mailBox.  &nbsp;</p>
                   <p style=" margin-left:10%;margin-top:20px;"><b>Next installment:</b> Committed. Arrival at a regional hub near destination. &nbsp;</p>
                   <h1 style="margin-left:10%;"><img src = "http://i.imgur.com/MQ6iaEr.png" /><h1>
             <?php } else { ?>
                   <p style=" margin-left:10%;margin-top:20px;"> <b/>Right now:</b>  Committed.  &nbsp;</p>
                   <h1 style="margin-left:10%;"><img src = "http://i.imgur.com/Cbmllcx.png" /><h1>
             <?php }?>
        </div>
     <?php endforeach; ?>
    <?php } else { ?>
      <h1 style="font-size: 18px; text-align: center;"> You haven't ordered anything yet. Go choose something you like! <h1>
      <h1 style="font-size: 18px; text-align: center;"><img src = "http://i.imgur.com/ogQxWJu.gif" /><h1>
    <?php }  ?>
    <div style="clear:both"></div>

    <div id="foot"><?php echo $this->fetch('footer1'); ?></div>

</html>
