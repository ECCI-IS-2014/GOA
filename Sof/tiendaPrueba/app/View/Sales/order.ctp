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
                       if ( $totalCartProducts > 0 ) {
                           echo $this->CatalogGenerator->formatSaleFact($prodCarts, $numProducts, $currency);
                       }
                    ?>
                 </div>
            </div>
            <p style="font-weight:bold;  margin-left:10%;">Total:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;  <?php echo $symbol .h($sale['Sale']['total']); ?> </p>
            <p style="font-weight:bold; margin-left:10%;margin-top:20px; color: #6f9aff;"> Track of your order: &nbsp;</p>
            <p style=" margin-left:10%;margin-top:20px;"> <b/>Right now:</b> Packing installations FutureStore Laboratory 105.&nbsp;</p>
              <p style=" margin-left:10%;margin-top:20px;"> <b>Next installment:</b> Arrival at a regional hub near destination. &nbsp;</p>
        </div>
     <?php endforeach; ?>
    <?php } else { ?>
      <h1 style="font-size: 18px; text-align: center;"> You haven't ordered anything yet. Go and choose something you like!<h1>
      <!--<h1 style="font-size: 18px; text-align: center;"><img src = "http://i.imgur.com/ogQxWJu.gif" /><h1>-->
    <?php }  ?>
    <div style="clear:both"></div>

    <div id="foot"><?php echo $this->fetch('footer1'); ?></div>

</html>
