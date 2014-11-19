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
                 $price = $prodCarts[$i]['Product']['price'] - ($prodCarts[$i]['Product']['price']*$prodCarts[$i]['Product']['discount'])/100;
                $total = $total + $price * $numProducts[$i];
            }
        }
        $tax = $total*0.13;
        if($fclient){
            $Frequenly_Costumer_Discount=$total*0.10;
        }else{
            $Frequenly_Costumer_Discount=0;
        }
        $endTotal = $total + $tax - $Frequenly_Costumer_Discount;
    ?>

    <div id="head"> <?php echo $this->fetch('header1'); ?> </div>

    <div id="contentF">

            <!-- delivery address image -->
            <img src = "http://i.imgur.com/jYNSZ38.png" />
            <div id = "adressHugher">
                   <!-- <h1 style = "font-weight: bold;"> To continue with your order, please select a delivery place. </h1>
                    <h1> San Jose, Costa Rica </h1>
                    <h1> 8 Street, 13 Avenue Garden's S.A  </h1>
                    <h1> 3 floor, Dep 12  </h1>
                    <div class="link"><?php echo $this->Html->link(__('Change Address'), array('action' => '')); ?> </div>
                    -->
                  <?php  echo $this->CatalogGenerator->formatAddress($addresses, null); ?>


            </div>
            <br/>

            <form method="post" action="<?php echo $this->Html->url(array('controller' => 'sales','action' => 'add', $total,  $tax, $Frequenly_Costumer_Discount,  $endTotal ))?>" class="checkout">

                <!-- payment method image -->
                <img src = "http://i.imgur.com/oOHHzdb.png" />
                <div id="text">
                    <h1 style = "font-weight: bold;"> To continue with your order, please select a method of payment. </h1>
                    <h1> We are pleased to accept: </h1>
                    <img src = "http://i.imgur.com/CM6REpc.png" />
                    <br>
                    <h1> You can select one of your credit cards, or add a new credit card. </h1>

                    <select name="cards">
                        <?php
                            $cards = ClassRegistry::init('CreditCard')->listUserCreditCards($this->Session->read('Auth.User.id'));
                            $this->set(compact('cards'));
                            foreach ($cards as $id=>$card) {
                                echo '<option value = "' . $id . '">' . $card . '</option>';
                            }
                        ?>
                    </select>
                    <br/><br/>
                    <div class="link" style = "float: left;"><?php echo $this->Html->link(__('Add New Card'), array('controller' => 'credit_cards', 'action' => 'add')); ?></div>
                    
                    <!-- type of coin -->
                    <br/><br/><br/>
                    <h1 style = "font-weight: bold;">  Please choose the type of coin you want to pay with. </h1>
                    <select name="currency" id="currency">
                        <option value="1">Dollar</option>
                        <option value="2">Euro</option>
                        <option value="3">Colon</option>
                    </select >
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

                <div id = "total">
                    <p><b>Sub Total: </b></p>
                    <p class="currency"><?php echo $this->StringFormatter->formatCurrency( $total, '$'); ?></p>
                    <br/><br/>

                    <p><b>Tax: </b></p>
                    <p class="currency"><?php echo $this->StringFormatter->formatCurrency( $tax, '$'); ?></p>
                    <br/><br/>

                    <p><b>Frequent Customer Discount: </b></p>
                    <p class="currency"><?php echo $this->StringFormatter->formatCurrency( $Frequenly_Costumer_Discount, '$'); ?></p>
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