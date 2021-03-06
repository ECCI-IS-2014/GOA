<?php $this->start('panel1'); ?>


   	<?php	echo $this->CatalogGenerator->formatProducts($products); ?>




<?php $this->end(); ?>
<?php /*TERMINA PANEL1*/ ?>





<?php $this->start('imagePanel'); ?>


  <div id="imageHolder"> <?php echo $this->Html->image('product_icons/'.$product['Product']['image'], array('alt' => 'cakePHP','style'=>'height:200px; width:200px;')); ?> </div>
    

    



<?php $this->end(); ?>

<?php /*TERMINA PANEL DE IMAGEN */ ?>

<?php $this->start('descriptionPanel'); ?>


   <p style="font-weight:bold; float:left; padding-left:3%;">Name:&nbsp;</p> <?php echo $product['Product']['name'];?>
   <div style="clear:both"></div>

   <?php if ($product['Product']['enable_product'] == 0) : ?>
        <p style="font-weight:bold;float:left; padding-left:3%; color: red;">THIS PRODUCT IS DISABLED</p> 
        <div style="clear:both"></div>
    <?php endif; ?>
   
    <?php if ($product['Product']['discount'] == 0) : ?>
		<p style="font-weight:bold;float:left; padding-left:3%;">Price:&nbsp;</p> <?php  echo $this->StringFormatter->formatCurrency($product['Product']['price'],'$');?>	
	<?php else: ?>
		<?php $price = $product['Product']['price'] - ($product['Product']['price']*$product['Product']['discount'])/100 ?>
		<p style="font-weight:bold;float:left; padding-left:3%;">Price:&nbsp;</p> <?php  echo "<span style='text-decoration:line-through;margin-right:5px;'>".$this->StringFormatter->formatCurrency($product['Product']['price'],'$')."</span>";?>	
		<?php  echo $this->StringFormatter->formatCurrency($price,'$');?>
		<?php  echo "<span style='font-weight:bold; font-size:12px; color:#006699; margin-left:5px;' >Discount: ".$product['Product']['discount']."%</span>" ;?>
	<?php endif; ?>
	<div style="clear:both"></div>
   
   <p style="font-weight:bold; float:left; padding-left:3%;">Quantity:&nbsp;</p> <?php  echo $product['Product']['quantity'];?>
   <div style="clear:both"></div>
   
   <p style="font-weight:bold;float:left; padding-left:3%;">Description:&nbsp;</p> <?php echo $product['Product']['description'];?>
   <div style="clear:both"></div>
   
   <p style="font-weight:bold;float:left; padding-left:3%;">Weight:&nbsp;</p> <?php  echo $this->StringFormatter->formatWeight($product['Product']['weight'],'kg');?>
   <div style="clear:both"></div>
   
   <?php if ($product['Product']['volume'] != 0) : ?>
	   <p style="font-weight:bold;float:left; padding-left:3%;">Volume:&nbsp;</p> <?php  echo $this->StringFormatter->formatVolume($product['Product']['volume'],'cm');?>
	   <div style="clear:both"></div>
   <?php endif; ?>
   
   <p style="font-weight:bold;float:left; padding-left:3%;">Rating:&nbsp;</p> <?php  echo $this->CatalogGenerator->displayRatingBox($product['Product']['rating']);?>
   <div style="clear:both"></div>

<?php $this->end(); ?>

<?php /*TERMINA PANEL DE DESCRIPCION DE PRODUCTO*/ ?>



<?php $this->start('optionsPanel'); ?>

    <div id="buttonHolder">
    <button id="addCartButton"><a href="<?php echo $this->Html->url(array('controller' => 'carts','action' => 'add','id'=>$product['Product']['id']));?>"> Add to Cart </a></button>
    <br>
    <button id="addWishListButton"><a href="<?php echo $this->Html->url(array('controller' => 'wishes','action' => 'add','id'=>$product['Product']['id']));?>"> Add to Wish List </a></button>
    <br>
    <?php
    $us=$this->Session->Read('Auth');
    $result = empty($us);
    if($result==false){
        echo ("<button id='reviewButton'><a href='".$this->Html->url(array("controller" => "reviews","action" => "verify_purchase","id"=>"")).$product['Product']['id']."'>Add Review</a></button>");
    }
   ?>

    </div>

<?php $this->end(); ?>


<?php /*TERMINA PANEL DE OPCIONES DE PRODUCTO*/ ?>



<?php $this->start('reviewsPanel'); ?>

    <?php echo $this->CatalogGenerator->displayReviews($reviews, 30 ); ?>


<?php $this->end(); ?>


<?php /*TERMINA PANEL DE OPCIONES DE REVIEWS*/ ?>



