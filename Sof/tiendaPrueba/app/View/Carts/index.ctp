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
                if (count($prodCarts) > 1) {
                        echo $this->CatalogGenerator->formatCart($prodCarts, $numProducts, 30 );
                } else { ?>

                     <div>
                        <h1 style="font-size: 18px; text-align: center;"> Your Cart is empty in this moment, what are you waiting to add some items!<h1>
                         <h1 style="font-size: 18px; text-align: center;"><img src = "http://38.media.tumblr.com/4dac6ca3430c92d2a5a43eb61fbdcf32/tumblr_mtz3voMiz21qhy6c9o1_500.gif" /><h1>
                     </div>

                <?php } ?>

                <div id="total">
                    <b>Total: </b>
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

            </div>

        </div>

    </div>

    <div id="foot"> <?php echo $this->fetch('footer1'); ?>  </div>
</html>