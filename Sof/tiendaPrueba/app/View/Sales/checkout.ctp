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
    </head>

    <div id="head"> <?php echo $this->fetch('header1'); ?> </div>

    <div style = "margin-left:5%;>
        <h1 style="font-size: 18px; text-align: left;"> Review Your Order<h1>
        <h3 style="font-size: 18px; text-align: left;"> By clicking on "Pay" button, you agree on FutureStore in the conditions of use. <h2>
    </div>
  <div class="actions" style = "margin-left:3%;">
                    <ul>
                        <!-- delivery address image -->
                        <img src = "http://i.imgur.com/jYNSZ38.png" />
                        <h1 style="font-size: 15px; text-align: left;"> San Jose, Costa Rica <h1>
                        <h1 style="font-size: 15px; text-align: left;"> 8 Street, 13 Avenue Garden's S.A  <h1>
                        <h1 style="font-size: 15px; text-align: left;"> 3 floor, Dep 12  <h1>
                        <li><?php echo $this->Html->link(__('Change Address'), array('action' => '')); ?> </li>
                        <!-- payment method image -->
                        <img src = "http://i.imgur.com/oOHHzdb.png" />
                           <!-- for que muestre todas las tarjetas del user -->
                           <p style="font-size: 15px; text-align: left;"> Credit Card <p> <select name="example">
                               <option value="A">1-***********4563</option>
                               <option value="B">1-***********4563</option>
                               <option value="-">1-***********4563</option>
                           </select>
                           <!-- -->

                         <li><?php echo $this->Form->postLink(__('Add other'), array('action' => '')); ?> </li>
                     </ul>
                        <!-- products image -->
                        <img src = "http://i.imgur.com/Tm3qbhM.png" />
   </div>

    <div id="content">

        <div id="content_wrapper" style="position:relative;">

            <div id="bodyCart">
                <?php
                if ( $totalCartProducts > 0 ) {

                    echo $this->CatalogGenerator->formatSale($prodCarts, $numProducts, 30 );

                } else { ?>


                <?php } ?>

                <div id="total">
                    <b>Sub Total: </b>
                    <?php
                        $total = 0;
                        if (count($prodCarts) > 1) {
                            for($i = 1; $i < count($prodCarts); $i++) {
                                $total = $total + $prodCarts[$i]['Product']['price'] * $numProducts[$i];
                            }
                        }
                        echo $this->StringFormatter->formatCurrency( $total, '$');
                    ?>
                </div>
                <div id="total">
                    <b>Tax: </b>
                    <?php
                        $withoutTax = $total/13;
                        echo $this->StringFormatter->formatCurrency( $withoutTax, '$');
                    ?>
                </div>
                <div id="total">
                    <b>Total: </b>
                    <?php
                        $tax= 0.0;
                        $endTotal = $total + $withoutTax;
                        echo $this->StringFormatter->formatCurrency( $endTotal, '$');
                    ?>
                </div>
                <div>
                <button id="PayButton" style = "float:left; margin-left:50%; margin-bottom:5%;">
                    <a href="$this->Html->url(array('controller' => 'sales','action' => 'add', "1" ))">Pay</a>
                </button>
                 </div>

        </div>


    </div>

    <div style="clear:both"></div>

    <div id="foot"><?php echo $this->fetch('footer1'); ?></div>

</html>