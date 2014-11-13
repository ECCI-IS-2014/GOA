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
             <?php echo $this->Html->css('home'); ?>
             <?php echo $this->Html->script('jquery-ui'); ?>
             <?php echo $this->Html->script('future-slider'); ?>
        </head>




            <div id="contentmp" style="overflow: hidden;">

                <div id="head">
                    <?php echo $this->fetch('header1'); ?>
                </div>

                    <div id="content_wrapper" style="position:relative; overflow: hidden;">
                        
						<div class="upper_shadow"></div>
                        
						<div style="position:absolute; z-index:10;">
                            <?php echo $this->fetch('sidebar1'); ?>
                        </div>

                        <div id="panel_container" style="position:absolute; z-index:5; height:100%">
                            <div id="panel" style="height:100%">

                                <div id="panel_boundaries">
                                    
                                    <div id="home_panel_wrapper">

                                      <div id="start" class="active">
                                        <div id="hot_pane" class="catalog_holder named">
                                          <h3>Hot</h3>
                                          <?php 
                                            echo $this->CatalogGenerator->formatProducts( $products_hot ); 
                                          ?>
                                        </div>
                                        <div id="sales_pane" class="catalog_holder named">
                                          <h3>On sale</h3>
                                          <?php 
                                            echo $this->CatalogGenerator->formatProducts( $products_sale ); 
                                          ?>
                                        </div>
                                        <div id="top_rated_pane" class="catalog_holder named">
                                          <h3>Top rated</h3>
                                          <?php 
                                            echo $this->CatalogGenerator->formatProducts( $products_top_rated ); 
                                          ?>
                                        </div>
                                        <div id="new_pane" class="catalog_holder named">
                                          <h3>Newly added</h3>
                                          <?php 
                                            echo $this->CatalogGenerator->formatProducts( $products_new ); 
                                          ?>
                                        </div>
                                        <div id="picks_pane" class="catalog_holder named">
                                          <h3>Our picks for <?php echo $this->Session->read('Auth.User.name'); ?></h3>
                                          <?php 
                                            echo $this->CatalogGenerator->formatProducts( $products_picks ); 
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

                                </div>
                                
                            </div>
                        </div>

						<div class="lower_shadow"></div>
						
                    </div>

                    <div style="clear:both"></div>

                    <div id="foot" style="position:absolute; bottom:0; width:100%; z-index:10;">

                        <?php echo $this->fetch('footer1'); ?>

                    </div>

            </div>

        <script type="text/javascript">

        var logoVisible = true;
        var allowTopHeaderHiding = false;
        var topHeaderHideMargin = 96;
        
        var activePanel = "start";
        var catalog_item_width = 174;   // Width of each element in catalog, including paddings and margins
        var catalog_item_height = 316;  // Height of each element in catalog, including paddings and margins

        var hot_slider = '';
        var sales_slider = '';
        var top_rated_slider = '';
        var new_slider = '';
        var picks_slider = '';

        var slider_interval = '';

        $(document).ready(function() {

            $("body").css("overflow", "hidden");
            resizeContent();
            configureEvents();
            setTimeout(function(){
                allowTopHeaderHiding = true;
                if( $('#content_wrapper').is(":hover") ) {
                    if(comboboxOpen != true) {
                        hideTopHeader();    
                    }
                }
            }, 3000);

            //set slider
            hot_slider = new FutureSlider("#hot_pane div[type='catalog']", catalog_item_width, catalog_item_height);
            sales_slider = new FutureSlider("#sales_pane div[type='catalog']", catalog_item_width, catalog_item_height);
            top_rated_slider = new FutureSlider("#top_rated_pane div[type='catalog']", catalog_item_width, catalog_item_height);
            new_slider = new FutureSlider("#new_pane div[type='catalog']", catalog_item_width, catalog_item_height);
            picks_slider = new FutureSlider("#picks_pane div[type='catalog']", catalog_item_width, catalog_item_height);

            //auto advance every 3500ms
            slider_interval = window.setInterval(function(){
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

        });

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




        $(window).resize(function(){
            resizeContent();
        });

        function resizeContent() {
            if(logoVisible == true) {
                $("#content_wrapper").height( $(window).height() - $("#head").outerHeight() - $("#foot").outerHeight() );
            }
            else {
                $("#content_wrapper").height( $(window).height() - $("#head").outerHeight() - $("#foot").outerHeight() + topHeaderHideMargin );
            }
            
            $("#content_wrapper").width( $(window).width() );
            $("#panel").height( "100%" );
            $("#panel").width( $(window).width() );
        }

        function configureEvents() {

            $("#content_wrapper").mouseenter(function(){
                if(logoVisible == true && comboboxOpen != true) {
                    hideTopHeader();
                }
            });

            $("#topHeader").mouseenter(function(){
                if(logoVisible == false && comboboxOpen != true) {
                    showTopHeader();
                }
            });

        }

        


        /*
         * El comportamiento del header es el siguiente, hasta el momento:
         *      -Cuando la página carga, el header está expandido por al menos 3 segundos.
         *      -Luego de los 3 segundos iniciales, cuando el cursor se encuentre dentro del panel principal de home, el header se contrae.
         *      -Cuando el cursor se encuentre dentro del header, el header se expande.
         *      -Si el usuario ha escrito algo en la barra de búsqueda, el header se mantiene expandido bajo cualquier circunstancia.
         *      -Si existe un elemento <select> desplegado en la página, el header no cambia de estado bajo ninguna circunstancia.
         */

        function hideTopHeader() {
            if(allowTopHeaderHiding == true && !$("input.search").val()) {

                if(parseInt($("#topHeader").css("marginTop")) < 0) {
                    return;
                }
                else {
                    logoVisible = false;
                    allowTopHeaderHiding = false;

                    $("#topHeader").animate({
                        marginTop: '-=' + topHeaderHideMargin + 'px'
                    }, 400, "easeOutQuart", function() {
                        allowTopHeaderHiding = true;
                    });

                    $("#content_wrapper").animate({
                        height: '+=' + topHeaderHideMargin + 'px'
                    }, 400, "easeOutQuart", function() {

                    });
                }
            }
        }

        function showTopHeader() {
            if(allowTopHeaderHiding == true) {
                if(parseInt($("#topHeader").css("marginTop")) > 0) {
                    return;
                }
                else {
                    logoVisible = true;
                    allowTopHeaderHiding = false;

                    $("#topHeader").animate({
                        marginTop: '+=' + topHeaderHideMargin + 'px'
                    }, 400, "easeOutQuart", function() {
                        allowTopHeaderHiding = true;
                    });

                    $("#content_wrapper").animate({
                        height: '-=' + topHeaderHideMargin + 'px'
                    }, 400, "easeOutQuart", function() {

                    });
                }
            }
        }

        </script>

    </html>