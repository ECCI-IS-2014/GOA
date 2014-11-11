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

    <?php
        $total = 0;
        if (count($prodCarts) > 1) {
            for($i = 1; $i < count($prodCarts); $i++) {
                $total = $total + $prodCarts[$i]['Product']['price'] * $numProducts[$i];
            }
        }
        $tax = $total/13;
        $endTotal = $total + $tax;
    ?>

    <div id="head"> <?php echo $this->fetch('header1'); ?> </div>

    <div id="content">

        <div id="content_wrapper" style="position:relative; margin-left:3%;">

            <!-- delivery address image -->
            <img src = "http://i.imgur.com/jYNSZ38.png" />
            <h1 style="font-size: 15px; text-align: left;"> San Jose, Costa Rica </h1>
            <h1 style="font-size: 15px; text-align: left;"> 8 Street, 13 Avenue Garden's S.A  </h1>
            <h1 style="font-size: 15px; text-align: left;"> 3 floor, Dep 12  </h1>
            <div class="link"><?php echo $this->Html->link(__('Change Address'), array('action' => '')); ?> </div>

            <br/>

            <!-- payment method image -->
            <img src = "http://i.imgur.com/oOHHzdb.png" />
            <p style="font-size: 15px; text-align: left;"> Please choose a payment method</p> 
            
            <form method="post" action="<?php echo $this->Html->url(array('controller' => 'sales','action' => 'add', $total,  $tax,  $endTotal ))?>" class="checkout">

                <select name="cards">   
                <?php
                    $cards = ClassRegistry::init('CreditCard')->listUserCreditCards($this->Session->read('Auth.User.id'));
                    $this->set(compact('cards'));
                    foreach ($cards as $id=>$card) {
                        echo '<option value = "' . $id . '">' . $card . '</option>';
                    }
                ?>
                </select>
            

                <p style="font-size: 14px; text-align: left;margin-top:10px;"> or<p> 
                <div class="link"><?php echo $this->Html->link(__('Add New Credit Card'), array('controller' => 'credit_cards', 'action' => 'add')); ?>
                </div>

                <br/>

                <!-- products image -->
                <img src = "http://i.imgur.com/Tm3qbhM.png"  />
                <div id="bodyCart">
                    
                    <?php
                    if ( $totalCartProducts > 0 ) {
                        echo $this->CatalogGenerator->formatSale($prodCarts, $numProducts );
                    } 
                    ?>

                </div>

                <div id ='total'>
                    <b>Sub Total: </b> <?php echo $this->StringFormatter->formatCurrency( $total, '$'); ?>
                    <br/><br/>
                    <b>Tax: </b> <?php echo $this->StringFormatter->formatCurrency( $tax, '$'); ?>
                    <br/><br/>
                    <b>Total: </b> <?php echo $this->StringFormatter->formatCurrency( $endTotal, '$'); ?>
                </div>
                
                <br/>
                <h3 style="font-size: 18px; text-align: left; margin-left:4%;">
                    By clicking on the "Pay" button, you agree on FutureStore's conditions of use.
                </h3>
                <input id="PayButton" style = "float:left; margin-bottom:5%; margin-left:4%;"type="submit" value="Pay"/>

            </form>

        </div>

    </div>

    <div style="clear:both"></div>

    <div id="foot"><?php echo $this->fetch('footer1'); ?></div>

</html>