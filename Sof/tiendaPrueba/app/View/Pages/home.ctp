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
                                    <?php echo $this->fetch('home_panel'); ?>
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