<?php $this->start('home_panel'); ?>


    <div id="home_panel_wrapper">

      <div id="start" class="active">
        <div id="hot_pane" class="catalog_holder named">
          <h3>Hot</h3>
          <?php 
            echo $this->CatalogGenerator->formatProducts( $products, 12 ); 
          ?>
        </div>
        <div id="sales_pane" class="catalog_holder named">
          <h3>On sale</h3>
          <?php 
            echo $this->CatalogGenerator->formatProducts( $products, 18 ); 
          ?>
        </div>
        <div id="top_rated_pane" class="catalog_holder named">
          <h3>Top rated</h3>
          <?php 
            echo $this->CatalogGenerator->formatProducts( $products, 5 ); 
          ?>
        </div>
        <div id="new_pane" class="catalog_holder named">
          <h3>Newly added</h3>
          <?php 
            echo $this->CatalogGenerator->formatProducts( $products, 8 ); 
          ?>
        </div>
        <div id="picks_pane" class="catalog_holder named">
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
            if($s_params['op'] == 'search') {
              echo $this->CatalogGenerator->formatProducts( $s_results );
            } 
          ?>
        </div>
      </div>

      <div id="loading" class="inactive">
        <img src="<?php echo $this->webroot; ?>img/loading.gif" class="loading_graphic">
      </div>

    </div>

    <script type="text/javascript">

      var activePanel = "start";
      var catalog_item_width = 174;   // Width of each element in catalog, including paddings and margins
      var catalog_item_height = 316;  // Height of each element in catalog, including paddings and margins

      //set sliders
      $(document).ready(function(){
        var hot_slider = new FutureSlider("#hot_pane div[type='catalog']", catalog_item_width, catalog_item_height);
        var sales_slider = new FutureSlider("#sales_pane div[type='catalog']", catalog_item_width, catalog_item_height);
        var top_rated_slider = new FutureSlider("#top_rated_pane div[type='catalog']", catalog_item_width, catalog_item_height);
        var new_slider = new FutureSlider("#new_pane div[type='catalog']", catalog_item_width, catalog_item_height);
        var picks_slider = new FutureSlider("#picks_pane div[type='catalog']", catalog_item_width, catalog_item_height);

        var slider_interval = window.setInterval(function(){
            if(hot_slider.isSliding != true && hot_slider.completedSliding != true) {
                hot_slider.moveForward();
            }
            if(sales_slider.isSliding != true && hot_slider.completedSliding != true) {
                sales_slider.moveForward();
            }
            if(top_rated_slider.isSliding != true && hot_slider.completedSliding != true) {
                top_rated_slider.moveForward();
            }
            if(new_slider.isSliding != true && hot_slider.completedSliding != true) {
                new_slider.moveForward();
            }
            if(picks_slider.isSliding != true && hot_slider.completedSliding != true) {
                picks_slider.moveForward();
            }
        }, 3500);


        //Hot slider manual events
        $("#hot_pane.catalog_holder").mousemove(function(e){
            if ((e.pageX - $(this).offset().left) < $(this).width() / 5) {
                hot_slider.startSlidingLeft();
            }
            else {
                if ((e.pageX - $(this).offset().left) > ($(this).width() / 5)*4) {
                    hot_slider.startSlidingRight();
                }
                else {
                    hot_slider.stopSliding();
                }
            }
        });

        $("#hot_pane.catalog_holder").mouseleave(function(){
            hot_slider.stopSliding();
        });


        //Sales slider manual events
        $("#sales_pane.catalog_holder").mousemove(function(e){
            if ((e.pageX - $(this).offset().left) < $(this).width() / 5) {
                sales_slider.startSlidingLeft();
            }
            else {
                if ((e.pageX - $(this).offset().left) > ($(this).width() / 5)*4) {
                    sales_slider.startSlidingRight();
                }
                else {
                    sales_slider.stopSliding();
                }
            }
        });

        $("#sales_pane.catalog_holder").mouseleave(function(){
            sales_slider.stopSliding();
        });


        //Top rated slider manual events
        $("#top_rated_pane.catalog_holder").mousemove(function(e){
            if ((e.pageX - $(this).offset().left) < $(this).width() / 5) {
                top_rated_slider.startSlidingLeft();
            }
            else {
                if ((e.pageX - $(this).offset().left) > ($(this).width() / 5)*4) {
                    top_rated_slider.startSlidingRight();
                }
                else {
                    top_rated_slider.stopSliding();
                }
            }
        });

        $("#top_rated_pane.catalog_holder").mouseleave(function(){
            top_rated_slider.stopSliding();
        });


        //Newly added slider manual events
        $("#new_pane.catalog_holder").mousemove(function(e){
            if ((e.pageX - $(this).offset().left) < $(this).width() / 5) {
                new_slider.startSlidingLeft();
            }
            else {
                if ((e.pageX - $(this).offset().left) > ($(this).width() / 5)*4) {
                    new_slider.startSlidingRight();
                }
                else {
                    new_slider.stopSliding();
                }
            }
        });

        $("#new_pane.catalog_holder").mouseleave(function(){
            new_slider.stopSliding();
        });


        //Our picks slider manual events
        $("#picks_pane.catalog_holder").mousemove(function(e){
            if ((e.pageX - $(this).offset().left) < $(this).width() / 5) {
                picks_slider.startSlidingLeft();
            }
            else {
                if ((e.pageX - $(this).offset().left) > ($(this).width() / 5)*4) {
                    picks_slider.startSlidingRight();
                }
                else {
                    picks_slider.stopSliding();
                }
            }
        });

        $("#picks_pane.catalog_holder").mouseleave(function(){
            picks_slider.stopSliding();
        });

      });

      

    </script>


<?php $this->end(); ?>
