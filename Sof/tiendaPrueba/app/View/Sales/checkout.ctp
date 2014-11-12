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
         <?php echo $this->Html->css('facture'); ?>
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

    <div id="contentF">

            <!-- delivery address image -->
            <img src = "http://i.imgur.com/jYNSZ38.png" />
            <div id = "text">

                    <h1> San Jose, Costa Rica </h1>
                    <h1> 8 Street, 13 Avenue Garden's S.A  </h1>
                    <h1> 3 floor, Dep 12  </h1>
                    <div class="link"><?php echo $this->Html->link(__('Change Address'), array('action' => '')); ?> </div>
            </div>
            <br/>

            <!-- payment method image -->
            <img src = "http://i.imgur.com/oOHHzdb.png" />
            <div id = "text">
                <h1> Please choose a payment method</h1>
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

                <h1> or </h1>
                <div class="link"><?php echo $this->Html->link(__('Add New Credit Card'), array('controller' => 'credit_cards', 'action' => 'add')); ?></div>
                <br/>
                <!-- type of coin -->
                <br/>
                <h1> Please choose the type of coin you want to pay with</h1>

                <select name="currency" id="currency">
                    <option value="1">Dollar</option>
                    <option value="2">Euro</option>
                    <option value="3">Colon</option>
                </select >

                <br/>
            </div>

            <!-- products image -->
            <img src = "http://i.imgur.com/Tm3qbhM.png"  />
            <div id="bodyCart">
                <?php
                if ( $totalCartProducts > 0 ) {
                    echo $this->CatalogGenerator->formatSale($prodCarts, $numProducts );
                }
                ?>
            </div>

             <div id = "total">
                <p><b>Sub Total: </b></p>
                <p class="currency"><?php echo $this->StringFormatter->formatCurrency( $total, '$'); ?></p>
                <br/><br/>

                <p><b>Tax: </b></p>
                <p class="currency"><?php echo $this->StringFormatter->formatCurrency( $tax, '$'); ?></p>
                <br/><br/>

                <p><b>Total: </b></p>
                <p class="currency"><?php echo $this->StringFormatter->formatCurrency( $endTotal, '$'); ?></p>
                <br/><br/>

            </div>

            <h1 style="font-size: 16px; text-align: left; margin-left:4%;">
                By clicking on the "Pay" button, you agree on FutureStore's conditions of use.
            </h1>
            <input id="PayButton" style = "float:left; margin-bottom:5%; margin-left:4%;"type="submit" value="Pay"/>

            </form>


    </div>

    <div style="clear:both"></div>

    <div id="foot"><?php echo $this->fetch('footer1'); ?></div>

</html>