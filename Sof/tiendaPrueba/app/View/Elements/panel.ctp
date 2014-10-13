<?php $this->start('panel1'); ?>


   	<?php	echo $this->CatalogGenerator->formatProducts($products); ?>




<?php $this->end(); ?>
<?php /*TERMINA PANEL1*/ ?>





<?php $this->start('imagePanel'); ?>

<<<<<<< Updated upstream
    <img src=<?php echo $product['Product']['image'];?>>

=======
   <?php echo $this->Html->image('product_icons/'.$product['Product']['image'], array('alt' => 'cakePHP')); ?>
    
>>>>>>> Stashed changes


<?php $this->end(); ?>

<?php /*TERMINA PANEL DE IMAGEN */ ?>

<?php $this->start('descriptionPanel'); ?>


   <p style="font-weight:bold; float:left">Name:</p> <?php echo $product['Product']['name'];?>
   <div style="clear:both"></div>
   <p style="font-weight:bold; float:left">Price:</p> <?php   echo $product['Product']['price'];?>
   <div style="clear:both"></div>
   <p style="font-weight:bold;float:left">Description:</p> <?php echo $product['Product']['description'];?>
   <div style="clear:both"></div>
   <p style="font-weight:bold;float:left">Quantity:</p> <?php  echo $product['Product']['quantity'];?>
   <div style="clear:both"></div>







<?php $this->end(); ?>

<?php /*TERMINA PANEL DE DESCRIPCION DE PRODUCTO*/ ?>

<?php $this->start('optionsPanel'); ?>

    <div id="buttonHolder">

    <button id="addCartButton">Add to Cart</button>
    <button id="addWishButton">Add to Wish List</button>

    </div>

<?php $this->end(); ?>


<?php /*TERMINA PANEL DE OPCIONES DE PRODUCTO*/ ?>



<?php $this->start('reviewsPanel'); ?>


REVIEWS


<?php $this->end(); ?>


<?php /*TERMINA PANEL DE OPCIONES DE REVIEWS*/ ?>



