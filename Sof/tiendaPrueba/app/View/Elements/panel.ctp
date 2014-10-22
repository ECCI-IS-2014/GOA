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
    <button id="addWishListButton"><a href="<?php echo $this->Html->url(array('controller' => 'wishes','action' => 'add','id'=>$product['Product']['id']));?>"> Add to Wish List </a></button>
    <br>
    <button id="reviewButton"><a href=" <?php echo $this->Html->url(array("controller" => "products","action" => "addReview","id"=>"")).$product['Product']['id'];?>">Add Review</a></button>


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



<?php $this->start('home_panel'); ?>


   

    <div id="home_panel_wrapper">

      <div id="start" class="active">
        <div class="catalog_holder named">
          <h3>Hot</h3>
          <?php 
            echo $this->CatalogGenerator->formatProducts( $products, 12 ); 
          ?>
        </div>
        <div class="catalog_holder named">
          <h3>On sale</h3>
          <?php 
            echo $this->CatalogGenerator->formatProducts( $products, 18 ); 
          ?>
        </div>
        <div class="catalog_holder named">
          <h3>Top rated</h3>
          <?php 
            echo $this->CatalogGenerator->formatProducts( $products, 5 ); 
          ?>
        </div>
        <div class="catalog_holder named">
          <h3>Newly added</h3>
          <?php 
            echo $this->CatalogGenerator->formatProducts( $products, 8 ); 
          ?>
        </div>
        <div class="catalog_holder named">
          <h3>Our picks for you</h3>
          <?php 
            echo $this->CatalogGenerator->formatProducts( $products, 3 ); 
          ?>
        </div>
      </div>

      <div id="search_results" class="inactive">
        <div class="catalog_holder named">
          <h3>Your search results.</h3>
          <?php 
            echo $this->CatalogGenerator->formatProducts( $products ); 
          ?>
        </div>
      </div>

      <div id="loading" class="inactive">
        <img src="<?php echo $this->webroot; ?>img/loading.gif" class="loading_graphic">
      </div>

    </div>

    <script type="text/javascript">

      var activePanel = "start";

    </script>


<?php $this->end(); ?>
