<?php $this->start('panel1'); ?>


   	<?php	echo $this->CatalogGenerator->formatProducts($products); ?>




<?php $this->end(); ?>
<?php /*TERMINA PANEL1*/ ?>





<?php $this->start('imagePanel'); ?>


  <div id="imageHolder"> <?php echo $this->Html->image('product_icons/'.$product['Product']['image'], array('alt' => 'cakePHP','style'=>'height:20%; width:100%;')); ?> </div>
    

    



<?php $this->end(); ?>

<?php /*TERMINA PANEL DE IMAGEN */ ?>

<?php $this->start('descriptionPanel'); ?>


   <p style="font-weight:bold; float:left; padding-left:3%;">Name:</p> <?php echo $product['Product']['name'];?>
   <div style="clear:both"></div>
   <p style="font-weight:bold; float:left; padding-left:3%;">Quantity:</p> <?php   echo $product['Product']['quantity'];?>
   <div style="clear:both"></div>
   <p style="font-weight:bold;float:left; padding-left:3%;">Description:</p> <?php echo $product['Product']['description'];?>
   <div style="clear:both"></div>
   <p style="font-weight:bold;float:left; padding-left:3%;">Price:</p> <?php  echo $this->StringFormatter->formatCurrency($product['Product']['price'],'$');?>
   <div style="clear:both"></div>
   <p style="font-weight:bold;float:left; padding-left:3%;">Rating:</p> <?php  echo $this->CatalogGenerator->displayRatingBox($product['Product']['rating']);?>
   <div style="clear:both"></div>






<?php $this->end(); ?>

<?php /*TERMINA PANEL DE DESCRIPCION DE PRODUCTO*/ ?>

<?php $this->start('optionsPanel'); ?>

    <div id="buttonHolder">
    <button id="addCartButton">Add to Cart</button>
    <br>
    <button id="addWishListButton">Add to Wish List</button>
    <br>
    <button id="reviewButton"><a href='<?php echo $this->Html->url(array("controller" => "products","action" => "addReview","id"=>"")).$product['Product']['id']?>'>Add Review</a></button>


    </div>

<?php $this->end(); ?>


<?php /*TERMINA PANEL DE OPCIONES DE PRODUCTO*/ ?>



<?php $this->start('reviewsPanel'); ?>

    Reviews

    <div id = "OtherUsersReviewsPanel">



    </div>

    <div id="addReviewPanel">



    </div>


<?php $this->end(); ?>


<?php /*TERMINA PANEL DE OPCIONES DE REVIEWS*/ ?>



